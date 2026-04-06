<?php
// only call this page once
require_once("db.php");

// If no logged-in user then navigate to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../server/login.php");
    exit();
}

// Check if the logged-in user is actually an admin
$check = $conn->prepare("SELECT is_admin FROM users WHERE id = ?");
$check->execute([$_SESSION['user_id']]);
$user = $check->fetch();

if (!$user || $user['is_admin'] != 1) {
    echo "Access Denied: Admins Only.";
    exit();
}
?>