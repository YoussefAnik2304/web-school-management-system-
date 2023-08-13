<?php
$title = 'Ajouter semester';
require_once './includes/head.php';
?>
<style>
    .home-section {
        min-height: 187vh;
    }
    <?php include_once './style/addsemester.css'; ?>
</style>
<?php
include_once './db_conn.php';

$filliereId = $_GET['filliere_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the module values from the form
    $module1 = $_POST['module1'];
    $module2 = $_POST['module2'];
    $module3 = $_POST['module3'];
    $module4 = $_POST['module4'];
    $module5 = $_POST['module5'];
    $module6 = $_POST['module6'];
    $module7 = $_POST['module7'];

    // Retrieve the start date and end date from the form
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Retrieve the semester number from the form
    $semesterNumber = $_POST['semester_number'];

    // Prepare and execute the SQL statement to insert the new semester
    $query = "INSERT INTO semestre (filliere_id, semester_number, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$filliereId, $semesterNumber, $startDate, $endDate]);

    // Retrieve the generated semester ID
    $semesterId = $pdo->lastInsertId();

    // Prepare and execute the SQL statement to insert the module names
    $moduleIds = array();

    $query = "INSERT INTO module (module_name) VALUES (?)";
    $stmt = $pdo->prepare($query);

    // Insert module1
    $stmt->execute([$module1]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module2
    $stmt->execute([$module2]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module3
    $stmt->execute([$module3]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module4
    $stmt->execute([$module4]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module5
    $stmt->execute([$module5]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module6
    $stmt->execute([$module6]);
    $moduleIds[] = $pdo->lastInsertId();

    // Insert module7
    $stmt->execute([$module7]);
    $moduleIds[] = $pdo->lastInsertId();

    // Prepare and execute the SQL statement to insert the module IDs and semester ID into the semestremodule table
    $query = "INSERT INTO semestremodule (id_semestre, id_module) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);

    // Insert the module IDs and semester ID
    foreach ($moduleIds as $moduleId) {
        $stmt->execute([$semesterId, $moduleId]);
    }

    // Redirect to the page displaying the added semester
    header("Location: ./semesterdesfilier.php?id=" . $filliereId);
    exit();
}
?>

<body>
    <?php include_once './sidebar.php'; ?>
    <div class="home-content" style="height:640px">
        <div class="container my-4">
            <div class="alert alert-primary" role="alert">
                AJOUTER LES MODULES
            </div>
            <div class="formbold-main-wrapper">
                <!-- Author: FormBold Team -->
                <!-- Learn More: https://formbold.com -->
                <div class="formbold-form-wrapper">
                    <img src="./images/4119036.jpg" height="305px">
                    <form action="" method="POST">
                        <div class="formbold-input-flex">
                            <div>
                                <label for="firstname" class="formbold-form-label"> Module1 </label>
                                <input type="text" name="module1" id="firstname" placeholder="Module1"
                                    class="formbold-form-input" />
                            </div>

                            <div>
                                <label for="lastname" class="formbold-form-label"> Module2 </label>
                                <input type="text" name="module2" id="lastname" placeholder="Module2"
                                    class="formbold-form-input" />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="text" class="formbold-form-label"> Module3</label>
                                <input type="text" name="module3" id="email" placeholder="Module3"
                                    class="formbold-form-input" />
                            </div>
                            <div>
                                <label for="text" class="formbold-form-label"> Module4</label>
                                <input type="text" name="module4" id="email" placeholder="Module4"
                                    class="formbold-form-input" />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="text" class="formbold-form-label"> Module5</label>
                                <input type="text" name="module5" id="email" placeholder="Module5"
                                    class="formbold-form-input" />
                            </div>
                            <div>
                                <label for="text" class="formbold-form-label"> Module6</label>
                                <input type="text" name="module6" id="email" placeholder="Module6"
                                    class="formbold-form-input" />
                            </div>
                        </div>

                        <div class="formbold-input-flex">
                            <div>
                                <label for="text" class="formbold-form-label"> Module7</label>
                                <input type="text" name="module7" id="email" placeholder="Module7"
                                    class="formbold-form-input" />
                            </div>
                            <div>
                                <div class="formbold-input-flex">
                                    <div>
                                        <label for="date" class="formbold-form-label"> start date</label>
                                        <input type="date" name="start_date" id="email" placeholder="Module7"
                                            class="formbold-form-input" />
                                    </div>
                                    <div>
                                        <div class="formbold-input-flexd">
                                            <div>
                                                <label for="date" class="formbold-form-label">end date</label>
                                                <input type="date" name="end_date" id="email" placeholder="Module7"
                                                    class="formbold-form-input" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="formbold-form-label">Semester</label>
                                    <select class="formbold-form-input" name="semester_number" id="semester_number">
                                        <?php
                                        $existingSemesters = array(); // Initialize an array to store existing semester numbers

                                        // Fetch existing semester numbers from the database and populate the $existingSemesters array
                                        $query = "SELECT semester_number FROM semestre WHERE filliere_id = ?";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute([$filliereId]);
                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($results as $row) {
                                            $existingSemesters[] = $row['semester_number'];
                                        }

                                        // Generate options for semester numbers that are not already existing
                                        for ($i = 1; $i <= 7; $i++) {
                                            if (!in_array($i, $existingSemesters)) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="formbold-btn">Ajouter semester</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php  include_once './includes/script.php';?>

</body>

</html>
