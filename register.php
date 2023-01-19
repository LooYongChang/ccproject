<?php
session_start();
include("connection.php");
$error = "";
if (isset($_POST["sub_btn"])) {

		if($_POST["user_pass"] == $_POST["confirm_pass"])
		{
		$Cname = $_POST["user_name"];
		$Cgender = $_POST["user_gender"];
		$Cadd = $_POST["user_add"];
		$Ccontact = $_POST["user_contact"];
		$Cemail = $_POST["user_email"];
		$Cpass = $_POST["user_pass"];
		$cpost = $_POST['post'];
		$cstate = $_POST['state'];


		$result = mysqli_query($connect, "SELECT * FROM customer WHERE  Cus_Email='$Cemail'");

		$count = mysqli_num_rows($result);
		if ($count != 0) {
?>
			<script>
				alert("You Had Already Have Account! Please Login");
			</script>
		<?php
		} else {
			mysqli_query($connect, "INSERT INTO customer (Cus_Name,Cus_Gender,Cus_Address,Cus_Contact,Cus_Email,cus_pass,cus_postcode,Cus_State)VALUES('$Cname','$Cgender','$Cadd','$Ccontact','$Cemail','$Cpass','$cpost','$cstate')");
		?>
			<script>
				alert("Account Created! Please Login")
			</script>
		<?php header("Refresh:0.2; url=login.php");
		}
	}
	else
	{
		?><script>
			alert("Confirm password not match!");
		</script><?php
	
	}
}


?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<style>
		@import url("navbar2.css");

		body {
			background-image: url(image/login-regis-image/white2.jfif);
			background-repeat: no-repeat;
			background-size: cover;
			height: 1100px;
		}


		p.p2 {
			text-align: left;
			color: grey;
			padding-top: 20px;
			padding-bottom: 5px;
		}

		input[type=submit] {
			background-color: #A87FEA;
			color: white;
			width: 70px;
			padding: 10px 10px 10px 10px;
			border: 0px;
			margin-top: 0px;

		}

		select,
		input[type=password],
		input[type=text],
		input[type=email] {
			border-radius: 10px;
			background: #F2F2F2;
			width: 100%;
			border: 0;
			margin: 0 0 2px;
			padding: 15px;
			box-sizing: border-box;
			font-size: 14px;
		}

		select,
		input[type=password]:hover,
		input[type=text]:hover,
		input[type=email]:hover {
			background-color: #E6E6FA;
		}

		select,
		input[type=password]:focus,
		input[type=text]:focus,
		input[type=email]:focus {
			background-color: #E6E6FA;
		}



		.registration-form {
			background-color: white;
		}

		form 
		{
			width:500px;
			justify-content: space-between;
		}

		form input[type=radio]
		{
			margin-left:20px;
			margin-right:5px;
		}

		body{
        width: 100%;
        background: linear-gradient(-45deg,#F7C2CB,#F6DEFA,#6CC6CB,#EAE5C9);
        background-size: 400% 400%;
        position: relative;
        animation: change 10s ease-in-out infinite;
    }
 
    @keyframes change
    {
        0%{
            background-position:  0 50%;
        }
        50%{
            background-position: 100% 50%;
        }
        100%{
            background-position: 0 50%;
        }
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

	<br>
	<fieldset style="width:400px;
					padding:40px;
					margin:auto;
					border:1px solid #DDD;
					border-radius:30px;
					background-color:white;
					box-shadow:0 0 20px 0;">
		<form name="registration_form" method="post" autocomplete="off" align="center">
			<div>
				<h2 style="font-family:Goudy Old Style">Register</h2>
				<p class="p2">Full Name<br></p>
				<input type="text" name="user_name" size="30" maxlength="30" pattern="[a-z A-Z]+" title="Please enter alphabet only." placeholder="Enter your name" required>

				<p class="p2">Gender<br></p>
				<input type="radio" name="user_gender" value="Male">Male
				<input type="radio" name="user_gender" value="Female">Female
				
				<p class="p2">Email<br></p>
				<input type="email" name="user_email" pattern=".+\.com" size="30" maxlength="30" placeholder="Enter your Email" required>

				<p class="p2">Password<br></p>
				<input type="Password" id="password" name="user_pass" size="30" maxlength="30" placeholder="Enter your password" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

				<p class="p2">Confirm Password<br></p>
				<input type="Password" name="confirm_pass" size="30" maxlength="30" placeholder="Confirm you password" id="confirm_password" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
				<span id='message'></span>

				<script>
					$('#password, #confirm_password').on('keyup', function () {
						if ($('#password').val() == $('#confirm_password').val()) {
							$('#message').html('Matched').css('color', 'green');
						} else 
							$('#message').html('Both Password and Confirm Password Not Matching').css('color', 'red');
						});
				</script>

				<p class="p2">Phone number<br></p>
				<input type="text" name="user_contact" size="30" maxlength="10" placeholder="Enter your phone number eg.0123456789" pattern="[0-9]{10}"  required>

				<p class="p2">Address<br></p>
				<input type="text" name="user_add" size="30" placeholder="Enter your address" required>

				<p class="p2">Postcode<br></p>
				<input type="text" name="post" size="30" maxlength="5" placeholder="Enter your postcode" pattern="[0-9]{5}" required>
				
				<p class="p2" name="state">State<br></p>
				
				<select name="state" required>
                        <option value="">State</option>
                              <option value="Johor">Johor</option>
							  <option value="Kedah">Kedah</option>
							  <option value="Kelantan">Kelantan</option>
							  <option value="Kuala Lumpur">Kuala Lumpur</option>
							  <option value="Labuan">Labuan</option>
							  <option value="Melaka">Melaka</option>
							  <option value="Negeri Sembilan">Negeri Sembilan</option>
							  <option value="Pahang">Pahang</option>
							  <option value="Penang">Penang</option>
							  <option value="Perak">Perak</option>
							  <option value="Perlis">Perlis</option>
							  <option value="Putrajaya">Putrajaya</option>
							  <option value="Sabah">Sabah</option>
							  <option value="Sarawak">Sarawak</option>
							  <option value="Selangor">Selangor</option>
							  <option value="Terengganu">Terengganu</option>
                    </select>
				
				<br>
				<br>
				<br>
				<input type="submit" name="sub_btn" value="SIGN UP">
				<span><br><?php echo $error; ?></span>
				</br>
			</div>
		</form>
	</fieldset>
</body>

</html>

<?php
mysqli_close($connect);
?>