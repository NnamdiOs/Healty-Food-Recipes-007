<?php
session_start(); 


if (isset($_SESSION['filteredRecipes']) && !empty($_SESSION['filteredRecipes'])) {
    $filteredRecipes = $_SESSION['filteredRecipes']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/index.css"> 
    <title>Filtered Recipes</title>
</head>
 <!--Body Starts here--> 
<body class="homepage">
    <header>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top px-0" style="background-color: #ffffff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php">
                    <img src="image/Food Recipe Site Logo.png" alt="logo" height="50">
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
                            <a class="nav-link" href="chefs_profile.php">About Our Chefs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact us</a>
                        </li>
                    </ul>
                    <!-- Search Form Here-->
                    <form class="d-flex" role="search" action="searchRecipe.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search Recipes" aria-label="Search" id="recipeSearch" name="recipeName" autocomplete="off">
                        <button class=".search-btn" type="submit">Search</button>
                        <div id="searchSuggestions" style="position: absolute; background-color: #f0f0f0; z-index: 1000; width: 100%;"></div>
                    </form>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </nav>
    <!--Navigation Bar Ends here--> 
    </header>
    <!--Header Ends Here-->

    <!--Main Starts Here-->
    <main>
        <div class="container mt-5">
            <h2>Filtered Recipes</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4"> 
                <?php foreach ($filteredRecipes as $recipe): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($recipe['imagePath']); ?>" class="card-img-top" alt="Recipe Image" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($recipe['recipeName']); ?></h5>
                                <p class="card-text">Chef: <?php echo htmlspecialchars($recipe['ChefName']); ?></p>
                                <p class="card-text">Category: <?php echo htmlspecialchars($recipe['category']); ?></p>
                                <a href="recipe_detail.php?id=<?php echo $recipe['id']; ?>" class="btn btn-primary">View Recipe</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <!-- footer starts here-->
    <footer class="footers bg-dark text-white pt-5 pb-4">
        <div class="container text-md-left">
            <div class="row text-md-left">
            
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Healty Food Recipe</h5>
                    <p>Explore the best recipes handpicked for you.</p>
                    <div>
                    <a href="https://www.facebook.com/marketplace/create"><i class="fa fa-facebook text-white mr-4"></i></a>
                    <a href="https://twitter.com/home?lang=en"><i class="fa fa-twitter text-white mr-4"></i></a>
                    <a href="https://www.linkedin.com/feed/"><i class="fa fa-linkedin text-white mr-4"></i></a>
                    <a href="https://www.instagram.com/?login&hl=en-gb"><i class="fa fa-instagram text-white"></i></a>
                    </div>
                </div>

            
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Info</h5>
                    <p><a href="#" class="text-white" style="text-decoration: none;">About Us</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">FAQs</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Advertise</a></p>
                    <p><a href="#" class="text-white" style="text-decoration: none;">Terms and Conditions</a></p>
                    <p><a href="PrivacyPolicy.html" class="text-white" style="text-decoration: none;">Privacy Policy</a></p>
                </div>

            
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
                    <p>RGU, Garthdee</p>
                    <p>+44 35565962049</p>
                    <p>TeamO@gmail.com</p>
                </div>

            
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Newsletter</h5>
                <form>
                    <div class="form-outline form-white mb-4">
                        <input type="email" id="form5Example2" class="form-control" placeholder="Enter your email"/>
                        <button type="submit" class="btn btn-outline-light btn-block">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="text-left text-md-left">
                © 2024 HFR, Inc. All rights reserved.
                </p>
            </div>
        </div>

    </footer>
</body>
<!--Body Ends Here-->

</html>
<!--html Ends Here-->

<?php
} else {
    echo "<p>No recipes found based on the selected filters.</p>";
}

// To clear the session variable after displaying the recipes
unset($_SESSION['filteredRecipes']);
?>
