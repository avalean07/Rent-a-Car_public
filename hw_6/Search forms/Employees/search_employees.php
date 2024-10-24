<?php
include 'db_connect.php';

$customer_id = $_GET['customer_id'];

$query = "SELECT Employee.employee_id, Employee.name, Customer.customer_id, Customer.name AS customer_name FROM Employee
          JOIN EmployeeManagesCustomer ON Employee.employee_id = EmployeeManagesCustomer.employee_id
          JOIN Customer ON EmployeeManagesCustomer.customer_id = Customer.customer_id
          WHERE Customer.customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='employee_detail.php?employee_id=" . $row['employee_id'] . "'>" . $row['name'] . " manages " . $row['customer_name'] . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No employees found managing this customer.</p>";
}
$stmt->close();
$conn->close();
?>