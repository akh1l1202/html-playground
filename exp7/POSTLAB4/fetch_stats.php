<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "user_system");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database Connection Failed"]));
}

$start = $_GET['start'];
$end = $_GET['end'];

$query = "SELECT stat_date, signup_count FROM user_stats WHERE stat_date BETWEEN ? AND ? ORDER BY stat_date ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $start, $end);
$stmt->execute();
$result = $stmt->get_result();

$labels = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['stat_date'];
    $counts[] = (int)$row['signup_count'];
}

echo json_encode([
    "labels" => $labels,
    "counts" => $counts
]);

$stmt->close();
$conn->close();
?>