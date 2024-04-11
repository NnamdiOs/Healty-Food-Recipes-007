<!--php TO Fetch database info Starts--> 
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input fields
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // To set the recipient email address.
    $recipient = "h.osadebay@rgu.ac.uk";
 
    // To build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // To build the email headers.
    $email_headers = "From: $name <$email>";

    // To send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo "<p>Thank you for contacting us, $name. You will get a reply within the hour.</p>";
    } else {
        echo "<p>We're sorry but the email did not go through.</p>";
    }
}
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="./css/index.css"> 
        <title>Contact Us</title>
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
        </header>
        <!--Header Ends Here-->

        <!--Main Starts Here-->
        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1>Contact Us</h1>
                    <form action="" method="post" class="bg-light p-4 rounded">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message:</label>
                            <textarea class="form-control" id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </main>
        <!--Main Ends Here-->

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
            </div>
        </footer>
        <!--Footer Ends Here-->

         <!--Scripts-->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoL1FfFyOeo9D1RvFXGjMD6fDqzdlD3BqatPYytOtag5WvOHGSH8TzkdoKppAm" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVmo1Js1p5zP/nQx+Kt2cWc6dzl53MVp3C1IbFUsi/IFdO2V" crossorigin="anonymous"></script>
    </body>
    <!--Body Ends Here-->
</html>
