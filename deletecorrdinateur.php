<?php
if (isset($_GET['idc'])) {
    $id_coordonnateur = $_GET['idc'];

    // Include your database connection logic
    include './db_conn.php';

    // Prepare and execute the DELETE query
    $query = "DELETE FROM `coordonnateur` WHERE id_coordonnateur = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_coordonnateur]);

    // Redirect to the desired page after deletion
    header("Location:coordinateur.php");
    exit();
}
?>
