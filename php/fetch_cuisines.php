<?php
// Assuming you have a PDO connection $pdo
header('Content-Type: application/json');

$category = $_GET['category'] ?? 'all';
// Collect other filters similarly

$query = "SELECT * FROM cuisines WHERE 1"; // Base query

if ($category != 'all') {
    $query .= " AND category = :category";
}

// Prepare and execute the query
$stmt = $pdo->prepare($query);

if ($category != 'all') {
    $stmt->bindParam(':category', $category);
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
