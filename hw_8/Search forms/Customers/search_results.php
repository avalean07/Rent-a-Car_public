<?php
$servername = "5.75.182.107";
$username = "vgheorghe";
$password = "ONRVSl";
$dbname = "vgheorghe_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_GET['name']) ? $_GET['name'] : '';
$credit_score = isset($_GET['credit_score']) ? $_GET['credit_score'] : '';
// Get the search criteria from the form

$sql = "SELECT customer_id, name, credit_score FROM Customer WHERE 1=1";
// Prepare the query

if (!empty($name)) {
    $sql .= " AND name LIKE '%$name%'";
}

if (!empty($credit_score)) {
    $sql .= " AND credit_score >= $credit_score";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {// Check if any results were found
    echo "<h1>Search Results</h1>";
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li><a href='customer_details.php?id=" . $row['customer_id'] . "'>" . $row['name'] . " (Credit Score: " . $row['credit_score'] . ")</a></li>";
    }
    echo "</ul>";
} else {
    echo "No results found.";
}

$conn->close();
?>
