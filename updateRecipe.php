<?php
require 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $chefName = $_POST['chefName'];
    $recipeName = $_POST['recipeName'];
    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];

 
    $imagePath = $_POST['currentImagePath'];

    if (!empty($_FILES['newImage']['name'])) {
        $targetDirectory = "uploads/"; 
        $imagePath = $targetDirectory . basename($_FILES['newImage']['name']);
        if (!move_uploaded_file($_FILES['newImage']['tmp_name'], $imagePath)) {
            echo "There was an error uploading the file.";
            $imagePath = $_POST['currentImagePath']; 
        }
    }

   
    $stmt = $conn->prepare("UPDATE recipes SET chefName = ?, recipeName = ?, category = ?, ingredients = ?, directions = ?, imagePath = ? WHERE id = ?");
    $stmt->execute([$chefName, $recipeName, $category, $ingredients, $directions, $imagePath, $id]);

    if ($stmt->rowCount()) {
        echo "Recipe updated successfully.";
       
    header("Location: successPage.php");
    } else {
        echo "Error updating recipe.";
    }
} else {
    echo "Invalid request.";
}
?>

