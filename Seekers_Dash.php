
<?php
// php TO Fetch database info Starts
session_start();
include('connection.php'); 
try {
    $query = "SELECT r.*, IFNULL(AVG(rr.rating), 0) AS averageRating 
              FROM recipes r 
              LEFT JOIN recipe_ratings rr ON r.id = rr.recipe_id 
              GROUP BY r.id 
              ORDER BY r.created_at DESC 
              LIMIT 8";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $recentRecipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log($e->getMessage());
    $recentRecipes = [];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/index.css"> 
    <title>Healthy Food Recipes Home Page</title>
</head>
<body class="homepage">
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
                    <a class="nav-link" href="chefs_profile.php">About Our Chefs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contact_Us.php">Contact us</a>
                </li>
              </ul>
            <!-- Search Form -->
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

    <main>
    
      <!-- Welcome Message Starts here -->
      <div class="welcomeNote" style="background-image: url('image/food.png');">
        <h1>Welcome <span><?php echo htmlspecialchars($_SESSION['user_fullname'] ?? 'Guest'); ?></span> to Healthy Food Recipes</h1>
      </div>

      <!-- Article/Video Section Starts here -->
      <div class="article-video-section container my-4">
        <div class="row">
          <div class="col-md-6">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/nKjJuGRqgKA?si=OJnCAJFOKsvnR8ln" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>

          <!--Article Starts Here-->
          <div class="col-md-6"> 
            <h3 class="fun-facts-header">Fun Fact</h3>
            <p>Our Chefs are constantly rated by food critics/ethusiasts which contributes to thair Rank/Status<br>There are a number of titles in the Chef space;  Executive chef, Head chef,  Sous chef,  Butcher chef</p>
            <!-- Top Chef Section Starts Here -->
            <section class="best-chef-section">
              <img src="image/sandwitch.png" alt="sandwitch Image" class="top-chef-image">
              <h2 class="best-chef-header">Top Ranked Chef</h2>
              <div class="chef-details">
                <img src="image/Best Chef.png" alt="Best Chef" class="chef-image">
                <div class="recipe-details">
                  <h3>Chef's Special Recipe</h3>
                  <p>This recipe has the highest ratings for its exquisite taste and presentation. It has been acclaimed by food enthusiasts and critics alike.</p>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      <!-- Bootstrap Carousel Starts Here -->
      <div class="container-fluid">
        <div
          id="carouselExampleIndicators" class="carousel slide caro-bg" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>

          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container">
                <div class="row">
                  <div class="col-md-2">
                    <img src="image/Oatmeal Savory Scones.png" class="d-block w-100" alt="Food Item 1">
                    <h5>Oatmeal Savory Scones</h5>
                    <p>These Oatmeal Savory Scones are a delectable fusion of hearty oats, tangy cheddar cheese, and crispy bacon. They feature a golden, crispy exterior that gives …</p>
                  </div>
                 
                  <div class="col-md-2">
                    <img src="image/Chicken Tortilla Soup.png" class="d-block w-100" alt="Food Item 2">
                    <h5>Chicken Tortilla Soup</h5>
                    <p>This Chicken Tortilla Soup is a zesty and comforting dish that’s sure to warm you up on chilly days. Tender chicken, hearty vegetables like tomatoes, …</p>
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Toasted Orzo with Chicken.png" class="d-block w-100" alt="Food Item 3">
                    <h5>Toasted Orzo with Chicken</h5>
                    <p>This Toasted Orzo with Chicken is a mouthwatering dish </p>
                  </div>
                  <div class="col-md-2">
                    <img src="image/Date Hazelnut Chocolate Spread – Healthy Nutella.png" class="d-block w-100" alt="New Food Item 4">
                    <h5>Date Hazelnut Chocolate Spread – Healthy Nutella</h5>
                    <p>This Date Hazelnut Chocolate Spread is a healthy flavorful hazelnut spread made without refined sugar, using dates instead. It is a delicious way to enjoy …</p>
                  </div>
                  <div class="col-md-2">
                      <img src="image/Zuppa Toscana.png" class="d-block w-100" alt="New Food Item 5">
                      <h5>Zuppa Toscana</h5>
                    <p>This Zuppa Toscana is a comforting, hearty, spicy and flavorful soup, ideal for chilly days. Packed with savory goodness, this dish features a delicious combination …</p>
                  </div>
                  <div class="col-md-2">
                      <img src="image/Cauliflower Gratin.png" class="d-block w-100" alt="New Food Item 6">
                      <h5>Cauliflower Gratin</h5>
                      <p>This Cauliflower Gratin is a comforting, delightful dish that transforms humble cauliflower into a creamy and satisfying culinary experience. Fresh cauliflower florets are coated in …</p>
                  </div>
                </div>
              </div>
            </div>

            
            <div class="carousel-item">
              <div class="container">
                <div class="row">
                 
                  <div class="col-md-2">
                    <img src="image/Apple Oatmeal Bread – Healthy Refined Sugar-Free Apple Bread.png" class="d-block w-100" alt="Food Item 4">
                    <h5>Apple Oatmeal Bread – Healthy Refined Sugar-Free Apple Bread</h5> 
                  </div>
                
                  <div class="col-md-2">
                    <img src="image/Roasted Parmesan Brussels Sprouts.png" class="d-block w-100" alt="Food Item 5">
                    <h5>Roasted Parmesan Brussels Sprouts</h5>  
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Easy Creamed Corn.png" class="d-block w-100" alt="Food Item 6">
                    <h5>Easy Creamed Corn</h5>
                  </div>

                  <div class="col-md-2">
                    <img src="image/Four Cheese Crispy Cheese Balls.png" class="d-block w-100" alt="New Food Item 4">
                    <h5>Four Cheese Crispy Cheese Balls</h5>
                    
                  </div>
                  <div class="col-md-2">
                      <img src="image/Tortellini Soup with Italian Sausage and Spinach.png" class="d-block w-100" alt="New Food Item 5">
                      <h5>Tortellini Soup with Italian Sausage and Spinach</h5>
                  
                  </div>
                  <div class="col-md-2">
                      <img src="image/Sweet Potato Gnocchi – Garlic Butter Sage Fried Gnocchi.png" class="d-block w-100" alt="New Food Item 6">
                      <h5>Sweet Potato Gnocchi – Garlic Butter Sage Fried Gnocchi</h5>
                      
                  </div>
                </div>
              </div>
            </div>
          

            
            <div class="carousel-item">
              <div class="container">
                <div class="row">
                 
                  <div class="col-md-2">
                    <img src="image/Healthy Gluten-Free Banana Bread – Oatmeal Almond.png" class="d-block w-100" alt="Food Item 7">
                    <h5>Healthy Gluten-Free Banana Bread – Oatmeal Almond</h5>
                    
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Tortilla Egg Muffins.png" class="d-block w-100" alt="Food Item 8">
                    <h5>Tortilla Egg Muffins</h5>
                     
                  </div>
                 
                  <div class="col-md-2">
                    <img src="image/Beef Quesadillas.png" class="d-block w-100" alt="Food Item 9">
                    <h5>Beef Quesadillas</h5>
                     
                  </div>
                  <div class="col-md-2">
                    <img src="image/Easy Salmon Patties.png" class="d-block w-100" alt="New Food Item 4">
                    <h5>Easy Salmon Patties</h5>
                    
                  </div>
                  <div class="col-md-2">
                      <img src="image/Apple Hand Pies.png" class="d-block w-100" alt="New Food Item 5">
                      <h5>Apple Hand Pies</h5>
                   
                  </div>
                  <div class="col-md-2">
                      <img src="image/Garlic Butter Chicken – Quick and Easy Chicken Recipe.png" class="d-block w-100" alt="New Food Item 6">
                      <h5>Garlic Butter Chicken – Quick and Easy Chicken Recipe</h5>
                      
                  </div>
                </div>
              </div>
            </div>

           
            <div class="carousel-item">
              <div class="container">
                <div class="row">
                 
                  <div class="col-md-2">
                    <img src="image/Spicy Greek Feta Dip – Tirokafteri.png" class="d-block w-100" alt="Food Item 10">
                    <h5>Spicy Greek Feta Dip – Tirokafteri</h5>
                    
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Gluten-Free Crepes – Easy Almond Oat Crepes Recipe.png" class="d-block w-100" alt="Food Item 5">
                    <h5>Gluten-Free Crepes – Easy Almond Oat Crepes Recipe</h5>
                   
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Zucchini Carrot Fritters.png" class="d-block w-100" alt="Food Item 6">
                    <h5>Zucchini Carrot Fritters </h5>
                   
                  </div> 
                  
                  <div class="col-md-2">
                    <img src="image/Cheese Zucchini Muffins.png" class="d-block w-100" alt="Food Item 10">
                    <h5>Cheese Zucchini Muffins</h5>
                 
                  </div>
                 
                  <div class="col-md-2">
                    <img src="image/Gluten-Free Apricot Almond Cake.png" class="d-block w-100" alt="Food Item 5">
                    <h5>Gluten-Free Apricot Almond Cake</h5>
                  
                  </div>
                  
                  <div class="col-md-2">
                    <img src="image/Buttermilk Pancakes.png" class="d-block w-100" alt="Food Item 6">
                    <h5>Buttermilk Pancakes</h5>
                  
                  </div> 
                </div>
              </div>
            </div>
          </div>


          <button class="carousel-control-prev" type="button"         data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
     

      
      <section id="popular-recipes" class="container mt-5">
        <div class="row">

          <!-- Filter Sidebar Start Here -->
          <div class="col-md-3">
            <form action="chef_filter.php" method="POST">
              <h2>Filter Recipes</h2>
              <div class="mb-3">
                  <label for="chefName" class="form-label">Chef Name</label>
                  <input type="text" class="form-control" id="chefName" name="chefName">
              </div>
              <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                  <select class="form-select" id="category" name="category">
                      <option value="">Choose...</option>
                      <option value="Appetizer">Appetizer</option>
                      <option value="Main Course">Main Course</option>
                      <option value="desserts">Desserts</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="recipeName" class="form-label">Recipe Name</label>
                  <input type="text" class="form-control" id="recipeName" name="recipeName">
              </div>
              <div class="mb-3">
                  <label for="location" class="form-label">Location</label>
                  <input type="text" class="form-control" id="location" name="location">
              </div>
              <button type="submit" class="btn btn-primary">Apply Filters</button>
            </form>
          </div>

          <!-- Recipes Display Starts here-->
          <div class="col-md-9">
            <h2>Most Recently Added Recipes</h2>
              <div class="row row-cols-1 row-cols-md-3 g-4"> 
                <?php foreach ($recentRecipes as $recipe): ?>
                  <div class="col">
                    <div class="card h-100">
                      <img src="<?php echo htmlspecialchars($recipe['imagePath']); ?>" class="card-img-top" alt="Recipe Image">
                        <div class="card-body">
                          <h5 class="card-title"><?php echo htmlspecialchars($recipe['recipeName']); ?></h5>
                          <p class="card-text"><?php echo substr(htmlspecialchars($recipe['ingredients']), 0, 100) . '...'; ?></p>
                          <div>

                            <?php
                            $averageRating = round($recipe['averageRating']);
                            for ($i = 0; $i < $averageRating; $i++) {
                                echo '<i class="fa fa-star" style="color: gold;"></i>';
                            }
                            if (floor($recipe['averageRating']) < $recipe['averageRating']) {
                                echo '<i class="fa fa-star-half-o" style="color: gold;"></i>';
                                $averageRating++;
                            }
                            for ($i = $averageRating; $i < 5; $i++) {
                                echo '<i class="fa fa-star-o" style="color: gold;"></i>';
                            }
                            ?>
                          </div>
                          <a href="recipe_detail.php?id=<?php echo $recipe['id']; ?>" class="btn btn-primary">View Recipe</a>

                          <!-- Share Icons here -->
                          <div>
                              <a href="https://www.facebook.com/sharer/sharer.php?u=YourRecipePageURL" target="_blank" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                              <a href="https://instagram.com" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                          </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        </div>
      </section> 
    </main>
    <!--Main Ends Here--> 

    <!--Footer Starts Here-->
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
  </div>
</footer>
<!--Footer Ends Here-->

<!--Scripts-->
<script>
document.getElementById('recipeSearch').addEventListener('input', function() {
    var inputVal = this.value; 

    if(inputVal.length > 0) {
        fetch(`searchRecipe.php?recipeName=${inputVal}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('searchSuggestions').innerHTML = data;
            });
    } else {
        document.getElementById('searchSuggestions').innerHTML = "";
    }
});


function setSearchValue(value) {
    document.getElementById('recipeSearch').value = value;
    document.getElementById('searchSuggestions').innerHTML = "";
}


document.getElementById('searchSuggestions').addEventListener('click', function(e) {
    if(e.target && e.target.matches("div.searchSuggestion")) {
        setSearchValue(e.target.innerText);
    }
});
</script>


    <!-- JS bundle for Bootstrap -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"
    ></script>
   
  </body>
   <!--Body Ends Here-->
</html>
