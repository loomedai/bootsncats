<?php
@include 'config.php';

$Bid = $_GET['edit'];

if(isset($_POST["update_book"])) {
    $book_title = addslashes($_POST['book_title']);
    $book_text = addslashes($_POST['book_text']);
    $book_price = $_POST['book_price'];
    $book_image = $_FILES['book_image']['name'];
    $book_image_tmp_name = $_FILES['book_image']['tmp_name'];
    $book_image_folder = 'uploads/'.$book_image;

    if(empty($book_title) || empty($book_text) || empty($book_price) || empty($book_image)){
        $message[] = "All fields required";
    }else{
        $update = "UPDATE books SET Title='$book_title', img='$book_image', Description='$book_text', Price='$book_price' WHERE Bid = $Bid";

        //  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $upload = mysqli_query($connect, $update);
        if($upload){
            move_uploaded_file($book_image_tmp_name,$book_image_folder);
            $message[] = 'the book has been added successfully';
        } else{
            $message[] ='could not add the book. Please contact IT-support';
        }
    }

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" type="text/css">

</head>
<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<span class="microMessage">' .$message. '</span>';
    }
}
?>

<div class="container">
    <div class="admin-product-form-container centered pt-3">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <?php
            // Add code to retrieve book title based on ID
            $query = "SELECT * FROM books WHERE Bid = $Bid";
            $result = mysqli_query($connect, $query);
            $row = mysqli_fetch_assoc($result);
            ?>
            <h3>Update <?php echo $row['Title']?></h3>
            <input type="text" placeholder="enter book title" name="book_title" class="box" value="<?php echo $row['Title']; ?>">
            <input type="text" placeholder="enter book description" name="book_text" class="box" value="<?php echo $row['Description']; ?>">
            <input type="" placeholder="enter book price" name="book_price" class="box" value="<?php echo $row['Price']; ?>">
            <input type="file" accept="image/png, image/jpeg, image/jpg, image/gif" name="book_image" class="box">
            <input type="submit" class="btn bg-success text-white" name="update_book" value="Update book">
            <a href="adminpanel.php" class="btn bg-warning text-white">Go back</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
