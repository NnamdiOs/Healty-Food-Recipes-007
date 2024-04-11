<?php
include('connection.php');

$username = $_POST['username'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$role = $_POST['role'] ?? '';

if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

// To check for duplicate username across both users and chefs tables
$usernameCheckQuery = "SELECT 1 FROM users WHERE username = :username UNION SELECT 1 FROM chefs WHERE username = :username";
$stmt = $conn->prepare($usernameCheckQuery);
$stmt->execute([':username' => $username]);
if ($stmt->rowCount() > 0) {
    die("Username already taken.");
}

// To check for duplicate email addresses across both users and chefs tables
$emailCheckQuery = "SELECT 1 FROM users WHERE email = :email UNION SELECT 1 FROM chefs WHERE email = :email";
$stmt = $conn->prepare($emailCheckQuery);
$stmt->execute([':email' => $email]);
if ($stmt->rowCount() > 0) {
    die("Email already in use.");
}

if ($role === 'chef') {
    $bio = $_POST['bio'] ?? '';
    $title = $_POST['title'] ?? '';
    $location = $_POST['location'] ?? '';
    $targetDir = "uploads/";
    $photo = $_FILES['photo'] ?? null;
    $targetFile = $photo ? $targetDir . basename($photo["name"]) : '';
    if ($photo && move_uploaded_file($photo["tmp_name"], $targetFile)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO chefs (username, ChefName, Email, Password, Biography, ProfilePhoto, ProfessionalTitle, Location) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$username, $name, $email, $hashedPassword, $bio, $targetFile, $title, $location])) {
            header("Location: success.html");
            exit;
        } else {
            echo "Error: Could not execute the query.";
        }
    } else {
        echo "Error: There was an error uploading the profile photo.";
    }
} elseif ($role === 'seeker') {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, FullName, Email, Password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$username, $name, $email, $hashedPassword])) {
        header("Location: success.html");
        exit;
    } else {
        echo "Error: Could not execute the query.";
    }
} else {
    echo "Invalid role selected.";
}
?>
