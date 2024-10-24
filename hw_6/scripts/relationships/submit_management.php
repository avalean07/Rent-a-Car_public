<?php
include 'db_connect.php';

$employee_id = $_POST['employee_id'];
$customer_id = $_POST['customer_id'];

$query = "INSERT INTO EmployeeManagesCustomer (employee_id, customer_id) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $employee_id, $customer_id);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_manages.php?success=true");
} else {
    header("Location: ../../feedback/feedback_manages.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
