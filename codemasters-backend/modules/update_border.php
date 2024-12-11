<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/connection.php';

$userId = $_POST['userId'];
$borderName = $_POST['borderName'];

$query = "UPDATE `players` SET `user-avatarBorder` = ? WHERE `user-id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $borderName, $userId);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update border.']);
}

$stmt->close();
$conn->close();
?>