<?php
session_start();
require_once ('dbhandler.php');

$firstName = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
$userName = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

//check if the form is posted and the form values are not empty then run the code
if(($_SERVER['REQUEST_METHOD'] == 'POST') && !EmptyFormValue(array($firstName,$lastName,$userName,$email,$password))) {

    $q = "INSERT INTO users (username, password, email, first_name, last_name) Values ('$userName', '$password', '$email', '$firstName', '$lastName',)";

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

header ("Location: form.php");


function EmptyFormValue($vars){
    foreach ($vars as $var) {
        if(empty($var)) {
            return true;
        }
    }
    return false;
}

?>






