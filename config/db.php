<?php
// Database configuration
$host = 'localhost';  // Server address
$dbname = 'dentist_website';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
