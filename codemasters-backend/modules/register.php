<?php
include '../config/connection.php';

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: Log the received data
file_put_contents('debug.log', print_r($data, true));

if (isset($data['email'], $data['password'], $data['userName'])) {
    // Get data from the decoded JSON
    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // Hash the password
    $userName = $data['userName'];

    // Prepare and bind for the users table with default values
    $stmt = $conn->prepare("INSERT INTO `players` (`user-name`, `user-email`, `user-password`, `user-level`, `user-rank`, `rank-star`, `user-diamonds`, `user-exp`, `user-points`, `user-totalTries`, `user-avatarBorder`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters for the users table with default valuesn
    $userLevel = 1;
    $userRank = '1';
    $rankStar = 0;
    $userDiamonds = 1000;
    $userExp = 0; 
    $userPoints = 1;
    $userTotalTries = 1;
    $defaultBorder = 'default.png';

    $stmt->bind_param("sssiiiiiiis", $userName, $email, $password, $userLevel, $userRank, $rankStar, $userDiamonds, $userExp, $userPoints, $userTotalTries, $defaultBorder);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the last inserted ID
        $user_id = $conn->insert_id;

        echo "Registration successful! User ID: " . $user_id;
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Missing required fields.";
}

$conn->close();
