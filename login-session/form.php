<?php
session_start();
?>
<html>
<head>
    <title>Login</title>
</head>
    <body>
    <form action="form.php" method="post">
        <fieldset>
            <legend>Login</legend>
            <input type="text" name="user-name" placeholder="User Name">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Login</button>
        </fieldset>
    </form>
    
    <?php
    if(isset($_SESSION['message'])) echo $_SESSION['message'];
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














