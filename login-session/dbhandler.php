<?php
$dbc = mysqli_connect('localhost', 'root', '', 'bookshop');

if (!$dbc) {
    echo  "Error: Unable to connect to MySQL" . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>