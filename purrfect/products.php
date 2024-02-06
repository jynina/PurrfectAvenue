<?php //redirected to dashboard if nakalogin na sila
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Include database connection code (e.g., db_connection.php)
include 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="products">
        <header>
            <a href="dashboard.php"><img src="images/Background/logo.png" class="logo"></a>
            <div class="nav-bar">
                <div class="toggle"></div>
                <ul class="navigation">
                <?php 
                    if (isset($_SESSION['user_id'])) {
                    
                        $user_id = $_SESSION['user_id'];
                    
                        $sql = "SELECT is_admin FROM users WHERE user_id = $user_id";
                        $result = mysqli_query($conn, $sql);
                        
                        // Check if the query was successful
                        if ($result) {
                            $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                            // Check if the user is an admin
                            if ($admin['is_admin'] == 1) {
                                echo "<li><a href='postproduct.php'>Post Product</a></li>";
                            }
                        }
                    }
                    ?>
                    <li><a href="shoppingcart.php">Cart</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="#" onclick="logoutAlert()">Log Out</a></li> <!-- logout in javascript -->
                    
                </ul>
            </div>
        </header>
        
        <div class="category category-1">
            <div class="ecart">
                <div class="ecart-header cursor" onclick="toggleCart()">
                    <h3>View Cart</h3>
                </div>
                <div class="cart" id="cart">
                    <h2>Shopping Cart</h2>
                    <div id="cart-content"></div>
                    <div id="total"></div>
                </div>
            </div>
            <?php

            // Retrieve product data from the database
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            // Organize products by product group
            $productsByGroup = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $productsByGroup[$row['product_group']][] = $row;
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
            <!-- Category Template START-->
            <?php
                $categoryHeaders = [
                'food' => 'Pet Food',
                'health' => 'Health and Wellness Products',
                'accessory' => 'Collars, Leashes, and Harnesses',
                'toy' => 'Toys for Pets',
                'bedcage' => 'Beddings and Cages',
                'supplies' => 'Grooming Supplies',
                'utility' => 'Pet Utilities',
                ];
                foreach ($productsByGroup as $group => $products) {
                echo '<div class="header-title">';
                // Get the corresponding header from the mapping array, or use the group name if not found
                $categoryHeader = isset($categoryHeaders[$group]) ? $categoryHeaders[$group] : $group;
                echo '<h1>' . htmlspecialchars($categoryHeader) . '</h1>';
                echo '</div>';
                echo '<div class="grid-container">';

                // Loop through products in the current group
                foreach ($products as $product) {
                    echo '<div class="product-card">';
                    echo '<div class="product-image" style="background-image: url(\'' . $product['image_url'] . '\');"></div>';
                    echo '<div class="product-details">';
                    echo '<div class="product-name">' . $product['product_name'] . '</div>';
                    echo '<div class="product-description">' . $product['product_desc'] . '</div>';
                    echo '<div class="product-price">$' . $product['product_price'] . '</div>';
                    echo '<button class="add-to-cart" onclick="addToCart(\'' . $product['product_name'] . '\', \'' . $group . '\', ' . $product['product_price'] . ')" >Add to Cart</button>';
                    // echo '<button class="add-to-cart" onclick="addToCart(\'' . $product['product_name'] . '\', \'' . $group . '\', ' . $product['product_price'] . ')" >Add to Cart</button>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>'; // Close the grid-container for the current product group
            }
            ?>
        </div> 
	<script src = "app.js"></script>
    </section>
</body>
</html>