<!--php TO Fetch database info Starts--> 
<?php
include('connection.php');

// To call all chefs' data/total recipe ratings gathered from recipe users
$sql = "
SELECT 
    chefs.ChefID, 
    chefs.ChefName, 
    chefs.ProfilePhoto, 
    chefs.ProfessionalTitle, 
    chefs.Location, 
    chefs.Biography,
    IFNULL(SUM(recipe_ratings.rating), 0) AS TotalStars
FROM 
    chefs
LEFT JOIN 
    recipes ON chefs.ChefID = recipes.ChefID
LEFT JOIN 
    recipe_ratings ON recipes.id = recipe_ratings.recipe_id
GROUP BY 
    chefs.ChefID
ORDER BY 
    TotalStars DESC, chefs.ProfessionalTitle DESC;
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$chefs = $stmt->fetchAll();

?>
 <!--php Ends--> 

 <!--html Starts--> 
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/index.css">
        <title>Chefs Profiles</title>
    </head>
    <!--Body Starts Here--> 
    <body class="homepage">
    <!--Header Starts Here--> 
        <header>
            <!-- Navigation Bar Starts Here-->
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
                                <a class="nav-link" href="Contact_Us.php">Contact us</a>
                            </li>
                        </ul>
                            <!-- Search Form Starts Here-->
                            <form class="d-flex" role="search" action="searchRecipe.php" method="get">
                                <input class="form-control me-2" type="search" placeholder="Search Recipes" aria-label="Search" id="recipeSearch" name="recipeName" autocomplete="off">
                                <button class=".search-btn" type="submit">Search</button>
                                <div id="searchSuggestions" style="position: absolute; background-color: #f0f0f0; z-index: 1000; width: 100%;"></div>
                            </form>
                            <!-- Search Form Ends Here-->
                            <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </nav>
            <!--Navigation Bar Ends here--> 

        </header>
        <!--Header Ends Here-->

        <!--Main Starts Here-->
        <main>
            <div class="container mt-5 pt-5">
                <div class="chef-container d-flex justify-content-between">
                    <div class="chefs-profiles">
                        <?php foreach ($chefs as $chef): ?>
                            <div class="chef-profile mb-4">
                                <div class="chef-image">
                                    <img src="<?php echo htmlspecialchars($chef['ProfilePhoto']); ?>" alt="Chef Photo" style="width:10%;">
                                </div>
                                <h2><?php echo htmlspecialchars($chef['ChefName']); ?></h2>
                                <p><strong>Title:</strong> <?php echo htmlspecialchars($chef['ProfessionalTitle']); ?></p>
                                <p><strong>Location:</strong> <?php echo htmlspecialchars($chef['Location']); ?></p>
                                <p><?php echo nl2br(htmlspecialchars($chef['Biography'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="sidebar" style="width: 200px;">
                        <h3>Chef Ranking by Users</h3>
                        <?php foreach ($chefs as $chef): ?>
                            <div class="chef-ranking">
                                <p><?php echo htmlspecialchars($chef['ChefName']); ?> - <?php echo htmlspecialchars($chef['ProfessionalTitle']); ?></p>
                                    <div class="rating-bar" style="background-color: #ddd; height: 20px; width: 100%;">
                                        <div class="rating-fill" style="background-color: #4CAF50; height: 100%; width: <?php echo (max(0, min(100, ($chef['TotalStars'] / 5 * 20)))); ?>%;"></div>
                                        </div>
                                        <p>Total Stars: <?php echo $chef['TotalStars']; ?></p>
                                    </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main> 
        <!--Main Ends Here--> 

        <!--Footer Starts Here-->
        <footer>

        </footer>
        <!--Footer Ends Here-->

        <!--Scripts-->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoL1FfFyOeo9D1RvFXGjMD6fDqzdlD3BqatPYytOtag5WvOHGSH8TzkdoKppAm" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVmo1Js1p5zP/nQx+Kt2cWc6dzl53MVp3C1IbFUsi/IFdO2V" crossorigin="anonymous"></script>
    </body>
    <!--Body Ends Here-->
</html>
