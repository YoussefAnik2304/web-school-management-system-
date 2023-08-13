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
    $id="SELECT id_professeur FROM professeur where nom_professeur=:nomprof AND prenom_professeur=:prenomprof";
    $req = $db->prepare($id);
    $req->bindValue(':nomprof', $nomprof);
    $req->bindValue(':prenomprof', $prenomprof);
    $req->execute();
    $id = $req->fetch();
    $idprof = $id['id_professeur'];

      $insert = "UPDATE professeur SET nom_professeur=:nomprof, prenom_professeur=:prenomprof, email_professeur=:emailprof, role=:roleprof,password_professeur=:passwordprof where id_professeur=:idprof";
    $inserting = $db->prepare($insert);
    $inserting->bindParam(':idprof', $idprof);
    $inserting->bindParam(':nomprof', $nomprof);
    $inserting->bindParam(':prenomprof', $prenomprof);
    $inserting->bindParam(':emailprof', $emailprof);
    $inserting->bindParam(':roleprof', $roleprof);
    $inserting->bindParam(':passwordprof', $password);
    $inserting->execute();
    header("Location: youssefgererprof.php");
    exit();
    }
?>