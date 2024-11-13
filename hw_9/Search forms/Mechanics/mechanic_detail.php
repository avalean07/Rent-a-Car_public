<?php
include '../../db_connect.php';
$employee_id = $_GET['employee_id'];

$query = "SELECT * FROM Employee WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<h1>Mechanic Details: " . $row['name'] . "</h1>";
    echo "<p>Employee ID: " . $row['employee_id'] . "</p>";
    echo "<p>Specializations: " . $row['specialization'] . "</p>";
} else {
    echo "<p>Mechanic not found.</p>";
}
$stmt->close();
$conn->close();
?>
