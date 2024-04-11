

<?php
// login handeler
session_start(); 
include('connection.php'); 

if (isset($_POST['login_btn'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? ''; 

    // Handling login for chefs (including admins)
    if ($role === 'chef') {
        $sql = "SELECT * FROM chefs WHERE username = ?";

    // Handling login for recipe seekers
    } elseif ($role === 'seeker') {
        $sql = "SELECT * FROM users WHERE username = ?";
    } else {
        echo "Invalid role selected.";
        exit();
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        $passwordField = ($role === 'chef') ? $user['Password'] : $user['password']; 
        if (password_verify($password, $passwordField)) {
           
            $_SESSION['logged_in_user'] = $user['username'];
            $_SESSION['user_fullname'] = $user['ChefName'] ?? $user['FullName']; 
            $_SESSION['userId'] = $user['ChefID'] ?? $user['id']; 
            
            
            if ($role === 'chef') {
                $_SESSION['user_role'] = $user['isAdmin'] ? 'admin' : 'chef';
                $redirectLocation = $user['isAdmin'] ? "admin_panel.php" : "Cooks_Dash.php";
            } elseif ($role === 'seeker') {
                $_SESSION['user_role'] = 'seeker';
                $redirectLocation = "Seekers_Dash.php";
            }
            
            header("Location: $redirectLocation");
            exit();
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "User not found.";
    }
}
?>
