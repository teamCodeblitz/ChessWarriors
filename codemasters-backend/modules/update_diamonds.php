<?php
header('Content-Type: application/json');

// Database connection
include '../config/connection.php';
// Get POST data
$data = json_decode(file_get_contents("php://input"), true);
$userId = $data['userId'];
$diamondsToDeduct = $data['diamondsToDeduct'];

// Validate input
if (!isset($userId) || !isset($diamondsToDeduct)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}   

// Fetch current diamond balance
$sql = "SELECT `user-diamonds` FROM `players` WHERE `user-id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentDiamonds = $row['user-diamonds'];

    // Check if sufficient diamonds are available
    if ($currentDiamonds >= $diamondsToDeduct) {
        // Update diamond balance
        $newBalance = $currentDiamonds - $diamondsToDeduct;
        $updateSql = "UPDATE `players` SET `user-diamonds` = ? WHERE `user-id` = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $newBalance, $userId);
        
        if ($updateStmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Diamond balance updated']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update diamond balance']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insufficient diamonds']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

$stmt->close();
$conn->close();
?>
