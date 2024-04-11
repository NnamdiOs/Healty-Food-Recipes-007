<?php
session_start();
include('connection.php');

$recipe = null;
$averageRating = 0;
$ratingCount = 0;

$recipeId = isset($_GET['id']) ? $_GET['id'] : null;

if ($recipeId && is_numeric($recipeId)) {
    // To fetch recipe details
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->execute([$recipeId]);
    $recipe = $stmt->fetch();

    if ($recipe) {
        // To fetch average rating and count 
        $ratingStmt = $conn->prepare("SELECT AVG(rating) AS averageRating, COUNT(rating) AS ratingCount FROM recipe_ratings WHERE recipe_id = ?");
        $ratingStmt->execute([$recipeId]);
        $ratingResult = $ratingStmt->fetch();
        if ($ratingResult) {
            $averageRating = round($ratingResult['averageRating'], 1);
            $ratingCount = $ratingResult['ratingCount'];
        }
    }
}
?>
<!--php Ends--> 

 <!--html Starts--> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/index.css"> 
    <title>Recipe Detail</title>
</head>
<!-- Body Starts Here-->
<body class = "homepage">
    <header>
         <!-- Navigation Bar Starts Here-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top px-0" style="background-color: #ffffff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php">
                    <img src="image/Food Recipe Site Logo.png" alt="logo" height="50" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Seekers_Dash.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chefs_profile.php">About our Chefs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact us</a>
                        </li>
                    </ul>
                    <!-- Search Form Start -->
                    <form class="d-flex" role="search" action="searchRecipe.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search Recipes" aria-label="Search" id="recipeSearch" name="recipeName" autocomplete="off">
                        <button class=".search-btn" type="submit">Search</button>
                        <div id="searchSuggestions" style="position: absolute; background-color: #f0f0f0; z-index: 1000; width: 100%;"></div>
                    </form>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-5">
        <?php if ($recipe): ?>
            <h1><?php echo htmlspecialchars($recipe['recipeName']); ?></h1>
            <div class="recipe-detail">
                
                <div class="text-center">
                    <img src="<?php echo htmlspecialchars($recipe['imagePath']); ?>" alt="Recipe Image" class="img-fluid recipe-image">
                </div>
                <div class="ingredients">
                    <h1>Ingredients</h1>
                    <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
                </div>
                <div class="directions">
                    <h1>Directions</h1>
                    <p><?php echo nl2br(htmlspecialchars($recipe['directions'])); ?></p>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-primary" onclick="window.print()">Print this recipe</button>
                </div>
            </div>  
            <!-- Display average rating -->
            <p>Average Rating: <?= $averageRating ?> (<?= $ratingCount ?> ratings)</p>
            <!-- Rating submission form -->
            <div class="rating-submit">
                <h2>Rate this recipe:</h2>
                <form action="submit_rating.php" method="post"> 
                    <div class="star-rating">
                        <input id="star-5" type="radio" name="rating" value="5"/>
                        <label for="star-5" class="star">&#9733;</label>
                        <input id="star-4" type="radio" name="rating" value="4"/>
                        <label for="star-4" class="star">&#9733;</label>
                        <input id="star-3" type="radio" name="rating" value="3"/>
                        <label for="star-3" class="star">&#9733;</label>
                        <input id="star-2" type="radio" name="rating" value="2"/>
                        <label for="star-2" class="star">&#9733;</label>
                        <input id="star-1" type="radio" name="rating" value="1"/>
                        <label for="star-1" class="star">&#9733;</label>
                    </div>
                    <input type="hidden" name="recipeId" value="<?php echo $recipeId; ?>"> 
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </form>
            </div>
        <?php else: ?>
            <p>Recipe not found.</p>
        <?php endif; ?>
    </main>
    <!--Main Ends Here--> 

    <!--Footer Starts Here-->
    <footer>
        
    </footer>
</body>
<!--Body Ends Here-->
</html>