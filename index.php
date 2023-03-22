<?php
session_start();
if(!empty($_SESSION["userId"])) {
    require_once __DIR__ . '/view/dashboard.php';
} else {
    require_once __DIR__ . '/view/login-form.php';
}
?>

<html>

<h1>hello world</h1>

</html>
