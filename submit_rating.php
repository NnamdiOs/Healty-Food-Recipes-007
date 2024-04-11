<?php
session_start();
include('connection.php'); 


if (isset($_SESSION['userId']) && isset($_POST['rating'], $_POST['recipeId'])) {
    $userId = $_SESSION['userId'];
    $rating = $_POST['rating'];
    $recipeId = $_POST['recipeId'];

    
    $sql = "INSERT INTO recipe_ratings (recipe_id, user_id, rating) VALUES (?, ?, ?) 
            ON DUPLICATE KEY UPDATE rating = ?";
    $stmt = $conn->prepare($sql);
    
    
    if ($stmt->execute([$recipeId, $userId, $rating, $rating])) {
       
        header("Location: recipe_detail.php?id=$recipeId&success=Rating submitted successfully.");
    } else {
        
        header("Location: recipe_detail.php?id=$recipeId&error=Failed to submit rating.");
    }
} else {
   
    header("Location: login.php?error=You must be logged in to rate recipes.");
}
?>
