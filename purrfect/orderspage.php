<?php
session_start();
include_once 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE userid = ? AND status = 'NotReceived' ORDER BY order_date DESC"; // Added ORDER BY clause
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
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
/* General page styling */
.shoppingcart {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h1 {
    color: #333;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #C55A11;
    color: white;
}

td img {
    margin-right: 10px;
    vertical-align: middle;
}

/* Ensure each cell occupies one column width */
table td {
    width: auto;
    text-align: left;
}

/* Align specific columns to the right */
table td:nth-child(2), 
table td:nth-child(3), 
table td:nth-child(4), 
table td:nth-child(5) {
    text-align: right;
}

/* Button styling */
input[type="submit"] {
    background-color: #474847;
    color: white;
    padding: 6px 10px;
    margin: 4px 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #C55A11;
}

input[type="number"] {
    background-color: transparent;
    color: #333;
    padding: 6px;
    margin: 4px 2px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Checkout link styling */
.shpcrt {
    text-align: right;
}

a {
    display: inline-block;
    background-color: #C55A11;
    color: white;
    padding: 10px 20px;
    margin: 20px 0;
    text-decoration: none;
    border-radius: 5px;
}

.first {
    margin-right: 10px;
}

a:hover {
    background-color: #b95613;
}
</style>
<body>
    
    <?php if (empty($result)): ?>
        <div class="empty-cart" style="background-image: url('/purrfect/images/Background/gen.png'); background-size: cover; justify-content:center; align-items: center; width: 100%; height: 98vh; display: flex; flex-direction: column;">
            <p style="font-size: 30px;">You haven't ordered anything yet.</p>
            <div style="margin-top: 20px;">
                <a href="products.php" class="first">Shop</a>
                <a href="shoppingcart.php" class="second">Shopping Cart</a>
            </div>
        </div>
    <?php else: ?>
        <h1>My Orders</h1>
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

                // Retrieve products ordered for each order
                $stmt = $conn->prepare("SELECT products.product_name, order_items.quantity FROM order_items INNER JOIN products ON order_items.productid = products.product_id WHERE orderid = ?");
                $stmt->bind_param("i", $orderId);
                $stmt->execute();
                $resultItems = $stmt->get_result();
                ?>
                <tr>
                    <td><strong>Name: </strong><?php echo $Fname; ?></td>
                    <td><strong>Contact Number: </strong><?php echo $contactnum; ?></td>
                    <td><strong>Address: </strong><?php echo $address; ?></td>
                    <td><strong>Mode of Payment: </strong><?php echo $paymentMode; ?></td>
                    <td><strong>Total Price: </strong><?php echo $totalPrice; ?></td>
                    <td><strong>Date Ordered: </strong><?php echo $dateOrdered; ?></td>
                    <td><strong>Products Ordered: </strong>
                        <ul>
                            <?php while ($item = $resultItems->fetch_assoc()): ?>
                                <li><?php echo "{$item['product_name']} - Quantity: {$item['quantity']}"; ?></li>
                            <?php endwhile; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <!-- Add a button for "Order Received" -->
                    <td>
                        <form action="order_received.php" method="post" onsubmit="return confirm('Are you sure you want to confirm receiving this order?');">
                            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                            <input type="submit" value="Order Received">
                        </form>
                    </td>
                </tr>
                <tr><td colspan="9">&nbsp;</td></tr> <!-- Add an empty row as a separator -->
            <?php endforeach; ?>
        </table>
        <div  style="text-align: right;">
            <a href="products.php" class="first">Back</a>
            <a href="shoppingcart.php" class="second">Shopping Cart</a>
        </div>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
