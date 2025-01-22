<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM products");
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conn->prepare("INSERT INTO products (name, brand, price, description, features, imageUrl) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $data['name'], $data['brand'], $data['price'], $data['description'], $data['features'], $data['imageUrl']);
    $stmt->execute();
    echo json_encode(["id" => $stmt->insert_id]);
    $stmt->close();
}

$conn->close();
?>
