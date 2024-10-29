<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$employee_id = $_POST['employee_id'];  // This would also be a hidden field if inherited.
$certifications = htmlspecialchars($_POST['certifications']);

$query = "INSERT INTO Mechanic (employee_id, certifications) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $employee_id, $certifications);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_mechanic.php?success=true");
} else {
    header("Location: ../../feedback/feedback_mechanic.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
