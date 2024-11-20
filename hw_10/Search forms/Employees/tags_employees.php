<?php
header('Content-Type: application/json');

$servername = "5.75.182.107";
$username = "vgheorghe";
$password = "ONRVSl";
$dbname = "vgheorghe_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT ID FROM Employee";
$result = $conn->query($sql);

$tags = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tags[] = $row['id'];
    }
}

echo json_encode($tags);

$conn->close();
?>
