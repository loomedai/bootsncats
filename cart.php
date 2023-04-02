<?php
session_start();

require_once 'class/booksDb.php';

// Check if the add-to-cart action was set
if (isset($_POST['add_to_cart'])) {
    // Get the product title, price, and quantity from the form
    $Bid = $_POST['Bid'];
    $Title = $_POST['Title'];
    $Price = $_POST['Price'];
    $quantity = $_POST['quantity'];

    // Create an array with the product details
    $product = array(
        'Bid' => $Bid,
        'Title' => $Title,
        'Price' => $Price,
        'quantity' => $quantity
    );

    // Check if the shopping cart session already exists
    if(isset($_SESSION['cart'])) {
        // Check if the product already exists in the shopping cart
        $product_exists = false;
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['Bid'] === $Bid) {
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

// Check if the cart action was set
if (isset($_GET['action']) && $_GET['action'] == 'empty') {
    // Empty the shopping cart session
    unset($_SESSION['cart']);
}

// Check if the update action was set
if (isset($_GET['action']) && $_GET['action'] == 'update') {
    // Update the quantity of the selected item in the shopping cart
    foreach ($_SESSION["cart"] as $key => $item) {
        if ($item["Bid"] == $_GET['Bid']) {
            $_SESSION["cart"][$key]["quantity"] = $_POST["quantity"];
            break;
        }
    }
}

// Check if the remove action was set
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    // Remove the selected item from the shopping cart
    foreach ($_SESSION["cart"] as $key => $item) {
        if ($item["Bid"] == $_GET['Bid']) {
            unset($_SESSION["cart"][$key]);
            break;
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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"  crossorigin="anonymous">
    <link href="src/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-success text-white">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">The Booktique</a>
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
                    <a class="nav-link text-white" href="login-session/login-secure.php">Login</a>
                </li>
                <li class="nav-item end-0">
                    <a class="nav-link text-white" href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Cart -->
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>
    <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
    <?php
    if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th >Title</th>
                <th >Quantity</th>
                <th >Price</th>
                <th >Remove</th>
            </tr>
            <?php
            foreach ($_SESSION["cart"] as $item){
                $item_price = $item["quantity"]*$item["Price"];
                ?>
                <tr>
                    <td><?php echo $item["Title"]; ?></td>
                    <td style="text-align:right;">
                        <form method="post" action="cart.php?action=update&Bid=<?php echo $item["Bid"]; ?>">
                            <input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" min="1" max="10">
                            <button type="submit" name="update_quantity">Update</button>
                        </form>
                    </td>
                    <td style="text-align:right;"><?php echo number_format($item["Price"]*$item["quantity"], 2). "kr"; ?></td>
                    <td style="text-align:center;"><a href="cart.php?action=remove&Bid=<?php echo $item["Bid"]; ?>" class="btnRemoveAction"><p>Remove book</p></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["Price"]*$item["quantity"]);
            }
            ?>
            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><strong><?php echo number_format($total_price, 2). "kr"; ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }
    ?>
    <a id="btnEmpty" href="cart.php?action=empty" class="btn checkout bg-success p-1 m-2 text-white" onclick="alert('Thank you for your order!')">Check Out</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
