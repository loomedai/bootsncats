<?php
session_start();

require_once 'class/booksDb.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="src/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-success text-white">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">The Booktique</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="index.php">Books</a>
                </li>
                <li class="nav-item end-0">
                    <a class="nav-link active text-white" href="cart.php">Cart</a>
                </li>

            </ul>
        </div>
    </div>
</nav>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
