<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$name = htmlspecialchars($_POST['name']);
$credit_score = filter_var($_POST['credit_score'], FILTER_VALIDATE_INT);
$years_of_experience = filter_var($_POST['years_of_experience'], FILTER_VALIDATE_INT);

$query = "INSERT INTO Customer (name, credit_score, years_of_experience) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sii", $name, $credit_score, $years_of_experience);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_customer.php?success=true");
} else {
    header("Location: ../../feedback/feedback_customer.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
