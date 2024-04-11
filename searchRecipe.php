<?php
include('connection.php'); 

if(isset($_GET['recipeName'])) {
    $recipeName = $_GET['recipeName'];

    $query = "SELECT * FROM recipes WHERE recipeName LIKE :recipeName";
    $stmt = $conn->prepare($query);
    $likeRecipeName = "%$recipeName%";
    $stmt->bindValue(':recipeName', $likeRecipeName, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($results) > 0) {
        foreach($results as $row) {
            
            echo "<a href='recipe_detail.php?id=" . htmlspecialchars($row['id']) . "' class='searchSuggestion'>" . htmlspecialchars($row['recipeName']) . "</a>";
        }
    } else {
        echo "<div>No results found</div>";
    }
} 
?>

