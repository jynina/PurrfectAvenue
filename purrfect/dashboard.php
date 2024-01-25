<?php //code so that user dashboard cannot be accessed without login
session_start();
if (!isset($_SESSION['user'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8"> 
	<title>Purrfect Pet Services</title> 
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="style.css"> 
</head> 
<body> 
	<section>
		<header>
			<a href="dashboard.php"><img src="images/Background/logo.png" class="logo"></a> 
			<div class="nav-bar">
				<div class="toggle"></div>
				<ul class="navigation"> 
					<li><a href="dashboard.php">Home</a></li> 
					<li><a href="products.php">Products</a></li> 
					<li><a href="aboutus.php">About Us</a></li> 	
					<li><a href="#" onclick="logoutAlert()">Log Out</a></li> 
				</ul> 
			</div>
		</header> 
	<div class="content">
		<div class="textBox">
			<?php
			if (isset($_SESSION['user_id'])) {
				require_once 'database.php';
			
				$user_id = $_SESSION['user_id'];
			
				$sql = "SELECT firstName, lastName FROM users WHERE user_id = $user_id";
				$result = mysqli_query($conn, $sql);
			
				// Check if the query was successful
				if ($result) {
					$admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
						echo "<h2>Welcome, <span-1>{$admin['firstName']} {$admin['lastName']}!</span-1></h2><br>";

				}
			}
			?>
			<h2>Pets Thrive, <span-1>We Provide.</span-1></h2> 
			<p>Experience exceptional pet care at "Purrfect Pet Services," your one-stop online destination for all things pets! 
			From adopting your new furry family member to finding top-quality accessories, food, and cages, we've got it all. 
			At "Purrfect Pet Services," we're committed to making pet care seamless and accessible, offering a range of services 
			that go beyond expectations. Your pets deserve the finest, and we're here to deliver unparalleled convenience and care 
			for every step of their journey. Have questions or concerns about your pet? Share them with us, and will provide you with 
			the best guidance possible.</p> 
			<a href="products.php">Buy Now</a> 
		</div> 
	</div>
	<ul class="sci"> 
		<li><a href="aboutus.php"><i class='bx bxl-facebook' ></i></li>
		<li><a href="aboutus.php"><i class='bx bxl-twitter' ></i></li>
		<li><a href="aboutus.php"><i class='bx bxl-instagram' ></i></li>
	</ul> 
	<div class="footer"> 
		<p>Copyright 2024 | WebDev | Group 5</p>
	</div>
	<script src = "app.js"></script>
	</section> 
</body> 
</html> 