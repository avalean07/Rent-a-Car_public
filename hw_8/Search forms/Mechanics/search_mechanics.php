<?php
include '../../db_connect.php';

$car_vin = $_GET['car_vin'];

$query = "SELECT Mechanic.employee_id, Employee.name, Automobile.car_vin, Automobile.model FROM Mechanic
          JOIN Employee ON Mechanic.employee_id = Employee.employee_id
          JOIN MechanicFixesAutomobile ON Mechanic.employee_id = MechanicFixesAutomobile.mechanic_id
          JOIN Automobile ON MechanicFixesAutomobile.car_vin = Automobile.car_vin
          WHERE Automobile.car_vin = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $car_vin);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><a href='../../details/mechanic_detail.php?employee_id=" . $row['employee_id'] . "'>" . $row['name'] . " - " . $row['model'] . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No mechanics found for this VIN.</p>";
}
$stmt->close();
$conn->close();
?>
