<?php
include './auth.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials!";
    }
} else {
    echo "User not found!";
}
$conn->close();
?>
