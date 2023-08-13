<?php
require_once './includes/head.php';
require_once './db_conn.php';
require_once './sidebar.php';

// Récupérer l'id de la filière du professeur (supposons qu'il soit stocké dans une variable $id_filiere_professeur)
$id_filiere_professeur = 1; // Remplacez cette valeur par la véritable valeur de l'id de la filière du professeur

// Requête SQL pour récupérer les étudiants dans la même filière que le professeur
$query = "SELECT e.id_etudiant, e.nom_etudiant, e.email_etudiant, f.nom_filiere
          FROM Etudiant e
          JOIN Filiere f ON e.id_filiere = f.id_filiere
          WHERE e.id_filiere = :id_filiere_professeur";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_filiere_professeur', $id_filiere_professeur, PDO::PARAM_INT);
$stmt->execute();

?>

<div class="merg container" style="height:640px">
    <div class="home-content">
        <div class="container">
            <h2>La liste des Etudiants <small></small></h2>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">Id</div>
                    <div class="col col-2">Student Name</div>
                    <div class="col col-3">Email</div>
                    <div class="col col-4">Filiere</div>
                </li>

                <?php
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<li class="table-row">';
                    echo '<div class="col col-1" data-label="Id">' . $row['id_etudiant'] . '</div>';
                    echo '<div class="col col-2" data-label="Student Name">' . $row['nom_etudiant'] . '</div>';
                    echo '<div class="col col-3" data-label="Email">' . $row['email_etudiant'] . '</div>';
                    echo '<div class="col col-4" data-label="Filiere">' . $row['nom_filiere'] . '</div>';
                    echo '</li>';
                }
                ?>

            </ul>
        </div>
    </div>
</div>
