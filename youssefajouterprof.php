<?php
$host = 'localhost';
$database = 'backend';
$username = 'root';
$password = '';

// Create a new PDO instance for database connection
$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

if (isset($_POST['nomprof']) && isset($_POST['prenomprof']) && isset($_POST['emailprof']) && isset($_POST['roleprof'])  && isset($_POST['Password'])) {
    $nomprof = $_POST['nomprof'];
    $prenomprof = $_POST['prenomprof'];
    $emailprof = $_POST['emailprof'];
    $roleprof = $_POST['roleprof'];
    $password = $_POST['Password'];
    $check = "SELECT COUNT(*) FROM professeur WHERE nom_professeur = :profnom AND prenom_professeur = :prenomprof";
    $checking = $db->prepare($check);
    $checking->bindParam(':profnom', $nomprof);
    $checking->bindParam(':prenomprof', $prenomprof);
    $checking->execute();
    $rowCount = $checking->fetchColumn();

    // If data already exists, delete it
    if ($rowCount > 0) {
      //echo"<script>alert('professeur already exist ')</script>";
        
    }
    else{
    // Insert the new data
    $insert = "INSERT INTO professeur (nom_professeur, prenom_professeur, email_professeur, role,password_professeur) VALUES (:nomprof, :prenomprof, :emailprof, :roleprof,:password)";
    $inserting = $db->prepare($insert);
    $inserting->bindParam(':nomprof', $nomprof);
    $inserting->bindParam(':prenomprof', $prenomprof);
    $inserting->bindParam(':emailprof', $emailprof);
    $inserting->bindParam(':roleprof', $roleprof);
    $inserting->bindParam(':password', $password);
    $inserting->execute();
    }
}
header("Location: youssefgererprof.php");
    exit();
$db=null;
?>