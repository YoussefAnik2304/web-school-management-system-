<?php
// Check if email and password are received via POST request
if(isset($_POST['email']) && isset($_POST['password'])){
    $inputPassword = $_POST['password'];
    $email = $_POST['email'];

    // Database connection configuration
    $host = 'localhost';
    $database = 'backend';
    $username = 'root';
    $dbPassword = '';

    try {
        // Create a new PDO instance for database connection
        $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $dbPassword);

        // Retrieve the professor ID based on the email and password
        $query = "SELECT id_professeur FROM professeur WHERE email_professeur = :email AND password_professeur = :pass";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $inputPassword);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a professor with the provided email and password exists
        if($result) {
            $professorID = $result['id_professeur'];

            // Delete associated records in emploieprof table
            $deleteEmploieProf = "DELETE FROM emploieprof WHERE professeur = :idprof";
            $deletingEmploieProf = $db->prepare($deleteEmploieProf);
            $deletingEmploieProf->bindParam(':idprof', $professorID);
            $deletingEmploieProf->execute();

            // Delete professor from professeur table
            $deleteProfesseur = "DELETE FROM professeur WHERE id_professeur = :idprof";
            $deletingProfesseur = $db->prepare($deleteProfesseur);
            $deletingProfesseur->bindParam(':idprof', $professorID);
            $deletingProfesseur->execute();

            // Close the database connection
            $db = null;

            // Redirect the user to another page
            header("location: youssefgererprof.php");
            exit();
        } else {
            echo "Invalid email or password.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
        exit();
    }
} else {
    echo "Email and password not received.";
    exit();
}
?>
