<?php //redirected to dashboard if nakalogin na sila
session_start();
if (isset($_SESSION['user'])){
    header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title> 
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class ="form register"> 
			 
                <?php
                if (isset($_POST['submit'])){ //makes sure that the submit has been clicked
                //declaration of variables
                $firstName = $_POST['firstname'];
                $lastName = $_POST['lastname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordRepeat = $_POST['repeat-password'];

                //password encryption
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                //erros stored in an array for validation
                $errors = array();
               if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors,"All fields are required");
               }
               if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Invalid Email Address");
               }
               if (strlen($password)<8) {
                array_push($errors,"Password must be at least 8 characters");
               }
               if ($password!== $passwordRepeat) {
                array_push($errors,"Password does not match");
               }
               require_once "database.php";
               //to make sure the user doesn't use the same email
               $sql = "SELECT * FROM users WHERE email = '$email'";
               $result = mysqli_query($conn, $sql);
               $rowCount = mysqli_num_rows($result);
               if ($rowCount>0) {
                array_push($errors,"Email already exists.");
               }
               if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='error'><p class='errormsg'>$error</p></div>";
                }
                } else {
                // Add the is_admin attribute and set its default value to false
                $is_admin_default = false;
            
                $sql = "INSERT INTO users (firstName, lastName, email, password, is_admin) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ssssi", $firstName, $lastName, $email, $passwordHash, $is_admin_default);
                    mysqli_stmt_execute($stmt);
                    echo "<div><p class='alert-success'>Registration Successful.</p></div>";
                } else {
                    die("Something went wrong");
                }
            }
			}	
			?>
				<div class="form-container"> 
					<form action="registration.php" method="post"> 
						<h3>Register</h3>
						<input type="text" name="firstname"  placeholder="Enter your first name"> 
						<input type="text" name="lastname" placeholder="Enter your last name"> 
						<input type="email" name="email" placeholder="Enter your email"> 
						<div class="field input-field">	
							<input type="password" name="password" placeholder="Enter your password"> 
							<i class='bx bx-hide eye-icon register toggle-register'></i> 
						</div>	
						<input type="password" name="repeat-password" placeholder="Confirm your password">  
						<p>By clicking the register button, you agree to our<br><a href="">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
						<input type="submit" name="submit" value="Register" class="form-btn">  
						<p>Already have an account? <a href="login.php">Log in here</a></p>
					</form>
				</div>
			</div> 
		</div>
    </div>
    <script>
		const toggle = document.querySelector(".toggle-register"), 
		input = document.querySelector(".field input[name='password']"); 
		
		toggle.addEventListener("click", ()=>{
			if(input.type === "password"){
				input.type = "text"; 
				toggle.classList.replace("bx-hide", "bx-show");
			} else {
				input.type = "password"; 
				toggle.classList.replace("bx-show", "bx-hide");
			}
		})
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>