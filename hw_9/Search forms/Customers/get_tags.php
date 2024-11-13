<?php
header('Content-Type: application/json');

$servername = "5.75.182.107";
$username = "vgheorghe";
$password = "ONRVSl";
$dbname = "vgheorghe_db";
// Database connection details

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT name FROM Customer";//the query to get unique customer names
$result = $conn->query($sql);

$tags = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tags[] = $row['name'];
    }
}//tags code from the website in the pdf

echo json_encode($tags);

$conn->close();
?>
