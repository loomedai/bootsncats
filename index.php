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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>

        </ul>
    </div>
</nav>

<div class="book-container" style="margin-outside: 300px">
    <?php $i = 0; ?>
    <?php foreach ($books as $book): ?>
    <?php if($i % 4 == 0): ?>
    <?php if($i != 0): ?>
</div>
<?php endif; ?>
<div class="row mt-3" >
    <?php endif; ?>
    <div class="card col-sm-3 px-2">
        <img src="<?php echo $book['imgPath']; ?>" alt="">
        <div class="">
            <h5 class="bookTitle"><?php echo $book['Title']; ?></h5>
            <p class="bookDesc"><?php echo $book['Description']; ?></p>
            <p class="bookPrice"><?php echo $book['Price']; ?></p>
        </div>
    </div>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php if($i % 4 != 0): ?>
        <?php echo str_repeat('<div class="card col-sm-3"></div>', 4 - ($i % 4)); ?>
    <?php endif; ?>
</div>
</div>




<div class="book-container">


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
