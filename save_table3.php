<?php
// Retrieve the JSON data from the POST request
$idprof = $_POST['professor_id'];

// Database connection configuration
$host = 'localhost';
$database = 'backend';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance for database connection
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Delete associated records in emploieprof table
    $deleteEmploieProf = "DELETE FROM emploieprof WHERE professeur = :idprof";
    $deletingEmploieProf = $db->prepare($deleteEmploieProf);
    $deletingEmploieProf->bindParam(':idprof', $idprof);
    $deletingEmploieProf->execute();
    
    // Delete professor from professeur table
    $deleteProfesseur = "DELETE FROM professeur WHERE id_professeur = :idprof";
    $deletingProfesseur = $db->prepare($deleteProfesseur);
    $deletingProfesseur->bindParam(':idprof', $idprof);
    $deletingProfesseur->execute();

    // Close the database connection
    $db = null;

    // Redirect the user to another page
    header("location: youssefgererprof.php");
    exit();
} catch (PDOException $e) {
    // Handle database errors
    echo "Deletion failed: " . $e->getMessage();
}
?>
