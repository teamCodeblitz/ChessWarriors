<?php

include '../config/connection.php';

// Fetch current user data
$userId = $_SESSION['user_id']; // Assuming user ID is stored in session
$query = "SELECT user_level, user_rank, rank_star, user_exp FROM players WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    // Access user data
    $userLevel = $userData['user_level'];
    $userRank = $userData['user_rank'];
    $rankStar = $userData['rank_star'];
    $userExp = $userData['user_exp'];
} else {
    // Handle case where user is not found
    echo "User not found.";
}

// ... existing code ...

