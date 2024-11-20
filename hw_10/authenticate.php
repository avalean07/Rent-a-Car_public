<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");// SQL to check the username and password
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("maintenance.html"); // Redirect to the maintenance page
    } else {
        echo 'Invalid password.';
    }
} else {
    echo 'Invalid username.';
}
$stmt->close();
$conn->close();
?>