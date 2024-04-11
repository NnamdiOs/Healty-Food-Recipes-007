<?php
session_start();
include('connection.php');  

$chefName = $_POST['chefName'] ?? '';
$category = $_POST['category'] ?? '';
$cuisine = $_POST['cuisine'] ?? '';
$location = $_POST['location'] ?? '';

// To show "All" chefs recipes.
if (strtolower($chefName) === 'all') {
    $chefName = '';
}

// SQL conditions based on input from recipe seekers
$sqlConditions = [];
$sqlParameters = [];


if ($chefName !== '') {
    $sqlConditions[] = "c.ChefName LIKE :chefName";
    $sqlParameters[':chefName'] = "%$chefName%";
}

if ($category !== '') {
    $sqlConditions[] = "r.category = :category";
    $sqlParameters[':category'] = $category;
}

if ($cuisine !== '') {
    $sqlConditions[] = "r.recipeName LIKE :cuisine";
    $sqlParameters[':cuisine'] = "%$cuisine%";
}

if ($location !== '') {
    $sqlConditions[] = "c.Location LIKE :location";
    $sqlParameters[':location'] = "%$location%";
}

$sqlConditionStr = count($sqlConditions) > 0 ? "WHERE " . implode(" AND ", $sqlConditions) : "";

$sql = "SELECT r.*, c.ChefName, c.Location
        FROM recipes AS r
        JOIN chefs AS c ON r.ChefID = c.ChefID
        $sqlConditionStr";

$stmt = $conn->prepare($sql);

foreach ($sqlParameters as $param => $value) {
    $stmt->bindValue($param, $value);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start();
$_SESSION['filteredRecipes'] = $result;


header("Location: recipe_category.php");
exit;
?>
