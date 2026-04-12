<?php
$conn = new mysqli("localhost", "root", "", "user_system");

$search = isset($_GET['query']) ? $_GET['query'] : '';

$query = "SELECT * FROM products WHERE name LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>