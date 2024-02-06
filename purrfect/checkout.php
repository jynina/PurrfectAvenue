<?php
session_start(); // Start the session if not already started

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // The user is logged in
    $user_id = $_SESSION['user_id'];
    
    // Your other code here
} else {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
	<a href="products.php"><img src="images/Background/back-arrow.png" class="logo" onclick="ExitPostAlert()"></a> 
</header> 
<div class="container">
    <div class="form-container">
    <div class="form register">
    <form method="post" action="checkoutprocess.php"  onsubmit="return PostAlert()">
                
    <label for="imgurl">First Name</label>
    <input type="text" name="Fname" required>

    <label for="productName">Last Name</label>
    <input type="text" name="Lname" required>

    <label for="productPrice">Contact Number</label>
    <input type="text" name="contactnum" required>

    <label for="address">Address</label>
    <input type="text" name="address" required>
<!-- -->

    <div class="payment-mode">
    <label for="paymentMode">Product Category <span style="color: red;">REQUIRED</span><br><br></label>
    <select name="paymentMode" id="paymentMode">
    <option value="CashonDelivery">Cash on Delivery</option>
    <option value="CreditDebitCard">Credit/Debit Card</option>
    <option value="E-Wallet">E-Wallet</option>
</select>
    </div>
<!-- -->
    
    <input type="submit" value="Checkout">
</form>
</div>
</div>
</div>
<script src="script.js"></script>
</body>
</html>