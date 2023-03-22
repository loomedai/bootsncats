<?php
namespace Phppot;

use \Phppot\Member;
if (! empty($_POST["login"])) {
    session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];
    require_once (__DIR__ . "/class/Member.php");
    
    $member = new Member();
    $isLoggedIn = $member->processLogin($username, $password);
    if (! $isLoggedIn) {
        $_SESSION["errorMessage"] = "Invalid Credentials";
    }
    header("Location: ./index.php");
    exit();
}