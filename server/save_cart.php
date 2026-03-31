<?php
require_once("db.php");

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
//    echo ($_POST['name']) ?? 0;
    exit();
}

if (!isset($_POST['product_id'], $_POST['quantity'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
    echo ($_POST['name']);
    exit();
}


//prapare data
$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id'] ?? 0);
//$product_name = $_POST['name'];
//$product_price = floatval($_POST['price']);
$quantity = intval($_POST['quantity'] ?? 1);
$option = $_POST['option'] ?? "";

//// Check if already in cart
//$check = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND product_id = ?");
//$check->execute([$user_id, $product_id]);
//$item = $check->fetch();

// Check if the item is already in the cart
$insertQuery = "INSERT INTO cart (user_id, product_id, option_details, quantity) 
                VALUES (?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

$stmt = $conn->prepare($insertQuery);
$stmt->execute([$user_id, $product_id, $option, $quantity]);

echo json_encode(["success" => true]);
header('Location:' . $GLOBALS['home_url']);

