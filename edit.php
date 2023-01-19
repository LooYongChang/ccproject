<?php include("connection.php");
ob_start();
SESSION_START();
/* for check current state*/
$s1 = ""; $s2 = ""; $s3 = ""; $s4 = ""; $s5 = ""; $s6 = ""; $s7 = ""; $s8 = ""; $s9 = ""; $s10 = ""; $s11 = ""; $s12 = ""; $s13 = ""; $s14 = "";

/* for check current gender*/
$g1=""; $g2="";

$get_cusid = $_GET['cusid'];
$result=mysqli_query($connect,"SELECT * FROM customer WHERE Cus_ID = '$get_cusid'");
if (mysqli_num_rows($result) > 0) 
{
	$row = mysqli_fetch_assoc($result);

	$check_gender = $row['Cus_Gender'];
	if($check_gender == "Male")
	{
		$g1 = "checked";
	}
	else if($check_gender == "Female")
	{
		$g2 = "checked";
	}


	$check_state = $row['cus_state'];
	if($check_state == 'Johor')
	{
		$s1 = 'selected';
	}
	else if($check_state == 'Kedah')
	{
		$s2 = 'selected';
	}
	else if($check_state == 'Kelantan')
	{
		$s3 = 'selected';
	}
	else if($check_state == 'Malacca')
	{
		$s4 = 'selected';
	}
	else if($check_state == 'Negeri Sembilan')
	{
		$s5 = 'selected';
	}
	else if($check_state == 'Pahang')
	{
		$s6 = 'selected';
	}
	else if($check_state == 'Penang')
	{
		$s7 = 'selected';
	}
	else if($check_state == 'Perak')
	{
		$s8 = 'selected';
	}
	else if($check_state == 'Perlis')
	{
		$s9 = 'selected';
	}
	else if($check_state == 'Sabah')
	{
		$s10 = 'selected';
	}
	else if($check_state == 'Sarawak')
	{
		$s11 = 'selected';
	}
	else if($check_state == 'Selangor')
	{
		$s12 = 'selected';
	}
	else if($check_state == 'Terengganu')
	{
		$s13 = 'selected';
	}
	else if($check_state == 'Kuala Lumpur')
	{
		$s14 = 'selected';
	}

}


?>
<!DOCTYPE html>
<html>

<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	@import url("navbar2.css");


	body {

		height: 1000px;
		margin: auto;
		background-image: url(image/login-regis-image/white2.jfif);
		background-repeat: no-repeat;
		background-size: cover;
	}

	form {
		margin-top: 50px;
		background: #fff;
		max-width: 700px;
		width: 70%;
		padding: 30px 30px;
		box-shadow: 0 0 20px 0;
		border-radius: 10px;
		margin-left: 280px;

	}

	select,
	input[type=tel],
	input[type=password],
	input[type=text] {
		border-radius: 10px;
		background: #F2F2F2;
		width: 60%;
		border: 0;
		margin: 0 0 15px;
		padding: 10px;
		box-sizing: border-box;
		font-size: 14px;
	}

	select:hover,
	input[type=tel]:hover,
	input[type=password]:hover,
	input[type=text]:hover {
		background-color: #E6E6FA;
	}

	select:focus,
	input[type=tel]:focus,
	input[type=password]:focus,
	input[type=text]:focus {
		background-color: #E6E6FA;
	}

	input[type=radio]
	{
		margin-left:25px;
		margin-bottom:20px;
		margin-top:10px;
		margin-right:10px;
	}

	p {
		font-size: 20px;
		font-weight: 500;
		margin: 5px;
	}

	p.p2 {
		text-align: left;
		padding-top: 5px;
	}

	input[type=submit] {
		display: block;
		background-color: #A87FEA;
		color: white;
		width: 60px;
		margin-top: 10px;
		padding: 10px 10px 10px 10px;
		border: 1px;
		border-radius: 5px;
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
					
                    <div class="animation start-home"></div>
                </nav>
            </div>
        </div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<form name="user_form" method="POST" action="">
		<?php
		if (isset($_GET["edit"])) {
			$id = $_GET["cusid"];
			$result = mysqli_query($connect, "SELECT * from customer WHERE Cus_ID='$id'");
			$row = mysqli_fetch_assoc($result);
		?>
			<p class="p2">Full Name</p>
			<input type="text" name="txtfname" pattern="[a-zA-Z\s]+" title="Please enter alphabet only." value="<?php echo $row['Cus_Name']; ?>">
			
			<p class="p2">Gender<br></p>
				<input type="radio" name="user_gender" value="Male" <?php echo $g1; ?>>Male
				<input type="radio" name="user_gender" value="Female" <?php echo $g2; ?>>Female
				
			<p class="p2">Email</p>
			<input type="text" name="txtlemail" pattern=".+\.com" value="<?php echo $row['Cus_Email']; ?>">
			
			<p class="p2">Password</p>
			<input type="password" id="password" name="txtpass" value="<?php echo $row['cus_pass']; ?>" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			
			<p class="p2">Confirm Password</p>
			<input type="password" id="confirm_password" name="ctxtpass" value="<?php echo $row['cus_pass']; ?>" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
			<br><span id='message'></span><br>

			<script>
					$('#password, #confirm_password').on('keyup', function () {
						if ($('#password').val() == $('#confirm_password').val()) {
							$('#message').html('Matched').css('color', 'green');
						} else 
							$('#message').html('Both Password and Confirm Password Not Matching').css('color', 'red');
						});
				</script>

			<p class="p2">Phone number<br></p>
			<input type="tel" name="txtnumber" value="<?php echo $row['Cus_Contact']; ?>" maxlength="10" pattern="[0-9]{10}">
			
			<p class="p2">Address<br></p>
			<input type="text" name="txtaddress" value="<?php echo $row['Cus_Address']; ?>">

			<p class="p2">Postcode<br></p>
				<input type="text" name="cus_postcode" size="30" maxlength="5" placeholder="Enter your postcode" value="<?php echo $row['cus_postcode']; ?>" pattern="[0-9]{5}" required>

				<p class="p2" name="state">State<br></p>
				<select name="state">
				<option value="Johor" <?php echo $s1 ?>>Johor</option>
				<option value="Kedah" <?php echo $s2 ?>>Kedah</option>
				<option value="Kelantan" <?php echo $s3 ?>>Kelantan</option>
				<option value="Malacca" <?php echo $s4 ?>>Malacca</option>
				<option value="Negeri Sembilan" <?php echo $s5 ?>>Negeri Sembilan</option>
				<option value="Pahang" <?php echo $s6 ?>>Pahang</option>
				<option value="Penang" <?php echo $s7 ?>>Penang</option>
				<option value="Perak" <?php echo $s8 ?>>Perak</option>
				<option value="Perlis" <?php echo $s9 ?>>Perlis</option>
				<option value="Sabah" <?php echo $s10 ?>>Sabah</option>
				<option value="Sarawak" <?php echo $s11 ?>>Sarawak</option>
				<option value="Selangor" <?php echo $s12 ?>>Selangor</option>
				<option value="Terengganu" <?php echo $s13 ?>>Terengganu</option>
				<option value="Kuala Lumpur" <?php echo $s14 ?>>Kuala Lumpur</option>
				</select>
				
				
				
			<input type="submit" value="Save" name="savebtn">
		<?php
		}
		?>

	</form>
</body>

</html>
<?php

if (isset($_POST["savebtn"])) {
	$cname = $_POST["txtfname"];
	$cemail = $_POST["txtlemail"];
	$cgender = $_POST['user_gender'];
	$pass = $_POST["txtpass"];
	$cpass = $_POST["ctxtpass"];
	$ccontact = $_POST["txtnumber"];
	$caddress = $_POST["txtaddress"];
	$postcode = $_POST['cus_postcode'];
	$cstate = $_POST['state'];

	$ccresult=mysqli_query($connect,"SELECT * FROM customer WHERE Cus_Email = '$cemail'");
    $checkNoEmail=mysqli_num_rows($ccresult);

    $checkRepeatEmail = 0;

	if($cemail== $_SESSION['email'])
	{
		$checkRepeatEmail = 1;
	}

	if($checkNoEmail == 0 || $checkRepeatEmail==1)
	{
		if($pass == $cpass)
		{

				mysqli_query($connect, "UPDATE customer SET Cus_Name='$cname',
														Cus_Email='$cemail', 
														Cus_Gender = '$cgender',
														cus_pass='$cpass',
														Cus_Contact='$ccontact',
														Cus_Address='$caddress',
														cus_postcode='$postcode',
														cus_state = '$cstate' 
														WHERE Cus_ID='$id'");
				$_SESSION['name'] = $cname;
				$_SESSION["gender"] = $cgender;
				$_SESSION['email'] = $cemail;
			?>
				<script>
					alert("Info Updated!");
				</script>
			<?php

				header("refresh:0.2; url=dashboard.php");
		}
		else
		{
			?> <script>alert("Confirm password not match!");</script><?php
		}
	}
	else
        {
            ?> 
                <script> alert("Email had already taken.");</script>
            <?php
        }
mysqli_close($connect);
ob_end_flush();
}
?>