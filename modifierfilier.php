<?php
$title = 'Modifier Filiere';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id_filiere = $_POST['id_filiere'];
    $nom_filiere = $_POST['nom_filiere'];
    $description = $_POST['description'];
    $id_departement = $_POST['id_departement'];
    $id_coordonnateur = $_POST['id_coordonnateur'];

    // Update filiere information in the database
    $query = "UPDATE Filiere SET nom_filiere = :nom_filiere, description = :description, id_departement = :id_departement WHERE id_filiere = :id_filiere";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':nom_filiere', $nom_filiere);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':id_departement', $id_departement);
    $statement->bindValue(':id_filiere', $id_filiere);
    $statement->execute();

    // Update coordinator information in the database
    $query = "UPDATE Coordonnateur SET id_coordonnateur = :id_coordonnateur WHERE id_filiere = :id_filiere";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id_coordonnateur', $id_coordonnateur);
    $statement->bindValue(':id_filiere', $id_filiere);
    $statement->execute();

    // Redirect to the list of filieres page
    header('Location: ./lesfillieres.php');
    exit();
} else {
    // Check if the id and departement_id parameters are provided
    if (!isset($_GET['id']) || !isset($_GET['departement_id']) || !isset($_GET['coordonnateur_id'])) {
        header('Location: ./lesfillieres.php');
        exit();
    }

    // Retrieve the filiere, departement, and coordinator information based on the provided id
    $id_filiere = $_GET['id'];
    $id_departement = $_GET['departement_id'];
    $id_coordonnateur = $_GET['coordonnateur_id'];

    // Get the filiere information
    $query = "SELECT F.id_filiere, F.nom_filiere, F.id_departement, F.description,C.id_coordonnateur, C.id_filiere, C.id_professeur,P.id_professeur, P.nom_professeur, P.prenom_professeur, P.email_professeur, P.role, P.password_professeur,D.id_departement, D.nom_departement FROM filiere F 
    INNER JOIN coordonnateur C ON C.id_filiere=F.id_filiere
    INNER JOIN professeur P  ON C.id_professeur=P.id_professeur
    INNER JOIN departement D ON D.id_departement=F.id_departement
    WHERE C.id_coordonnateur= $id_coordonnateur ";
    
    $statement = $pdo->query($query);
    
    $data= $statement->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="container" style="height:640px">
    <div class="home-content">
        <h1>Modifier Filiere</h1>
        <!-- <?php  var_dump($data);?> -->
        <div class="form-container">
            <form method="POST">
                <input type="hidden" name="id_filiere" value="<?= $id_filiere ?>">
                <div class="mb-3">
                    <label for="nom_filiere" class="form-label">Nom de filiere</label>
                    <input type="text" class="form-control" id="nom_filiere" name="nom_filiere"
                        value="<?= $data['nom_filiere'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        required><?= $data['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="id_departement" class="form-label">Departement</label>
                    <select class="form-select" id="id_departement" name="id_departement" required>
                        <option value="" selected></option>
                        <?php
                        $query = "SELECT `id_departement`, `nom_departement` FROM `departement`";
                        $statement = $pdo->query($query);
                        $depart = $statement->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($depart as $depart) {
                            echo "<option value='" . $depart['id_departement'] . "'>" . $depart['nom_departement'] . "</option>";
                        }

                        ?>
                    </select>
                </div>

                <!-- <div class="mb-3">
                    <label for="id_coordonnateur" class="form-label">Chef de filiere</label>
                    <select class="form-select" id="id_coordonnateur" name="id_coordonnateur" required>
                        <option value="" selected></option>
                        <?php
                        $query = "SELECT `id_professeur`, `nom_professeur`, `prenom_professeur`, `email_professeur`, `role`, `password_professeur` FROM `professeur` WHERE 1";
                        $statement = $pdo->query($query);

                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['id_professeur'] . "'>" . $row['nom_professeur'] . " " . $row['prenom_professeur'] . "</option>";
                        }
                        ?>
                    </select> -->
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>

    </div>
</div>

<?php include_once './sidebar.php'; ?>

</body>

</html>