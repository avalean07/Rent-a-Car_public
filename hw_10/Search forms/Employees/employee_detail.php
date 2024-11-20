<?php
include 'db_connect.php';
$employee_id = $_GET['employee_id'];

$query = "SELECT * FROM Employee WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<h1>Employee: " . $row['name'] . "</h1>";
    echo "<p>Employee ID: " . $row['employee_id'] . "</p>";
    // Additional details can be displayed here
} else {
    echo "<p>Employee not found.</p>";
}
$stmt->close();
$conn's close();
?>