<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Include database connection code (e.g., db_connection.php)
require_once 'database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['Fname'];
    $last_name = $_POST['Lname'];
    $contact_number = $_POST['contactnum'];
    $address = $_POST['address'];
    $payment_mode = $_POST['paymentMode'];

    // Insert the order into the database
    $sql = "INSERT INTO orders (user_id, first_name, last_name, contact_number, address, payment_mode) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $user_id, $first_name, $last_name, $contact_number, $address, $payment_mode);
    $stmt->execute();
    $stmt->close();

    // Redirect to a confirmation page or wherever you want after successful submission
    header("Location: confirmation.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>