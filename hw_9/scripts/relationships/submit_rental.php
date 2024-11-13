<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("../../maintenance.html"); // Redirect to the login page
    exit;
}

$customer_id = $_POST['customer_id'];
$car_vin = $_POST['car_vin'];
$rent_date = $_POST['rent_date'];

$query = "INSERT INTO CustomerRentsAutomobile (customer_id, car_vin, rent_date) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $customer_id, $car_vin, $rent_date);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_rents.php?success=true");
} else {
    header("Location: ../../feedback/feedback_rents.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
