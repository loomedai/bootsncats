<?php
session_start();
require_once ('dbhandler.php');

$firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
$userName = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

$name_pattern = "/^[a-zA-Z ]{2,30}$/"; // Name must be 2-30 characters long and contain only letters and spaces.
$username_pattern = "/^[a-zA-Z0-9_-]{3,20}$/"; // Username must be 3-20 characters long, and can contain letters, numbers, underscores, and hyphens.
$email_pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; // Email must be a valid email address.
$password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=]{8,}$/";

//check if the form is posted and the form values are not empty then run the code
if(($_SERVER['REQUEST_METHOD'] == 'POST') && !EmptyFormValue(array($firstName,$lastName,$userName,$email,$password))) {

    $q = "INSERT INTO users (username, password, email, first_name, last_name) Values ('$userName', '$password', '$email', '$firstName', '$lastName')";

    $result = mysqli_query($dbc, $q);

    if (mysqli_affected_rows($dbc) == 1) {

        //echo "You are created in the system";
        $_SESSION['message'] = "User added. You can now buy books.";

    } else {

        //echo mysqli_error($dbc);
          $_SESSION['message'] = mysqli_error($dbc);
    } 
} else {
     $_SESSION['message'] = "<span style='color: red'>All fields are required </span>";
}

header ("Location: ../index.php");


function EmptyFormValue($vars){
    foreach ($vars as $var) {
        if(empty($var)) {
            return true;
        }
    }
    return false;
}

?>






