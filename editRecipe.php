<!--php TO Fetch database info Starts--> 
<?php
require 'connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['RecipeName'])) {
    $recipeName = $_POST['RecipeName'];

    $stmt = $conn->prepare("SELECT * FROM recipes WHERE recipeName = ?");
    $stmt->execute([$recipeName]);
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
?>
<!--php Ends--> 

<!--html Starts--> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/index.css" />
    <title>Edit Recipe</title>
</head>
<body class="editRecipe2">
    <?php include 'navbar.php'; ?>
    <div class="container transparent-form mt-5">
        <h2>Edit Recipe</h2>
        <form method="post" action="updateRecipe.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($recipe['id']); ?>">
            <input type="hidden" name="currentImagePath" value="<?php echo htmlspecialchars($recipe['imagePath']); ?>">
            <div class="mb-3">
                <label for="chefName" class="form-label">Chef Name:</label>
                <input type="text" class="form-control" id="chefName" name="chefName" value="<?php echo htmlspecialchars($recipe['chefName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="recipeName" class="form-label">Recipe Name:</label>
                <input type="text" class="form-control" id="recipeName" name="recipeName" value="<?php echo htmlspecialchars($recipe['recipeName']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($recipe['category']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients:</label>
                <textarea class="form-control" id="ingredients" name="ingredients" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="directions" class="form-label">Directions:</label>
                <textarea class="form-control" id="directions" name="directions" required><?php echo htmlspecialchars($recipe['directions']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Current Image:</label>
                <div><img src="<?php echo htmlspecialchars($recipe['imagePath']); ?>" height="100"></div>
            </div>
            <div class="mb-3">
                <label for="newImage" class="form-label">Change Image (optional):</label>
                <input type="file" class="form-control" id="newImage" name="newImage">
            </div>
            <button type="submit" class="btn btn-primary">Update Recipe</button>
        </form>
    </div>
</body>
</html>

<?php
    } else {
        echo "<div class='alert alert-warning' role='alert'>Recipe not found.</div>";
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>Invalid request.</div>";
}
?>
