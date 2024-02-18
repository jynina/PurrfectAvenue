<?php
session_start();
include_once 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE userid = ? AND status = 'Received' ORDER BY received_date DESC"; // Fetch only received orders and sort by received date
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php if (empty($result)): ?>
        <div class="empty-cart" style="background-image: url('/purrfect/images/Background/gen.png'); background-size: cover; justify-content:center; align-items: center; width: 100%; height: 98vh; display: flex; flex-direction: column;">
            <p style="font-size: 30px;">No order history available.</p>
            <div style="margin-top: 20px;">
                <a href="products.php" class="first">Shop</a>
                <a href="shoppingcart.php" class="second">Shopping Cart</a>
            </div>
        </div>
    <?php else: ?>
        <h1>Order History</h1>
        <table>
            <?php foreach ($result as $row): ?>
                <?php
                $orderId = $row['orderid'];
                $Fname = $row['name'];
                $contactnum = $row['contact_num'];
                $address = $row['address'];
                $paymentMode = $row['mode_of_payment'];
                $totalPrice = $row['total_price'];
                $dateOrdered = $row['order_date'];
                $dateReceived = $row['received_date'];

                // Retrieve products ordered for each order
                $stmt = $conn->prepare("SELECT products.product_name, order_items.quantity FROM order_items INNER JOIN products ON order_items.productid = products.product_id WHERE orderid = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                $resultItems = $stmt->get_result();
                ?>
                <tr>
                    <td><strong>Date Received: </strong><?php echo $dateReceived; ?></td>
                    <td><strong>Date Ordered: </strong><?php echo $dateOrdered; ?></td>
                    <td><strong>Name: </strong><?php echo $Fname; ?></td>
                    <td><strong>Contact Number: </strong><?php echo $contactnum; ?></td>
                    <td><strong>Address: </strong><?php echo $address; ?></td>
                    <td><strong>Mode of Payment: </strong><?php echo $paymentMode; ?></td>
                    <td><strong>Total Price: </strong><?php echo $totalPrice; ?></td>
                    <td><strong>Products Ordered: </strong>
                        <ul>
                            <?php while ($item = $resultItems->fetch_assoc()): ?>
                                <li><?php echo "{$item['product_name']} - Quantity: {$item['quantity']}"; ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </td>
                </tr>
                <tr><td colspan="9">&nbsp;</td></tr> <!-- Add an empty row as a separator -->
            <?php endforeach; ?>
        </table>
        <div  style="text-align: right;">
            <a href="products.php" class="first">Back to Shop</a>
            <a href="shoppingcart.php" class="second">Shopping Cart</a>
        </div>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>