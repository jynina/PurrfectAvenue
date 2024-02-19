<?php
include "database.php"; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image_url = $_POST['imgurl'];
    $product_name = $_POST['productName'];
    $product_desc = $_POST['productDesc'];
    $product_price = $_POST['productPrice'];
    $product_group = $_POST['productGroup'];
    $stock_quantity = $_POST['stockQuantity']; // New input field for stock quantity

    // Perform SQL insertion for product
    $sql_product = "INSERT INTO products (image_url, product_name, product_desc, product_price, product_group) VALUES (?, ?, ?, ?, ?)";
    $stmt_product = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($stmt_product, $sql_product)) {
        mysqli_stmt_bind_param($stmt_product, "sssds", $image_url, $product_name, $product_desc, $product_price, $product_group);
        mysqli_stmt_execute($stmt_product);
        $product_id = mysqli_insert_id($conn); // Get the ID of the inserted product
    } else {
        die("Something went wrong with product insertion");
    }

    mysqli_stmt_close($stmt_product); // Close the prepared statement

    // Perform SQL insertion for stock
    $sql_stock = "INSERT INTO stocks (product_id, quantity) VALUES (?, ?)";
    $stmt_stock = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt_stock, $sql_stock)) {
        mysqli_stmt_bind_param($stmt_stock, "ii", $product_id, $stock_quantity);
        mysqli_stmt_execute($stmt_stock);
        echo "<div><p class='alert-success'>Product and stock added successfully.</p></div>";
    } else {
        die("Something went wrong with stock insertion");
    }

    mysqli_stmt_close($stmt_stock); // Close the prepared statement
}

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process</title>
</head>
<body>
    <a href="home.php">Back to Home</a>
    <a href="productsadmin.php">Back to Products</a>
    <a href="postproduct.php">Post Another Product</a>
</body>
</html>
