<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$car_vin = htmlspecialchars($_POST['car_vin']);

$query = "INSERT INTO Automobile (car_vin) VALUES (?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $car_vin);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_automobile.php?success=true");
} else {
    header("Location: ../../feedback/feedback_automobile.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
