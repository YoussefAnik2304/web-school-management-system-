<?php
$title = 'Ajouter filière';
include_once './includes/head.php';
require_once './db_conn.php';

// Retrieve the list of departments
$queryDepartments = "SELECT id_departement, nom_departement FROM Departement";
$statementDepartments = $pdo->query($queryDepartments);
$departments = $statementDepartments->fetchAll(PDO::FETCH_ASSOC);

$role = 'coordinateur';
$queryCoordinators = "SELECT * FROM Professeur WHERE role != '$role'";
$statementCoordinators = $pdo->query($queryCoordinators);
$coordinators = $statementCoordinators->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $nomfilier = $_POST['nomfilier'];
    $namedepart = $_POST['namedepart'];
    $description = $_POST['description'];
    $idprof = $_POST['idprof'];

    // Check if the professor is already a coordinator
    $queryCheckCoordinator = "SELECT COUNT(*) FROM Coordonnateur WHERE id_professeur = :idprof";
    $statementCheckCoordinator = $pdo->prepare($queryCheckCoordinator);
    $statementCheckCoordinator->execute(['idprof' => $idprof]);
    $coordinatorCount = $statementCheckCoordinator->fetchColumn();

    if ($coordinatorCount > 0) {
        // Professor is already a coordinator, handle the error condition
        $error = "Le professeur sélectionné est déjà un coordinateur.";
    } else {
        // Insert the new filiere into the database
        $queryInsertFiliere = "INSERT INTO Filiere (nom_filiere, description, id_departement) VALUES (:nomfilier, :description, :namedepart)";
        $statementInsertFiliere = $pdo->prepare($queryInsertFiliere);
        $statementInsertFiliere->execute(['nomfilier' => $nomfilier, 'description' => $description, 'namedepart' => $namedepart]);
        $filiereId = $pdo->lastInsertId();

        // Insert the new coordinator into the Coordonnateur table
        $queryInsertCoordinator = "INSERT INTO Coordonnateur (id_professeur, id_filiere) VALUES (:idprof, :filiereId)";
        $statementInsertCoordinator = $pdo->prepare($queryInsertCoordinator);
        $statementInsertCoordinator->execute(['idprof' => $idprof, 'filiereId' => $filiereId]);
       



        $query = "UPDATE professeur SET role='coordinateur' WHERE id_professeur = $idprof ";
        $statement = $pdo->query($query);
        $statement->execute();
        // Redirect to the filieres list page
        header('Location: ./lesfillieres.php');
        exit();
    }
}
?>

<style>
    <?php include_once './style/formFilier.css'; ?>
</style>

<?php include_once './sidebar.php'; ?>

<div class="main-block container">
    <div class="left-part">
        <img src="./images/Wavy_Bus-32_Single-03.jpg" height="432px">
    </div>
    <form action="" method="post">
        <h1 style="color:#fff">Ajouter Filière</h1>
        <?php if (isset($error)) : ?>
            <div class="error">
            
            <div class="alert alert-danger" role="alert">
                
            <?php echo $error?>
        </div>
            
            </div>
        <?php endif; ?>
        <div class="info">
            <input class="fname" type="text" name="nomfilier" placeholder="Nom de filière" required>
            <div>
                <h4 class="" style="color:#fff">Département</h4>
                <select class="fname formbold-form-input" name="namedepart" id="occupation" required>
                    <?php foreach ($departments as $department) : ?>
                        <option value="<?php echo $department['id_departement']; ?>"><?php echo $department['nom_departement']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <h4 style="color:#fff">Description</h4>
            <div>
                <textarea rows="4" name="description"></textarea>
            </div>
            <div>
                <h4 class="" style="color:#fff">Chef de filière / Coordinateur</h4>
                <select class="formbold-form-input" name="idprof" id="occupation" required>
                    <?php foreach ($coordinators as $coordinator) : ?>
                        <option value="<?php echo $coordinator['id_professeur']; ?>"><?php echo $coordinator['prenom_professeur'] . " " . $coordinator['nom_professeur']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="my-4">Submit</button>
        </div>
    </form>
</div>
<?php  include_once './includes/script.php';?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
