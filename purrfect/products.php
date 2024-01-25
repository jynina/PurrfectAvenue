<?php //redirected to dashboard if nakalogin na sila
session_start();
if (!isset($_SESSION['user'])){
    header("Location: dashboard.php");
}

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
                        require_once 'database.php';
                    
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
                    <li><a href="dashboard.php">Home</a></li>
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
            // Include the database connection file
            include "database.php";

            // Retrieve product data from the database
            $sql = "SELECT * FROM product";
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
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>'; // Close the grid-container for the current product group
            }
            ?>

            <div class="header-title">
                <h1>Pet Food</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Canned Food/Special Cat - Beef and Liver.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Special Cat - Beef and Liver</div>
                        <div class="product-description">This is a delicious canned cat food made with beef and liver.</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Special Cat - Beef and Liver', 'Pet Food', 19.99)" >Add to Cart</button>
                
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Canned Food/Pedigree - Beef.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Pedigree - Beef</div>
                        <div class="product-description">This is a delicious dog food made with beef.</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Pedigree - Beef', 'Pet Food', 29.99)" >Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Dry Food/Alpo Adult.png')"></div>
                    <div class="product-details">
                        <div class="product-name">Alpo Adult</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$39.99</div>
                        <button class="add-to-cart" onclick="addToCart('Alpo Adult', 'Pet Food', 39.99)" >Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Dry Food/Friskies - Kitten.png')"></div>
                    <div class="product-details">
                        <div class="product-name">Friskies - Kitten</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$49.99</div>
                        <button class="add-to-cart" onclick="addToCart('Friskies - Kitten', 'Pet Food', 49.99)" >Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Treats/Doggo Dog Treats.png')"></div>
                    <div class="product-details">
                        <div class="product-name">Doggo Dog Treats</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$9.99</div>
                        <button class="add-to-cart" onclick="addToCart('Doggo Dog Treats', 'Pet Food', 9.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Petfood/Treats/Dreamies - Tasty Chicken.png')"></div>
                    <div class="product-details">
                        <div class="product-name">Dreamies - Tasty Chicken</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$5.99</div>
                        <button class="add-to-cart" onclick="addToCart('Dreamies - Tasty Chicken', 'Pet Food', 5.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- add more product cards in this category if you like -->
            </div>

            <div class="header-title">
                <h1>Health and wellness products (vitamins, supplements)</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/Ascorbic Acid - Canicee.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Ascorbic Acid - Canicee</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Ascorbic Acid - Canicee', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/Beaphar - Multi-Vit Paste.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Beaphar - Multi-Vit Paste</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Beaphar - Multi-Vit Paste', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/LC-Vit Plus Syrup.png');"></div>
                    <div class="product-details">
                        <div class="product-name">LC-Vit Plus Syrup</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('LC-Vit Plus Syrup', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/Nutri-Vet - Multi-Vite Cat Paw Gel.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Nutri-Vet - Multi-Vite Cat Paw Gel</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Nutri-Vet - Multi-Vite Cat Paw Gel', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/Troy - Nutripet.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Troy - Nutripet</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Troy - Nutripet', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Health and wellness products/VetriScience Laboratories Multivitamin for Cats.png');"></div>
                    <div class="product-details">
                        <div class="product-name">VetriScience Laboratories Multivitamin for Cats</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('VetriScience Laboratories Multivitamin for Cats', 'Health & Wellness', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->

            <!-- Category Template START-->
            <div class="header-title">
                <h1>Collars, leashes, and harnesses</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Cat Harness and Leash - Black.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Harness and Leash - Black</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Harness and Leash - Black', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Cat Harness and Leash - Blue.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Harness and Leash - Blue</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Harness and Leash - Blue', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Cat Harness and Leash - Pink.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Harness and Leash - Pink</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Harness and Leash - Pink', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Dog Collar & Leash - Blue.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Dog Collar and Leash - Blue</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Dog Collar & Leash - Blue', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Dog Collar & Leash - Pink.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Dog Collar and Leash - Pink</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Dog Collar & Leash - Pink', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Collars/Dog Collar & Leash - Purple.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Dog Collar and Leash - Purple</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Dog Collar & Leash - Purple', 'Collars, Leashes & Harnesses', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->

            <!-- Category Template START-->
            <div class="header-title">
                <h1>Toys for pets</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Cat Toy Roller Ball Track Tower.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Toy Roller Ball Track Tower</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Toy Roller Ball Track Tower', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Knotted Rope Dog Toy.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Knotted Rope Dog Toy</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Knotted Rope Dog Toy', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Kong Puppy Dog Toy.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Kong Puppy Dog Toy</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Kong Puppy Dog Toy', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Linen Ball Cat Toy.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Linen Ball Cat Toy</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Linen Ball Cat Toy', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Rubber Dog Ball.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Rubber Dog Ball</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Rubber Dog Ball', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Toys for various pets/Wooven and Feather Ball Cat Toy.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Wooven and Feather Ball Cat Toy</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Wooven and Feather Ball Cat Toy', 'Toys For Pets', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->

            <!-- Category Template START-->
            <div class="header-title">
                <h1>Bedding and cages</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Collapsible Pet Cage - Black.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Collapsible Pet Cage - Black</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Collapsible Pet Cage - Black', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Collapsible Pet Cage - Purple.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Collapsible Pet Cage - Purple</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Collapsible Pet Cage - Purple', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Cat Backpack - Pink.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Backpack - Pink</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Backpack - Pink', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Cat Backpack - Black.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Backpack - Black</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Backpack - Black', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <!-- <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Cat Backpack - Yellow.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Cat Backpack - Yellow</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Cat Backpack - Yellow', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div> -->
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Pet Carrier - Black.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Pet Carrier - Black</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Pet Carrier - Black', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Pet Carrier - Brown.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Pet Carrier - Brown</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Pet Carrier - Brown', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <!-- <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Bedding and cages/Round Cat Cushion Bed.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Round Cat Cushion Bed</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Round Cat Cushion Bed', 'Beddings & Cages', 19.99)">Add to Cart</button>
                    </div>
                </div> -->

                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->

            <!-- Category Template START-->
            <div class="header-title">
                <h1>Grooming supplies (brushes, shampoos)</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Bearing - Tick and Flea Dog Shampoo.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Bearing - Tick and Flea Dog Shampoo</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Bearing - Tick and Flea Dog Shampoo', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Nail Cutter and Trimmer - Blue.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Nail Cutter and Trimmer - Blue</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Nail Cutter and Trimmer - Blue', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Oster Oatmeal Naturals - Dander Control.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Oster Oatmeal Naturals - Dander Control</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Oster Oatmeal Naturals - Dander Control', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Our Cat - Pink Rose Shampoo.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Our Cat - Pink Rose Shampoo</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Our Cat - Pink Rose Shampoo', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Our Dog - Aloe Vera Shampoo.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Our Dog - Aloe Vera Shampoo</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Our Dog - Aloe Vera Shampoo', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Pet Hair Grooming Brush - Blue.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Pet Hair Grooming Brush - Blue</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Pet Hair Grooming Brush - Blue', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- Product Card -->
                <!-- <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Grooming supplies/Pet Hair Grooming Brush - Pink.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Pet Hair Grooming Brush - Pink</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Pet Hair Grooming Brush - Pink', 'Grooming Supplies', 19.99)">Add to Cart</button>
                    </div>
                </div> -->

                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->

            <!-- Category Template START-->
            <div class="header-title">
                <h1>Pet Utilities</h1>
            </div>
            <div class="grid-container">
                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Bowls/Ceramic Dog Bowl.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Ceramic Dog Bowl</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Ceramic Dog Bowl', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Bowls/Concave Double Feeding Dog Bowl.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Concave Double Feeding Dog Bowl</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Concave Double Feeding Dog Bowl', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Bowls/Elevated Cat Bowls.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Elevated Cat Bowls</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Elevated Cat Bowls', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Feline Fresh - Lavander.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Feline Fresh - Lavander</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Feline Fresh - Lavander', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Jolly Cat - Espresso Cat Litter.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Jolly Cat - Espresso Cat Litter</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$29.99</div>
                        <button class="add-to-cart" onclick="addToCart('Jolly Cat - Espresso Cat Litter', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="product-card">
                    <div class="product-image" style="background-image: url('./images/Others/Jolly Cat - Lemon Cat Litter.png');"></div>
                    <div class="product-details">
                        <div class="product-name">Jolly Cat - Lemon Cat Litter</div>
                        <div class="product-description">Product description</div>
                        <div class="product-price">$19.99</div>
                        <button class="add-to-cart" onclick="addToCart('Jolly Cat - Lemon Cat Litter', 'Pet Utilities', 19.99)">Add to Cart</button>
                    </div>
                </div>
                <!-- add more product cards in this category if you like -->
            </div>
            <!-- END Category Template -->
        </div> 
	<script src = "app.js"></script>
    </section>
</body>
</html>