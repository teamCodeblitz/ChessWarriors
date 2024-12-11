<?php   
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include '../config/connection.php'; // Include your database connection

$data = json_decode(file_get_contents("php://input")); // Get the JSON data

// Fetch user information by user-id
if (isset($data->{'user-id'})) {
    $user_id = $data->{'user-id'};
    $query = "SELECT * FROM players WHERE `user-id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_info = $result->fetch_assoc();
        
        // Logic to update user level and exp
        $user_exp = $user_info['user-exp'];
        $user_level = $user_info['user-level'];
        $user_rank = $user_info['user-rank']; // Fetch user rank
        $rank_star = $user_info['rank-star']; // Fetch rank star
        
        // Calculate new level and exp
        $new_level = $user_level + floor($user_exp / 100);
        $new_exp = $user_exp % 100;

        // Check if rank-star reaches 5
        if ($rank_star >= 5) {
            $user_rank += 1; // Increment user rank
            $rank_star = 0;  // Reset rank-star to 0
            $user_info['rank_increased'] = true; // Add flag for rank increase
        }

        // Update the user level, exp, and rank in the database
        $update_query = "UPDATE players SET `user-level` = ?, `user-exp` = ?, `user-rank` = ?, `rank-star` = ? WHERE `user-id` = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("iiiii", $new_level, $new_exp, $user_rank, $rank_star, $user_id);
        $update_stmt->execute();

        // Return updated user info
        $user_info['user-level'] = $new_level;
        $user_info['user-exp'] = $new_exp;
        $user_info['user-rank'] = $user_rank; // Update user rank
        $user_info['rank-star'] = $rank_star; // Update rank star
        echo json_encode($user_info);
    } else {
        echo json_encode(["message" => "User not found."]);
    }
} else {
    echo json_encode(["message" => "User ID is required."]);
}


