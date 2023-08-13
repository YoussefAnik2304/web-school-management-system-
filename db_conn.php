<?php
// Database credentials
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'backend';
// Create a PDO instance
try {
    $dsn = "mysql:host=$hostname;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
