<?php $title = 'Modifier coordinateur'?>
<?php include_once './includes/head.php';?>
<?php include_once './db_conn.php';?>
<?php 
$idc= $_GET['idc'];
$idp = $_GET['idp'];


 
if (isset($_POST['modifier'])) {
    // Get the selected professor's ID
    $selectedProfessorId = $_POST['id_coordinateur'];
    
    // Update the coordonnateur table with the selected professor's ID
    $query = "UPDATE coordonnateur SET id_professeur=:id_professeur where id_coordonnateur=$idc";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_professeur', $selectedProfessorId);

    $role='Prof';
    $query2 = "UPDATE professeur SET role='Prof' WHERE id_professeur=:id_professeur";
    $stmt2 = $pdo->prepare($query2);
    $stmt2->bindParam(':id_professeur', $idp);
    $stmt2->execute();
    
    if ($stmt->execute()) {
        // echo "Update successful";
        header('location:./coordinateur.php');
    } else {
        // echo "Error updating the database";
    }
}

?>
<body>
    <?php include_once './sidebar.php'; ?>
    <div class="container ">
        <div class="home-content" style="height: 640px">
            <div class="alert alert-info" role="alert">
                MODIFICATION D'UN COORDINATEUR
                <?php 


if (isset($_POST['modifier'])) {
    // Get the selected professor's ID
   var_dump($_POST);
}
?>
            </div>
            <?php 
            // Query to select professors who are not coordinators
                $query = "SELECT `id_professeur`, `nom_professeur`, `prenom_professeur`, `email_professeur`, `role`, `password_professeur`
                FROM `professeur`
                WHERE `id_professeur` NOT IN (
                    SELECT DISTINCT `id_professeur`
                    FROM `coordonnateur`
                )";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $professors = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
           ?>
            <form method="POST">
            
                <?php
// Assuming you have already fetched the $professors data as shown in the previous code

            echo '<div class="mb-3">';
            echo '<label>Coordinateur</label>';
            echo '<br>';
            echo '<select class="formbold-form-input" name="id_coordinateur" id="occupation">';

            // Loop through each professor and generate the options
            foreach ($professors as $professor) {
                $id = $professor['id_professeur'];
                $nom = $professor['nom_professeur'];
                $prenom = $professor['prenom_professeur'];

                // Generate the option element
                echo "<option value='$id'>$nom $prenom</option>";
            }

            echo '</select>';
            echo '</div>';
?>

                <button type="submit" class="btn btn-primary mb-3" name="modifier">Modifier</button>
        </div>
        </form>
    </div>
    </div>

    <?php include_once './sidebar.php'; ?>

</body>

</html>