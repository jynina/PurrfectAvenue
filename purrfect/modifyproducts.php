<?php
// Include the database connection.
require_once 'database.php';

// Initialize a variable to hold the product's details.
$product = null;

// Check if a product_id is provided in the URL.
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare a SELECT statement to fetch the product's details.
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Fetch the stock quantity associated with the product ID from the stocks table.
        $stmt = $conn->prepare("SELECT quantity FROM stocks WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stock_result = $stmt->get_result();

        if ($stock_result->num_rows > 0) {
            $stock_row = $stock_result->fetch_assoc();
            $product['quantity'] = $stock_row['quantity']; // Assign the stock quantity to the product array.
        } else {
            // If no stock quantity is found, set it to 0.
            $product['quantity'] = 0;
        }
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "No product specified for modification.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Update Product</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <!-- Include your CSS here. -->
</head>
<header>
    <a href="productsadmin.php"><img src="images/Background/back-arrow.png" class="logo" onclick="ExitPostAlert()"></a> 
</header>
<body>
<div class="container">
    <div class="form-container">
        <div class="form register">
        <form action="update_product_process.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

            <label for="imgurl">Image URL:</label>
            <input type="text" name="imgurl" value="<?php echo htmlspecialchars($product['image_url']); ?>" required>

            <label for="productName">Product Name:</label>
            <input type="text" name="productName" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

            <label for="productPrice">Product Price:</label>
            <input type="text" name="productPrice" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>

            <label for="productDesc">Product Description:</label>
            <textarea name="productDesc" required><?php echo htmlspecialchars($product['product_desc']); ?></textarea>

            <!-- Product Group: dynamically generate radio buttons based on your categories -->
            <label for="productGroup">Product Group:</label>
            <?php
            $groups = ['food', 'health', 'accessory', 'toy', 'bedcage', 'supplies', 'utility'];
            foreach ($groups as $group) {
                echo "<input type='radio' name='productGroup' value='$group' " . ($product['product_group'] === $group ? 'checked' : '') . "> $group<br>";
            }
            ?>

            <!-- Stock Quantity -->
           <!-- Stock Quantity -->
           <label for="stockQuantity">Stock Quantity:</label>
            <input type="number" name="stockQuantity" value="<?php echo isset($product['stock_quantity']) ? htmlspecialchars($product['stock_quantity']) : ''; ?>" required>

            <input type="submit" value="Update Product">
        </form>
            <form action="delete_product_process.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                <input type="submit" value="Delete Product">
            </form>


        </div>
    </div>
</div>
</body>
</html>