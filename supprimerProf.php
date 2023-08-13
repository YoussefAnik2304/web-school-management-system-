<?php
include_once './db_conn.php';
$idProfesseur= $_GET['id'];
$sql = "DELETE FROM coordonnateur WHERE id_professeur = :idProfesseur";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':idProfesseur', $idProfesseur);
$stmt->execute();


    // Effectuer la suppression dans la base de données
    $idProfesseur= $_GET['id'];
        $sql = "DELETE FROM professeur WHERE id_professeur = :idProfesseur";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idProfesseur', $idProfesseur);
        $stmt->execute();

        // Rediriger l'utilisateur vers la page "profs.php" après la suppression
        header('Location: profs.php');
        exit();
 
?>