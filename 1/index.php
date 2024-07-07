<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $product = $_POST['product'];
    $price = $_POST['price'];
    $_SESSION['cart'][] = [
        'product' => $product,
        'price' => $price
    ];
   
    header('Location: signup.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple E-commerce</title>
</head>
<body>
    <h2>Products</h2>
    <form method="post">
        <p>
            <input type="hidden" name="product" value="Product1">
            Product 1
            <input type="number" name="price" value="1990">
        </p>
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
    <form method="post">
        <p>
            <input type="hidden" name="product" value="Product2">
            Product 2
            <input type="number" name="price" value="1110">
        </p>
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
</body>
</html>
