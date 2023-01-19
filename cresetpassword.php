<?php
include("connection.php");
session_start();


// change Password
if (isset($_POST['changePassword'])) {
	$password = $_POST['pass'];
	$confirmPassword = $_POST['cpass'];

	if (strlen($_POST['pass']) < 8) {
		$errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
	} else {
		// if password not matched so
		if ($_POST['pass'] != $_POST['cpass']) {
?><script>
				alert("Confirm password not match!");
			</script><?php

					} else {
						$email = $_SESSION['v_email'];
						$updatePassword = "UPDATE customer SET Cus_Pass = '$password' WHERE Cus_Email = '$email'";
						$updatePass = mysqli_query($connect, $updatePassword) or die("Query Failed");
						?><script>
				alert("Reset password Successfully! Please login.");
			</script><?php
						header("refresh:0.2,url=login.php");
					}
				}
			}
						?>
<!DOCTYPE html>
<html>

<head>
<script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
	<style>
		@import url("navbar2.css");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			background-image: url(image/login-regis-image/userPage2.png);
			background-repeat: no-repeat;
			background-size: 1550px 750px;
		}

		p.p2 {
			text-align: left;
			color: grey;
			padding-top: 20px;
		}

		.fieldset {
			position: relative;
			background-color: #FFFFFF;
			max-width: 260px;
			margin: 200px auto 100px;
			padding: 10px 45px 30px 45px;
			text-align: center;
			box-shadow: 0 0 20px 0;
			border-radius: 10px;
			background-color: white;
		}

		input[type=submit] {
			background-color: #A87FEA;
			color: white;
			width: 70px;
			padding: 10px 10px 10px 10px;
			border: 0px;
			margin: 10px 0px 15px 4px;

		}

		input[type=email],
		input[type=password] {
			border-radius: 10px;
			background: #F2F2F2;
			width: 100%;
			border: 0;
			margin: 10px;
			padding: 15px;
			box-sizing: border-box;
			font-size: 14px;
		}

		input[type=password]:hover,
		input[type=text]:hover {
			background-color: #E6E6FA;
		}

		input[type=password]:focus,
		input[type=text]:focus {
			background-color: #E6E6FA;
		}

		fieldset a {
			color: #2691d9;
			text-decoration: none;
			text-align: center;
			font-size: 16px;
			margin-top: 10px;
		}

		fieldset a:hover {
			text-decoration: underline;
		}

		fieldset h4 {
			font-weight: 100;
		}

		#error {
			color: red;
			font-size: 15px;
		}


		form {
			text-align: center;
		}

		form h4 {
			font-size: 25px;

		}

		form h5 {
			font-size: 14px;
			color: grey;
		}

		form input[type='text'] {
			font-size: 18px;
			margin-top: 20px;
			margin-bottom: 5px;
			width: 100%;
			padding: 5px 10px 5px 10px;
			border-radius: 15px;
		}

		form .smtbtn {
			padding: 5px 10px 5px 10px;
			background-color: lightgreen;
			border: none;
			border-radius: 5px;
			font-size: 20px;
			transition: transform .2s;
			color:black;
		}

		form .smtbtn:hover {
			transform: scale(1.1);
		}


		#resend {
			color: red;

		}
	</style>

	<title>
		Reset Password
	</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>

	<div class="head">
		<div class="navigation">

			<div class="mainlogo">

				<img src="image/nobglogo.png">
			</div>


			<div class="navbar">
				<nav>
					<?php

					if (isset($_SESSION['id'])) {
					?>

						<a href="dashboard.php"><span id="welcome">Welcome, </span><?php echo $_SESSION['name'] ?></a>

					<?php
					} else {
					?>
						<a href="login.php">Login <i class="fa fa-user" aria-hidden="true"></i></a>
					<?php
					}
					?>
					<a href="MainPage.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
					<a href="shop.php"><i class="fa fa-bars" aria-hidden="true"></i> Product</a>
					<?php
					if (!isset($_SESSION['cartnum'])) {

						$_SESSION['cartnum'] = 0;
					}


					?>
					<a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $_SESSION['cartnum'] ?>)</a>
					<a href="aboutUs.php"><i class="fa fa-address-card"></i> About</a>
					<div class="animation start-account"></div>
				</nav>
			</div>
		</div>
	</div>
	<fieldset style="width:400px;
					padding:70px;
					margin-top:60px;
                    margin-left:450px;
					border:1px solid #DDD;
					border-radius:30px;
					background-color:white;
					box-shadow:0 0 20px 0;">

		<form action="" method="POST" autocomplete="off">
			<h4>Reset Password</h4>
			<p class="p2">Password</p>
			<input type="password" id="password" name="pass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

			<p class="p2">Confirm Password</p>
			<input type="password" id="confirm_password" name="cpass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			<br><span id='message'></span><br>

			<script>
				$('#password, #confirm_password').on('keyup', function() {
					if ($('#password').val() == $('#confirm_password').val()) {
						$('#message').html('Matched').css('color', 'green');
					} else
						$('#message').html('Both Password and Confirm Password Not Matching').css('color', 'red');
				});
			</script>

			<input type="submit" class="smtbtn" name="changePassword" value="Reset">
		</form>
	</fieldset>
	</div>

</body>

</html>