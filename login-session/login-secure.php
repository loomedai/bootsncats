<?php
session_start();
@include('dbhandler.php');

$host = "localhost";
$user = "root";
$password = "";
$database = "bookshop";

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists in the database
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
echo $query; // add this line to print out the query
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Check if the user is an admin
    if ($row['role'] == 'admin') {
        // Set the admin session variable
        $_SESSION['admin'] = true;
        header("Location: ../src/admin/adminpanel.php");
    } else {
        // Set the regular user session variable
        $_SESSION['user'] = true;
        header("Location: ../index.php");
    }
} else {
    $_SESSION['message'] = "Invalid username or password";
    header("Location: form.php");
}
?>

