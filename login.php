<?php
session_start();

include("connection.php");
$error = "";

if (isset($_POST["sub_btn"])) {

	if (empty($_POST["user_email"]) || empty($_POST["user_pass"])) {

		$error = "Username or password is empty";
	} else {
		$email = $_POST["user_email"];
		$pass = $_POST["user_pass"];

		$email = mysqli_real_escape_string($connect, $email);
		$pass = mysqli_real_escape_string($connect, $pass);
		//escape those special characters

		$result = mysqli_query($connect, "SELECT * FROM customer WHERE Cus_Email='$email' AND cus_pass='$pass'");
		$row = mysqli_fetch_assoc($result);
		$check = mysqli_num_rows($result);

		if ($check == 1) {
						
						$_SESSION["name"] = $row["Cus_Name"];
						$_SESSION["id"] = $row["Cus_ID"];
						$_SESSION["gender"] = $row["Cus_Gender"];
						$_SESSION["email"] = $row["Cus_Email"];

						$_SESSION['login'] = 1;
						
						?><script>
				alert("Welcome back! <?php echo $_SESSION['name'] ?>");
			</script><?php
						header("Refresh:0.2; url=dashboard.php");
					} else {
						$error = "Username and password is invalid";
					}
				}
			}

			
						?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
			height: 600px;
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

		input[type=password],
		input[type=email] {
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
		input[type=email]:hover {
			background-color: #E6E6FA;
		}

		input[type=password]:focus,
		input[type=email]:focus {
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
	</style>
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
                       
                            $_SESSION['cartnum']=0;
                        
                    }
                    else
                    {
                        if(isset($_SESSION['id']))
                        {
                            $cid = $_SESSION['id'];
                            $sql = "SELECT * FROM cart WHERE cus_id = '$cid'";
                            $Cresult = mysqli_query($connect, $sql);

                            
                                if(mysqli_num_rows($Cresult) > 0)
                                {
                                    $_SESSION['cartnum']=mysqli_num_rows($Cresult);
                                }
                                else
                                {
                                    $_SESSION['cartnum']=0;
                                }
                            
                        }
                    }
                    ?>
                    <a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $_SESSION['cartnum'] ?>)</a>
                    <a href="aboutUs.php"><i class="fa fa-address-card"></i> About</a>
					
                    <div class="animation start-account"></div>
                </nav>
            </div>
        </div>
    </div>


	<h5 align="center"></h5>
	<hr>
	<br>
	<br>
	<br>
	<br>
	<br>
	<fieldset style="width:400px;
					padding:70px;
					margin:auto;
					margin-top:-30px;
					border:1px solid #DDD;
					border-radius:30px;
					background-color:white;
					box-shadow:0 0 20px 0;">

		<form name="login_form" method="post" align="center">
			<div>
				<h2 style="font-family:Goudy Old Style"><b>AITURE</h2></b>

				<input type="email" name="user_email" placeholder="User Email">
				<input type="password" name="user_pass" placeholder="Enter Password">
				<p style="font-size:13px;"><a href="sendverificatCode.php">Forgot Password?</a></p>
				<br>
				<input type="submit" name="sub_btn" value="LOG IN">
				<br><span><?php echo $error; ?></span>
				</br>
				<p style="font-size:13px;">Create acount?<a href="register.php">SIGN UP</a> here</p>
				<p style="font-size:13px;">Admin?<a href="adminLogin.php">Login</a> here</p>
			</div>
		</form>
	</fieldset>



</body>

</html>
<?php
mysqli_close($connect);
?>