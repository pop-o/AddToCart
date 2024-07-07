<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product = $_POST['product'];
    $user_id = $_SESSION['user_id'];
$price=$_POST['price'];
    $sql = "INSERT INTO orders (user_id, product_name,price) VALUES ('$user_id', '$product','$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h2>Products</h2>
    <form method="post">
        <input type="hidden" name="product" value="Product1">
        Product 1
        <input type="number" name="price" value="1000">
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
    <form method="post">
        <input type="hidden" name="product" value="Product2">
        Product 2
        <input type="number" name="price" value="500">
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>
</body>
</html>

