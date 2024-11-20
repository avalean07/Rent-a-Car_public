<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$mechanic_id = $_POST['mechanic_id'];
$car_vin = $_POST['car_vin'];

$query = "INSERT INTO MechanicFixesAutomobile (mechanic_id, car_vin) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $mechanic_id, $car_vin);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_fixes.php?success=true");
} else {
    header("Location: ../../feedback/feedback_fixes.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
