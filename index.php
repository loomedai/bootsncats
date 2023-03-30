<?php
require_once 'class/booksDb.php';

$bookshop = new booksDb(); // Create an instance of the Bookshop class
$books = $bookshop->getBooks(); // Call the getBooks() method to retrieve data
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="src/css/style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-success text-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="book-container">
    <?php $i = 0; ?>
    <?php foreach ($books as $book): ?>
    <?php if($i % 5== 0): ?>
    <?php if($i != 0): ?>
</div>
<?php endif; ?>
<div class="row justify-content-between" >
    <?php endif; ?>
    <div class="card col-sm-2 px-2 m-1">
        <img src="<?php echo $book['imgPath']; ?>" alt="">
        <div class="book-info" style="height: 14em;">
            <h5 class="bookTitle"><?php echo $book['Title']; ?></h5>
            <p class="bookDesc h-50 overflow-hidden"><?php echo $book['Description']; ?></p>
           <div class="buy d-flex justify-content-between">
               <p class="bookPrice position-absolute bottom-0 start-0 p-1 m-1"><?php echo $book['Price']; ?></p>
               <a href="" class="btn position-absolute bottom-0 end-0 bg-success p-1 m-1">Add to cart</a>
           </div>
        </div>
    </div>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php if($i % 5 != 0): ?>
        <?php echo str_repeat('<div class="card col-sm-2"></div>', 4 - ($i % 4)); ?>
    <?php endif; ?>
</div>
</div>




<div class="book-container">


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
