<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the professor ID and module ID from the request
    $profId = isset($_POST['profId']) ? $_POST['profId'] : null;
    $moduleId = isset($_POST['moduleId']) ? $_POST['moduleId'] : null;

    // Database connection configuration
    $host = 'localhost';
    $database = 'backend';
    $username = 'root';
    $password = '';

    // Create a new PDO instance for database connection
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

    // Prepare the SQL query to insert the data into the table
    $sql = "INSERT INTO enseignement (id_professeur, id_module) VALUES (:profId, :moduleId)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':profId', $profId, PDO::PARAM_INT);
    $stmt->bindParam(':moduleId', $moduleId, PDO::PARAM_INT);

    // Execute the SQL query
    if ($stmt->execute()) {
        // Insertion successful
        echo "Data inserted successfully for professor ID $profId and module ID $moduleId";
    } else {
        // Insertion failed
        echo "Error inserting data for professor ID $profId and module ID $moduleId";
    }
}
?>
