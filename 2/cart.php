<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['empty_cart'])) {
    $sql = "DELETE FROM orders";
    if ($conn->query($sql) === TRUE) {
        echo "Cart emptied successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$sql="select * from orders";
$result=$conn->query($sql);

$total=0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
</head>
<body>
    <h2>Cart</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Price</th>
        </tr>
        <?php
        
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                $total+=$row["price"];
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                
                
                
                echo "</tr>";
                
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <h1>Total is: <?php echo $total?></h1>
    <form method="post">

        <button type="submit" name="empty_cart">Empty Cart</button>
    </form>
</body>
</html>