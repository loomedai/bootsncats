<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../login-session/form.php");
    exit;
}

@include 'config.php';
@include '../../login-session/dbhandler.phpp';


if(isset($_POST["add_book"])) {
    $book_title = addslashes($_POST['book_title']);
    $book_text = addslashes($_POST['book_text']);
    $book_price = $_POST['book_price'];
    $book_image = $_FILES['book_image']['name'];
    $book_image_tmp_name = $_FILES['book_image']['tmp_name'];
    $book_image_folder = 'uploads/'.$book_image;

    if(empty($book_title) || empty($book_text) || empty($book_price) || empty($book_image)){
        $message[] = "All fields required";
    }else{
        $insert = "INSERT INTO books(title, img, Description, Price) VALUES('$book_title','$book_image','$book_text','$book_price')";

      //  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upload = mysqli_query($connect, $insert);
        if($upload){
            move_uploaded_file($book_image_tmp_name,$book_image_folder);
            $message[] = 'the book has been added successfully';
        } else{
            $message[] ='could not add the book. Please contact IT-support';
        }
    }

}

if(isset($_GET['delete']) && is_numeric($_GET['delete'])){
    $Bid = filter_var($_GET['delete'], FILTER_SANITIZE_NUMBER_INT);
    $Bid = intval($Bid);
    mysqli_query($connect, "DELETE FROM books WHERE Bid = $Bid");
    header('location:adminpanel.php');
};



?>
<html lang="en">
<head>
    <meta charset="UFT-8">
    <title>Admin page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" type="text/css">

</head>
<body>

<nav class="navbar navbar-expand-lg bg-success text-white">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="../../index.php">The Booktique</a>
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
                    <a class="nav-link text-white" href="../../login-session/form.php">Login</a>
                </li>
                <li class="nav-item end-0">
                    <a class="nav-link text-white" href="../../cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<span class="microMessage">' .$message. '</span>';
    }
}
?>

<div class="container">

    <div class="admin-product-form-container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Add a new book</h3>
            <input type="text" placeholder="enter book title" name="book_title" class="box">
            <input type="text" placeholder="enter book description" name="book_text" class="box">
            <input type="" placeholder="enter book price" name="book_price" class="box">
            <input type="file" accept="image/png, image/jpeg, image/jpg, image/gif" name="book_image" class="box">
            <input type="submit" class="btn bg-success text-white" name="add_book" value="add book">
        </form>
    </div>

</div>

<?php

    $select = mysqli_query($connect, "SELECT * FROM books");
?>

<div class="bookPanel">
    <table class="bookPanel-table">
        <thead>
            <tr>
                <th>Cover Image</th>
                <th>Book Title</th>
                <th>Price</th>
                <th colspan="2">Update</th>
            </tr>
        </thead>

        <?php
    while($row = mysqli_fetch_assoc($select)){

        ?>

        <tr>
            <td><img src="uploads/<?php echo $row['img']; ?>" height="100px"></td>
            <td><?php echo $row['Title']; ?> </td>
            <td><?php echo $row['Price']; ?><p class="kr"> kr.</p></td>
            <td>
                <a href="update.php?edit=<?php echo $row['Bid']; ?>" class="btn bg-success text-white"> </i> Edit</a>
                <a href="adminpanel.php?delete=<?php echo $row['Bid']; ?>" class="btn bg-danger text-white"> </i> Delete</a>
            </td>
        </tr>
        <?php
    };
        ?>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

