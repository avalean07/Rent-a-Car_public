<?php
$servername = "5.75.1182.107";//we don't know the server name yet
$username = "vgheorghe";
$password = "baietiigrei";
$dbname = "vgheorghe_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Read SQL from file
    $sql = file_get_contents('tables_code.sql');
    
    // Execute SQL
    $conn->exec($sql);
    echo "Database initialized successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>