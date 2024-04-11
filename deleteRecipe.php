<?php

session_start();

require 'connection.php';

if (isset($_POST['RecipeName'])) {
    $recipeName = $_POST['RecipeName'];

    $sql = "DELETE FROM recipes WHERE recipeName = :recipeName";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':recipeName', $recipeName, PDO::PARAM_STR);

    try {
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $_SESSION['success_message'] = "Recipe deleted successfully.";

            header("Location: successPage.php");
            exit;
        } else {
            
            echo "<script>alert('No recipe found with that name.'); window.location.href='Cooks_Dash.php';</script>";
        }
    } catch (PDOException $e) {
        
        echo "<script>alert('Error deleting recipe: ".$e->getMessage()."'); window.location.href='Cooks_Dash.php';</script>";
    }
} else {
    
    echo "<script>alert('No recipe name provided.'); window.location.href='Cooks_Dash.php';</script>";
}
$conn = null;
?>
