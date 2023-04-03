<?php
session_start();

require_once 'class/booksDb.php';

$bookshop = new booksDb(); // Create an instance of the Bookshop class
$books = $bookshop->getBooks(); // Call the getBooks() method to retrieve data


// Check if the "add to cart" button was clicked
if(isset($_POST['add_to_cart'])) {
    $Title = $_POST['Title'];
    $Price = $_POST['Price'];
    $quantity = $_POST['quantity'];

    // Create an array with the product details
    $product = array(
        'Title' => $Title,
        'Price' => $Price,
        'quantity' => $quantity
    );

    // Check if the shopping cart session already exists
    if(isset($_SESSION['cart'])) {
        // Check if the product already exists in the shopping cart
        $product_exists = false;
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['Title'] === $Title) {
                // If the product already exists, update the quantity
                $_SESSION['cart'][$key]['quantity'] += $quantity;
                $product_exists = true;
                break;
            }
        }

        // If the product doesn't already exist, add it to the shopping cart
        if(!$product_exists) {
            array_push($_SESSION['cart'], $product);
        }
    } else {
        // If the shopping cart session doesn't exist, create it and add the product
        $_SESSION['cart'] = array($product);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="src/css/style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
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
            <form method="post" action="cart.php">
                <div class="buy d-flex justify-content-between">
                    <p class="bookPrice position-absolute bottom-0 start-0 p-1 m-1"><?php echo $book['Price']; ?></p>
                    <input type="hidden" name="Bid" value="<?php echo $book['Bid']; ?>">
                    <input type="hidden" name="Title" value="<?php echo $book['Title']; ?>">
                    <input type="hidden" name="Price" value="<?php echo $book['Price']; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="10">
                    <button type="submit" name="add_to_cart" class="btn bg-success position-absolute bottom-0 end-0 p-1 m-1">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php if($i % 5 != 0): ?>
        <?php echo str_repeat('<div class="card col-sm-2"></div>', 4 - ($i % 4)); ?>
    <?php endif; ?>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
