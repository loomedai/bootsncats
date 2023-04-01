<?php
$q = "SELECT * FROM users WHERE username = '$userName' AND password = '$password'";
$result = mysqli_query($dbc, $q);
if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if ($password == $row['password']) {
        $_SESSION['message'] = "Welcome " . $row['first_name'] . ". You are logged in";
    }else {
        $_SESSION['message'] = "Dear Hacker! here is nothing for you. Please go away";
    }
}else {
    $_SESSION['message'] = "Your username or password is incorrect";
}
header("Location: index.php");