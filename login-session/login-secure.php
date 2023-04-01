<?php
session_start();
@include('dbhandler.php');

$host = "localhost";
$user = "root";
$password = "";
$database = "bookshop";


$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $username_pattern = "/^[a-zA-Z0-9_-]{3,20}$/";
    $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=]{8,}$/";

    // Check if the username matches the pattern
    if (!preg_match($username_pattern, $username)) {
        $_SESSION['message'] = "Invalid username format";
        header("Location: form.php");
        exit();
    }

    // Check if the password matches the pattern
    if (!preg_match($password_pattern, $password)) {
        $_SESSION['message'] = "Invalid password format";
        header("Location: form.php");
        exit();
    }

    // Check if the user exists in the database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);


        if ($row['role'] == 'admin') {
            // Set the admin session variable
            $_SESSION['admin'] = true;
            header("Location: ../src/admin/adminpanel.php");
            exit();
        } else {
            // Set the regular user session variable
            $_SESSION['user'] = true;
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid username or password";
        header("Location: form.php");
        exit();
    }
}
?>
