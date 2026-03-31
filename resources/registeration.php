<?php
include 'db.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (first_name, last_name, email, address, phone, password) VALUES ('$first_name', '$last_name', '$email', '$address', '$phone', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
