<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="../src/css/style.css" rel="stylesheet" type="text/css">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownBooks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Books
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownBooks">
                        <li><a class="dropdown-item" href="#">Mystery</a></li>
                        <li><a class="dropdown-item" href="#">Romance</a></li>
                        <li><a class="dropdown-item" href="#">Science Fiction</a></li>
                    </ul>
                </li>
                <li class="nav-item end-0">
                    <a class="nav-link text-white" href="login-session/form.php">Login</a>
                </li>
                <li class="nav-item end-0">
                    <a class="nav-link text-white" href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']) {
    echo '<p>You are logged in as an admin. <a href="../src/admin/adminpanel.php">Go to admin panel</a></p>';
} else {
    // Show login form
    ?>
    <form action="login-secure.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </fieldset>
    </form>

    <?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>
    <?php
}
?>
    
    <form action="signup.php" method="post">
        <fieldset>
            <h1>Sign Up</h1>
            <input type="text" name="first_name" placeholder="First Name">
            <input type="text" name="last_name" placeholder="Last Name">
            <input type="text" name="email" placeholder="Email">
            <input type="text" name="username" placeholder="User Name">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Sign Up</button>
        </fieldset>
    </form>
    
    <form action="logout.php" method="post">
        <button type="submit">Log Out</button>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>














