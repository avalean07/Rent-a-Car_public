<?php
include 'db_connect.php';

// Assuming Salesman might have additional attributes like sales_region
$employee_id = $_POST['employee_id'];  // This would be a hidden field in the form, assuming inheritance from Employee.
$sales_region = htmlspecialchars($_POST['sales_region']);

$query = "INSERT INTO Salesman (employee_id, sales_region) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $employee_id, $sales_region);

if ($stmt->execute()) {
    header("Location: ../../feedback/feedback_salesman.php?success=true");
} else {
    header("Location: ../../feedback/feedback_salesman.php?error=" . urlencode($stmt->error));
}
$stmt->close();
$conn->close();
?>
