<?php
// Retrieve the JSON data from the POST request
$jsonData = $_POST['data'];
$idprof=$_POST['idprof'];
$semestre=$_POST['semestre'];
// Decode the JSON data to convert it back to a PHP array
$tableData = json_decode($jsonData, true);

// Database connection configuration
$host = 'localhost';
$database = 'backend';
$username = 'root';
$password = '';

// Create a new PDO instance for database connection
$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
$check = "SELECT COUNT(*) FROM emploieprof WHERE professeur = :idprof ";
$checking = $db->prepare($check);
$checking->bindParam(':idprof', $idprof);
$checking->execute();
$rowCount = $checking->fetchColumn();

// If data already exists, display a message
if ($rowCount > 0) {
    $delete="DELETE FROM emploieprof WHERE professeur=:idprof  ";
    $deleting=$db->prepare($delete);
    $deleting->bindParam(':idprof',$idprof);
    $deleting->execute();
    foreach ($tableData as $date => $colone) {
        // Loop through the modules array within each date
        foreach ($colone as $seance=>$module) {
            // Check if the module starts with 'M' and the index is numeric
                // Prepare the SQL statement for inserting or updating data into your_table_name
                $sql = "INSERT INTO emploieprof (professeur, semestre, date,seance, module)
                values( :idprof, :semestre, :date,:seance, :module_nom)
               
                ";
                $statement = $db->prepare($sql);
    
                // Bind the parameter values to the SQL statement
                $statement->bindParam(':idprof', $idprof);
                $statement->bindParam(':semestre',$semestre);
                $statement->bindParam(':seance',$seance);
                $statement->bindParam(':module_nom', $module);
                $statement->bindParam(':date', $date);
    
                // Execute the SQL statement
                $statement->execute();
                }
            }
} else {
    foreach ($tableData as $date => $colone) {
        // Loop through the modules array within each date
        foreach ($colone as $seance=>$module) {
            // Check if the module starts with 'M' and the index is numeric
                // Prepare the SQL statement for inserting or updating data into your_table_name
                $sql = "INSERT INTO emploieprof (professeur, semestre, date,seance, module)
                values( :idprof, :semestre, :date,:seance, :module_nom)
               
                ";
                $statement = $db->prepare($sql);
    
                // Bind the parameter values to the SQL statement
                $statement->bindParam(':idprof', $idprof);
                $statement->bindParam(':semestre',$semestre);
                $statement->bindParam(':seance',$seance);
                $statement->bindParam(':module_nom', $module);
                $statement->bindParam(':date', $date);
    
                // Execute the SQL statement
                $statement->execute();
                }
            }
}

// Send a response back to the client if needed
// For example, you can echo a success message

header("location: youssefemploieprof.php");
exit();

?>