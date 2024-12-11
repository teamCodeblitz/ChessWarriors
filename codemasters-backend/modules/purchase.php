<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/connection.php';

$data = json_decode(file_get_contents('php://input'), true);

$userId = $data['userId'];
$itemId = $data['itemId'];
$itemName = $data['itemName'];
$itemPrice = $data['itemPrice'];
$itemImage = $data['itemImage'];

$query = "INSERT INTO inventory (player_id, myitem_no, myitem_name, myitem_price, myitem_image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iisss", $userId, $itemId, $itemName, $itemPrice, $itemImage);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to insert purchase.']);
}

$stmt->close();
$conn->close();
?> 