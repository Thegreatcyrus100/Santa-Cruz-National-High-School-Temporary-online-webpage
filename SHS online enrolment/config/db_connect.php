<?php
$host = 'localhost';
$dbname = 'shs_enrollment';
$username = 'root';  // Change if different
$password = '';      // Change if different

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
