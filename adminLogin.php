<?php
session_start();
include("connection.php");
$error = "";

if (isset($_POST["sub_btn"])) {

	if (empty($_POST["admin_email"]) || empty($_POST["admin_pass"])) {

		$error = "Username or password is empty";
	} else {
		$email = $_POST["admin_email"];
		$pass = $_POST["admin_pass"];

		$pass = mysqli_real_escape_string($connect, $pass);
		//escape those special characters

		$result = mysqli_query($connect, "SELECT * FROM admin WHERE admin_email='$email' AND admin_pass='$pass'");
		$row = mysqli_fetch_assoc($result);
		$check = mysqli_num_rows($result);

		if ($check == 1) {
						$_SESSION["admin_email"] = $row["admin_email"];
                        $_SESSION["admin_name"] = $row["admin_name"];
                        $_SESSION["admin_id"] = $row["admin_id"];
                        $_SESSION['admin_position'] = $row['admin_position'];
    
						?><script>
				alert("Welcome back! <?php echo $_SESSION['admin_name'] ?>");
			</script><?php
						header("Refresh:0.2; url=adminHome.php");
					} else {
						$error = "Username and password is invalid";
					}
				}
			}

			
						?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		@import url("navbar2.css");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}


		body {
			background-image: url(image/login-regis-image/login3.png);
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

        fieldset h4
        {
            font-weight:100;
        }
	</style>
</head>

<body>
	

	<fieldset style="width:400px;
					padding:70px;
					margin-top:100px;
                    margin-left:450px;
					border:1px solid #DDD;
					border-radius:30px;
					background-color:white;
					box-shadow:0 0 20px 0;">

		<form name="login_form" method="post" align="center">
			<div>
				<h2 style="font-family:Goudy Old Style"><b>AITURE</h2></b>
                <h4>Admin Login</h4>

				<input type="email" name="admin_email" placeholder="User email">
				<input type="password" name="admin_pass" placeholder="Password">
				<p style="font-size:13px;"><a href="adminsendverificationCode.php">Forgot Password?</a></p>
				<br>
				<input type="submit" name="sub_btn" value="LOG IN">
				<br><span><?php echo $error; ?></span>
				</br>
				<p style="font-size:13px;">User?<a href="login.php">Login</a> here</a></p>
			</div>
		</form>
	</fieldset>



</body>

</html>
<?php
mysqli_close($connect);
?>