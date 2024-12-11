<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include '../config/connection.php';

$query = "SELECT * FROM shop";
$result = $conn->query($query);
$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'item_no' => $row['item_no'],
            'item_name' => $row['item_name'],
            'item_price' => $row['item_price'],
            'item_image' => $row['item_image']
        ];
    }
}

echo json_encode([
    'status' => 'success',
    'data' => $items
]);

$conn->close();
?>