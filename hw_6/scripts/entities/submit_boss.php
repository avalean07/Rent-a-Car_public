<?php
include 'db_connect.php';

$employee_id = $_POST['employee_id'];
$department = htmlspecialchars($_POST['department']);

$query = "INSERT INTO Boss (employee_id, department) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $employee_id, $department);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_boss.php?success=true");
} else {
    header("Location: ../../feedback/feedback_boss.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
