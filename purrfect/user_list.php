<?php
// Start the session
session_start();

// Include your database connection script
require_once 'database.php';

// Fetch users from the database
$query = "SELECT user_id, firstName, lastName FROM users ORDER BY lastName, firstName";
$result = mysqli_query($conn, $query);

// Check for errors or empty result
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css"> 
    <title>User's Profile</title>
</head>
<body class="user_list">
    <header>
		<a href="admin.php"><img src="images/Background/logo.png" class="logo"></a> 
		<div class="nav-bar">
			<div class="toggle"></div>
			<ul class="navigation"> 
				<li><a href="user_list.php">Users</a></li> 
                <li><a href="orders_list.php">Active Orders</a></li>
                <li><a href="orderhistoryadmin.php">Completed Orders</a>
				<li><a href="home.php">Admin Panel</a></li> 
			</ul> 
		</div>
	</header> 
    <div class="container-4">
    <h2>User's Profile List</h2>
    <table>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                // Combining first name and last name for full name display
                $fullName = htmlspecialchars($row["firstName"]) . " " . htmlspecialchars($row["lastName"]);
                echo "<tr>";
                echo "<td>" . $fullName . " <a href='view_user.php?user_id=" . htmlspecialchars($row["user_id"]) . "' class='view-btn'>View Profile</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="home.php" class="home-btn">Back to home page</a>
    <a href="create_user.php" class="home-btn">Create a new user</a>
    </div>
    <?php
    // Free the result and close the database connection
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>
