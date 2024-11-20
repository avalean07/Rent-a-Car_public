<?php
include '../../db_connect.php'; // Ensure your database connection details are secure and correct

$employee_id = isset($_GET['employee_id']) ? (int)$_GET['employee_id'] : 0;

if ($employee_id > 0) {
    $stmt = $conn->prepare("SELECT * FROM Employee WHERE employee_id = ?");
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<h1>Mechanic Details: " . htmlspecialchars($row['name']) . "</h1>";
        echo "<p>Employee ID: " . $row['employee_id'] . "</p>";
        echo "<p>Specializations: " . htmlspecialchars($row['specialization']) . "</p>";
    } else {
        echo "<p>Mechanic not found.</p>";
    }
    $stmt->close();
} else {
    echo "<p>Invalid mechanic ID.</p>";
}
$conn->close();
?>
