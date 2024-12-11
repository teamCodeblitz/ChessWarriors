<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/connection.php';

$query = "SELECT * FROM players";
$result = $conn->query($query);
$players = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $players[] = [
            'user_id' => $row['user-id'],
            'username' => $row['user-name'],
            'email' => $row['user-email'],
            'level' => $row['user-level'],
            'rank' => $row['user-rank'],
            'rank_star' => $row['rank-star'],
            'diamonds' => $row['user-diamonds'],
            'exp' => $row['user-exp'],
            'points' => $row['user-points'],
            'tries' => $row['user-totalTries']
        ];
    }
}

echo json_encode([
    'status' => 'success',
    'data' => $players
]);

$conn->close();
?>
