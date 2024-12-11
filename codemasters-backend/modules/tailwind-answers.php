<?php
// Add these headers at the top of the file
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include_once '../config/connection.php';

// Set headers for CORS and JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Check if it's a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the level number from the query parameters
    $level_no = isset($_GET['level_no']) ? $_GET['level_no'] : null;

    if ($level_no === null) {
        http_response_code(400);
        echo json_encode(array("message" => "Missing level_no parameter"));
        exit();
    }

    try {
        // Prepare and execute the query
        $stmt = $conn->prepare("SELECT level_answer FROM `tailwind-answers` WHERE level_no = ?");
        $stmt->bind_param("i", $level_no);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if answer exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            http_response_code(200);
            echo json_encode(array(
                "status" => "success",
                "level_answer" => $row['level_answer']
            ));
        } else {
            http_response_code(404);
            echo json_encode(array(
                "status" => "error",
                "message" => "No answer found for this level"
            ));
        }

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array(
            "status" => "error",
            "message" => "Database error: " . $e->getMessage()
        ));
    }
} else {
    http_response_code(405);
    echo json_encode(array(
        "status" => "error",
        "message" => "Method not allowed"
    ));
}
?>
