<?php
include '../config/connection.php';

// Validate if user_id is set in GET request
if (!isset($_GET['user-id'])) {
    echo json_encode([
        "success" => false, 
        "error" => "User ID is required"
    ]);
    exit;
}

$userId = $_GET['user-id']; // Get user ID from the request
$expToAdd = 30; // Experience points to add
$diamondsToAdd = 100; // Diamonds to add
$action = isset($_GET['action']) ? $_GET['action'] : 'add'; // Get action from the request

if ($action === 'deduct') {
    $starsToAdd = -1; // Deduct 1 star
    $pointsToAdd = 0; // Deduct 1 point
    $totalTriesToAdd = 1; // Add 1 to total tries
} else {
    $starsToAdd = 1; // Add 1 star
    $pointsToAdd = 1; // Add 1 point
    $totalTriesToAdd = 1; // Add 1 to total tries
}

// Ensure values do not go below 0
$expToAdd = max(0, $expToAdd);
$diamondsToAdd = max(0, $diamondsToAdd);
$starsToAdd = max(0, $starsToAdd);
$pointsToAdd = max(0, $pointsToAdd);
$totalTriesToAdd = max(0, $totalTriesToAdd);

// Update user experience, diamonds, and stars
$sql = "UPDATE players 
        SET `user-exp` = `user-exp` + ?, 
            `user-diamonds` = `user-diamonds` + ?, 
            `rank-star` = `rank-star` + ?, 
            `user-points` = `user-points` + ?, 
            `user-totalTries` = `user-totalTries` + ? 
        WHERE `user-id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiii", $expToAdd, $diamondsToAdd, $starsToAdd, $pointsToAdd, $totalTriesToAdd, $userId);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

// ... existing code ...
?>
