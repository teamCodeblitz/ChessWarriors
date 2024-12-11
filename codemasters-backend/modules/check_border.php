<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/connection.php';

$userId = $_GET['userId'];

$query = "SELECT `user-avatarBorder` FROM players WHERE `user-id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$purchasedItems = [];
while ($row = $result->fetch_assoc()) {
    $purchasedItems[] = $row['user-avatarBorder'];
}

echo json_encode([
    'status' => 'success',
    'purchasedItems' => $purchasedItems
]);

$stmt->close();
$conn->close();
?> 