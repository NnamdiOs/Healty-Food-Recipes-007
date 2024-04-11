<?php
session_start();
require 'connection.php';

// To redirect Chefs and Recipe Seekers
if (!isset($_SESSION['logged_in_user']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// To ensure items/users are deleted sucessfully
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    switch ($_GET['action']) {
        case 'deleteChef':
            $stmt = $conn->prepare("DELETE FROM chefs WHERE ChefID = :id");
            $stmt->execute([':id' => $id]);
            break;
        case 'deleteRecipe':
            $stmt = $conn->prepare("DELETE FROM recipes WHERE id = :id");
            $stmt->execute([':id' => $id]);
            break;
        case 'deleteUser':
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            break;
    }
    header("Location: ".$_SERVER['PHP_SELF']); 
    exit;
}


// To fetch data from database for display
$chefs = $conn->query("SELECT ChefID, ChefName, ProfilePhoto FROM chefs ORDER BY ChefID ASC")->fetchAll(PDO::FETCH_ASSOC);
$recipes = $conn->query("SELECT id, recipeName, ChefID FROM recipes ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$users = $conn->query("SELECT id, FullName, username, role FROM users ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

// To fetch counts for the chart
$numChefs = $conn->query("SELECT COUNT(*) FROM chefs")->fetchColumn();
$numRecipes = $conn->query("SELECT COUNT(*) FROM recipes")->fetchColumn();
$numSeekers = $conn->query("SELECT COUNT(*) FROM users WHERE role = 'seeker'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="./css/index.css" />
        <title>Admin Panel | Healthy Food Recipes</title>
    </head>
    <body class="homepage">
        <header>
            <!-- Navigation Bar starts here -->
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
                                <a class="nav-link active" aria-current="page" href="admin_panel.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Manage Recipes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Manage Users</a>
                            </li>
                        </ul>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </nav>
            <!-- Navigation Bar Ends here -->
        </header>
        <!-- Header Ends here -->

        <!-- Main Starts here -->
        <main class="container py-5">
            <div class="row">
                <!-- Chefs Column -->
                <div class="col-md-4">
                    <div class="chart-container p-3">
                        <h2>Activity Chart</h2>
                        <canvas id="statsChart"></canvas>
                    </div>
                    <h2>Chefs</h2>
                    <?php foreach ($chefs as $chef): ?>
                        <div class="card mb-3">
                            <img src="<?= htmlspecialchars($chef['ProfilePhoto']); ?>" class="card-img-top" alt="Chef Photo" style="width:100px; height:auto;">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($chef['ChefName']); ?></h5>
                                <a href="?action=deleteChef&id=<?= $chef['ChefID']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                            
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Recipes Column -->
                <div class="col-md-4">
                    <h2>Recipes</h2>
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($recipe['recipeName']); ?></h5>
                                <a href="?action=deleteRecipe&id=<?= $recipe['id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Users Column -->
                <div class="col-md-4">
                    <h2>Recipe Seekers</h2>
                    <?php foreach ($users as $user): ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($user['FullName']); ?> (<?= $user['role']; ?>)</h5>
                                <a href="?action=deleteUser&id=<?= $user['id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <!-- Main Ends here -->

        <!-- Footer Starts here -->
        <footer>


        </footer>
        <!-- Footer Ends here -->
        
        <!-- Java script for plotting variables against count -->
        <script>
            var ctx = document.getElementById('statsChart').getContext('2d');
            var statsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Chefs', 'Recipes', 'Seekers'],
                    datasets: [{
                        label: 'Counts',
                        data: [<?= $numChefs ?>, <?= $numRecipes ?>, <?= $numSeekers ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>
     <!-- Body Ends here -->
</html>
    
