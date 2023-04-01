<?php
session_start();
?>
<html>
<head>
    <title>Login</title>
</head>
<body>
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
    </body>
</html>














