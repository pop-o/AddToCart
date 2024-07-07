<?php
session_start();
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        foreach ($_SESSION['cart'] as $product) {
            $product_name = $product['product'];
            $price = $product['price'];
            $sql = "INSERT INTO orders (user_id, product_name, price) VALUES ('$user_id', '$product_name', '$price')";
            $conn->query($sql);
        }
        unset($_SESSION['cart']);
        echo "Signup successful! Order placed.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
    <h2>Signup Form</h2>
    <form method="post">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </p>
        <button type="submit" name="signup">Sign Up and Place Order</button>
    </form>
</body>
</html>
