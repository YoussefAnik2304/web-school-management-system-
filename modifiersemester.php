<?php $title = 'modifier semestere'?>
<?php include_once './includes/head.php';
include './db_conn.php';?>



<?php

$semN= $_GET['id_semester'];

 $query =  $pdo->query("SELECT * FROM semestremodule WHERE id_semestre = $semN ");
  $query->execute();
  $data= $query->fetchAll(PDO::FETCH_ASSOC);

?>



<body>
    <!-- Include your sidebar.php content here -->
  


    <?php


$idf = $_GET['idf'];
$id_semester = $_GET['id_semester'];
$id = $_GET['id'];
$departement_id = $_GET['departement_id'];
$coordonnateur_id = $_GET['coordonnateur_id'];

if (isset($_POST['modifier'])) {
    $count = 1;
    $cmp = 1;
    foreach ($data as $data) {
        $moduleName = $_POST['module' . $cmp++];
        $moduleId = $data['id_module'];

        $sql = "UPDATE module SET module_name = :moduleName WHERE id_module = :moduleId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':moduleName', $moduleName);
        $stmt->bindParam(':moduleId', $moduleId);
        $stmt->execute();
    }
    header("location:semesterdesfilier.php?idf=" . $idf . "&id_semester=" . $id_semester . "&id=" . $_GET['id'] . "&departement_id=" . $departement_id . "&coordonnateur_id=" . $coordonnateur_id);

}
?>
    <?php include_once './sidebar.php'; ?>
  
            <!-- Include your sidebar.php content here -->
            <!-- <?php  var_dump($data);?> -->
            
            <div class="container" style="height:640px">
                <div class="home-content">
                    <div class="alert alert-primary" role="alert">
                        Modifier les modules d'une Semester   <?php  
                 echo '<pre>';
                 var_dump($_POST);
                 echo '</pre>';
              
              ?>
                    </div>
                    <form method="post" action="">
                        <?php $count=1; $cmp=1; foreach($data as $data):?>
                        <?php 
                              $idm=$data['id_module'];
                            $sql = "SELECT id_module, module_name FROM module WHERE id_module=$idm";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            if ($stmt->rowCount() > 0) {
                                // Loop through each row
                                foreach ($rows as $row) {
                                    // Access the column values by their names
                                    $idModule = $row['id_module'];
                                    $moduleName = $row['module_name'];
                                    // echo "ID Module: " . $idModule . ", Module Name: " . $moduleName . "<br>";
                                }
                            }     
                            ?>
                        <div class="d-flex flex-wrap">
                            <label for="inputPassword5" class="form-label">Module <?= $count++; ?></label>
                            <!-- <input hidden type="text" id="inputPassword5" class="form-control"aria-labelledby="passwordHelpBlock" name="module1" value="<?= $idModule?>"> -->
                            <input type="text" id="inputPassword5" class="form-control" aria-labelledby="passwordHelpBlock" name="<?php echo 'module'.$cmp++?>" value="<?= $moduleName ?>">
                            <?php endforeach;?>
                            <button type="submit" class="btn btn-primary mb-3 my-2" name="modifier">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include_once './sidebar.php'; ?>

</body>

</html>