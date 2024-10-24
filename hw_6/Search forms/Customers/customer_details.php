<?php
$servername = "5.75.182.107";
$username = "vgheorghe";
$password = "ONRVSl";
$dbname = "vgheorghe_db";
// Database connection details

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customer_id = isset($_GET['id']) ? $_GET['id'] : 0;
// Get the customer ID from the URL

$sql = "SELECT * FROM Customer WHERE customer_id = $customer_id";
$result = $conn->query($sql);
// Prepare and execute the query


if ($result->num_rows == 1) {// Check if a result was found
    $row = $result->fetch_assoc();
    echo "<h1>Customer Details</h1>";
    echo "<p>Name: " . $row['name'] . "</p>";
    echo "<p>Credit Score: " . $row['credit_score'] . "</p>";
    echo "<p>Years of Experience: " . $row['years_of_experience'] . "</p>";
} else {
    echo "Customer not found.";
}

$conn->close();
?>
