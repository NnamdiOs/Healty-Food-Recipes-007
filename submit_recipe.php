<?php
session_start();
require 'connection.php';


$categoryMapping = [
    'appetizers' => 'Appetizer',
    'main_course' => 'Main Course',
    'desserts' => 'desserts',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $chefName = $_POST['chefName'];
    $recipeName = $_POST['recipeName'];
    $formCategory = $_POST['category'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    
    
    $category = $categoryMapping[strtolower($formCategory)] ?? $formCategory; 
    
   
    if (isset($_FILES['recipeImage']) && $_FILES['recipeImage']['error'] == 0) {
        $filePath = 'uploads/' . basename($_FILES['recipeImage']['name']);
        
        move_uploaded_file($_FILES['recipeImage']['tmp_name'], $filePath);
    } else {
        $filePath = '';
    }

    
    $query = "INSERT INTO recipes (chefName, recipeName, category, ingredients, directions, imagePath) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt->execute([$chefName, $recipeName, $category, $ingredients, $directions, $filePath])) {
        
        header("Location: Cooks_Dash.php");
        exit();
    } else {
        
        echo "An error occurred.";
    }
} else {
   
    header("Location: Cooks_Dash.php");
    exit();
}
?>
