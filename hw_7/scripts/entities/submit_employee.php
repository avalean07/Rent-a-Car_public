<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$name = htmlspecialchars($_POST['name']);
$salary = filter_var($_POST['salary'], FILTER_VALIDATE_FLOAT);

$query = "INSERT INTO Employee (name, salary) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sd", $name, $salary);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_employee.php?success=true");
} else {
    header("Location: ../../feedback/feedback_employee.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
