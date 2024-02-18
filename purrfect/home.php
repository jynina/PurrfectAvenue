<?php
    // Check if user is logged in
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }

    // Check user's role and redirect accordingly
    if ($_SESSION['user'] === 'yes') { // If user is logged in
        if (isset($_SESSION['user_id'])) { // If user_id is set in session
            $user_id = $_SESSION['user_id'];
            require_once "database.php";

            // Fetch user's role from the database
            $sql = "SELECT is_admin FROM users WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user['is_admin'] == 1) { // If user is an admin
                header("Location: admin.php");
                exit();
            } else { // If user is not an admin
                header("Location: user.php");
                exit();
            }
        }
    }

    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
?>