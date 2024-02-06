<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="shopping-cart">
        <header>
	        <a href="products.php"><img src="images/Background/back-arrow.png" class="logo"></a>  
            <h1>Shopping Cart</h1>
        </header>
        <div class="cart-items">
            <?php
            // Retrieve cart items from the session or database
            // Replace this with your actual logic to fetch cart items
            include 'database.php';
            $sql = "SELECT * FROM shopping_cart";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Error fetching cart items: " . mysqli_error($conn));
            }
            
            $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
            

            foreach ($cartItems as $item) {
                echo '<div class="cart-item">';
                echo '<div class="item-details">';
                echo '<span class="item-name">' . $item['product_name'] . '</span>';
                echo '<span class="item-price">$' . $item['product_price'] . '</span>';
                echo '</div>';
                echo '<div class="item-actions">';
                echo '<form action="cartActions.php" method="post">';
                echo '<input type="hidden" name="action" value="delete">';
                echo '<input type="hidden" name="cart_item_id" value="' . $item['id'] . '">';
                echo '<button type="submit">Delete</button>';
                echo '</form>';
                echo '<form action="cartActions.php" method="post">';
                echo '<input type="hidden" name="action" value="update_quantity">';
                echo '<input type="hidden" name="cart_item_id" value="' . $item['id'] . '">';
                echo '<input type="number" name="new_quantity" value="' . $item['quantity'] . '" min="1">';
                echo '<button type="submit">Update Quantity</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="cart-total">
            <?php
            // Calculate and display total price
            $totalPrice = array_sum(array_column($cartItems, 'product_price'));
            echo '<h2>Total: $' . $totalPrice . '</h2>';
            ?>
            <form action="checkout.php" method="post">
                <button type="submit">Proceed to Checkout</button>
            </form>
        </div>
    </section>
    <script src = "app.js"></script>
</body>
</html>