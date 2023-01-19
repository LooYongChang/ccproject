<?php include("connection.php");
ob_start();
session_start();
if(!isset($_SESSION['id']))
{
	?>
	<script>alert("Please Login First");</script>
	<?php
	header("refresh:0.2,url=login.php");
}

$cusid = $_SESSION['id'];

/* payment history */
$hsql = "SELECT total_product,payment_date,total_payment, payment_status FROM order_list WHERE cus_id = '$cusid'";
$hresult = mysqli_query($connect, $hsql);
$hdata = array();
$h = 0;
if (mysqli_num_rows($hresult) > 0) {
	while ($hrow = mysqli_fetch_assoc($hresult)) {
		$hdata[] = $hrow;
		$h += 1;
	}
}

/* delivery status */
$dsql = "SELECT payment_date, delivery_status FROM order_list WHERE cus_id = '$cusid'";
$dresult = mysqli_query($connect, $dsql);
$ddata = array();
$d = 0;
if (mysqli_num_rows($dresult) > 0) {
	while ($drow = mysqli_fetch_assoc($dresult)) {
		$ddata[] = $drow;
		$d += 1;
	}
}

?>
<!DOCTYPE html>
<html>
<script>
	var option = "ohistory";
</script>

<head>
	<title>User Dashboard</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function confirmation() {
			var option;
			option = confirm("Do you sure to log out?")
			return option;
		}
	</script>

	<style>
		@import url("navbar2.css");

		* {
			margin: auto;
			box-sizing: border-box;
		}


		#userinfo {
			border-bottom-left-radius: 15px;
			border-bottom-right-radius: 15px;
			position: absolute;
			left: 10%;
			width: 80%;
			height: 50px;
			background: #fafafa;
			text-align: center;
			box-shadow: 0 5px 5px rgba(32, 32, 32, .3);
			overflow: scroll;
			background-color: white;
		}

		table {
			position: absolute;
			left: 10%;
			width: 80%;
			height: 50px;
			background: #fafafa;
			text-align: center;
			box-shadow: 0 5px 5px rgba(32, 32, 32, .3);
			overflow: scroll;
			background-color: white;
		}


		th,
		td {
			padding: 10px 10px;
		}

		th {
			background-color: #87ceeb;
			color: #fafafa;
			padding: 20px;
		}

		td {
			padding: 5px;
		}

		tr:first-child th {
			background-color: rgb(100, 149, 237);
		}



		th:first-child {
			width: 50px;
		}

		input[type=button] {
			background-color: #A87FEA;
			color: white;
			width: 60px;
			padding: 10px 10px 10px 10px;
			border: 1px;
			border-radius: 5px;
		}

		input[type=button]:hover,
		input[type=button]:focus {
			background-color: #663399;
		}

		button {
			background-color: #A87FEA;
			color: white;
			width: 70px;
			padding: 10px 10px 10px 10px;
			border: 1px;
			border-radius: 5px;
		}

		button:hover,
		button:focus {
			background-color: #663399;
		}

		h2 {
			margin: 20px;
			padding: 20px;
			color: rgb(106, 90, 205);
			text-align: center;
		}

		.logoutbtn {
			background-color: #A87FEA;
			color: white;
			width: 60px;
			padding: 10px 10px 10px 10px;
			border: 1px;
			border-radius: 5px;
			text-decoration: none;
		}

		.logoutbtn:hover {
			background-color: #663399;
		}



		.option-container {
			height: 80vh;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			margin-bottom: -150px;
		}

		.radio-buttons {
			width: 100%;
			margin: 0 auto;
			text-align: center;
		}

		.custom-radio input {
			display: none;
		}

		.radio-btn {
			margin: 10px;
			width: 160px;
			height: 80px;
			border: 3px solid transparent;
			display: inline-block;
			border-radius: 10px;
			position: relative;
			text-align: center;
			box-shadow: 0 0 20px grey;
			cursor: pointer;
			background-color: whitesmoke;
		}

		.radio-btn>i {
			color: #ffffff;
			background-color: rgb(0, 191, 255);
			font-size: 18px;
			position: absolute;
			top: -15px;
			left: 50%;
			transform: translateX(-50%) scale(4);
			border-radius: 50px;
			padding: 3px;
			transition: 0.2s;
			pointer-events: none;
			opacity: 0;
		}

		.radio-btn .info-icon {
			width: 120px;
			height: 35px;
			position: absolute;
			top: 40%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.radio-btn .info-icon i {
			color: #8373e6;
			line-height: 40px;
			font-size: 20px;
		}


		.radio-btn .info-icon h3 {
			color: black;
			font-size: 12px;
			text-transform: uppercase;
		}

		.custom-radio input:checked+.radio-btn {
			border: 3px solid lightblue;
		}

		.custom-radio input:checked+.radio-btn>i {
			opacity: 1;
			transform: translateX(-50%) scale(1);
		}

		.arrow-down {
			cursor: pointer;
			color: white;
		}

		.arrow-down:hover {
			color: blue;

		}

		.more-info {
			width: 600px;
			background-color: lightblue;
			padding: 15px;
			text-align: center;
			justify-content: center;
		}

		#nametable
		{
			width:150px;
		}

		.ratebtn
		{
			float:right;
		}

		.ratebtn button
		{
			padding:6px 10px;
			font-size:18px;
			color:cornsilk;
			background-color:brown;
			transition: transform .2s;
		}

		.ratebtn button:hover
		{
			cursor:pointer;
			transform: scale(1.2);
		}

		#rated
		{
			background-color:grey;
			transition: transform .05s;
		}

		#rated:hover
		{
			background-color:grey;
			transform: scale(1.1);
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
					} else {
						if (isset($_SESSION['id'])) {
							$cid = $_SESSION['id'];
							$sql = "SELECT * FROM cart WHERE cus_id = '$cid'";
							$Cresult = mysqli_query($connect, $sql);
							if (mysqli_num_rows($Cresult) > 0) {
								$_SESSION['cartnum'] = mysqli_num_rows($Cresult);
							} else {
								$_SESSION['cartnum'] = 0;
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

	<div class="detial">
		<h2>User Dashboard</h2>
	</div>

	<table id="userinfo">
		<tr>
			<th id="nametable">Name </th>
			<th>Gender</th>
			<th>Email</th>
			<th>Password </th>
			<th>Phone number </th>
			<th>Address </th>
			<th>Postcode </th>
			<th>State </th>
			<th>Edit</th>
			<th>Logout</th>
		</tr>

		<?php

		$id = $_SESSION["id"];

		$result = mysqli_query($connect, "SELECT * from customer WHERE Cus_ID='$id'");
		while ($row = mysqli_fetch_assoc($result)) {

		?>
			<tr>
				<td><?php echo $row["Cus_Name"] ?></td>
				<td><?php echo $row["Cus_Gender"] ?></td>
				<td><?php echo $row["Cus_Email"] ?></td>
				<td><?php echo $row["cus_pass"] ?></td>
				<td><?php echo $row["Cus_Contact"] ?></td>
				<td><?php echo $row["Cus_Address"] ?></td>
				<td><?php echo $row["cus_postcode"] ?></td>
				<td><?php echo $row["cus_state"] ?></td>
				<td><a href="edit.php?edit&cusid=<?php echo $row["Cus_ID"] ?>"><input type="button" name="edit_btn" value="Edit"></a></td>
				<td><a onclick="return confirmation();" class="logoutbtn" href="dashboard.php?logout">Logout</a></td>

			</tr>
		<?php
		}
		?>
	</table>

	<div class="position">
		<div class="option-container">
			<div class="radio-buttons">

				<label class="custom-radio">
					<input type="radio" class="order_info_option" name="radio" id="opt1" value="ohistory" checked>
					<span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
						<div class="info-icon">
							<i class="fa fa-history"></i>
							<h3>Order History</h3>
						</div>
					</span>
				</label>

				<label class="custom-radio">
					<input type="radio" class="order_info_option" name="radio" id="opt2" value="dstatus">
					<span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
						<div class="info-icon">
							<i class="fa fa-truck"></i>
							<h3>Delivery Status</h3>
						</div>
					</span>
				</label>

			</div>
		</div>
	</div>


	<div id="order_info">
		<table style="padding-bottom:3px; background-color:#e6e6fa">
			<tr>
				<th>Order ID</th>
				<th>Quantity of Item</th>
				<th>Payment Date</th>
				<th>Total Payment</th>
				<th>Payment Status</th>
				<th>More Info</th>
				<th>Comment</th>
			</tr>
			<?php
			$sql = "SELECT * FROM order_list WHERE cus_id = '$cusid'";
			$result = mysqli_query($connect, $sql);
			$data = array();
			$x = 1;
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$x += 1;
			?>
					<tr>
						<th><?php echo $row['order_id']; ?></th>
						<th><?php echo $row['total_product']; ?> items</php>
						</th>
						<th><?php echo $row['payment_date']; ?></th>
						<th>RM <?php echo number_format($row['total_payment'], 2); ?></th>
						<th><?php echo $row['payment_status']; ?></th>
						<th><span class="arrow-down"><i class="fa-solid fa-angle-down"></i></span></th>
						<?php
						if (empty($row['order_feedback'])) {
						?>
							<th><a href="feedback.php?fback&oid=<?php echo $row['order_id']; ?>"><button>Feedback Order</button></a></th>
						<?php
						} else {
						?>
							<th><button style="background-color:grey">Done</button></th>
						<?php
						}
						?>
					</tr>

					<tr class="test">
						<th colspan='7'>
							<?php
							$oid = $row["order_id"];
							$isql = "SELECT * FROM order_product WHERE order_id = '$oid'";
							$iresult = mysqli_query($connect, $isql);

							while ($irow = mysqli_fetch_assoc($iresult)) {
							?>
								<p class="more-info">
									<span style="font-size:25px; color:red;"><?php echo $irow['product_name'] ?></span>
									<span style="font-size:17px; color:grey;"><?php echo $irow['product_type'] ?></span>
									<span style="font-size:15px; color:green;">RM <?php echo $irow['product_price'] ?></span>
									<span style="font-size:15px; color:brown;">x <?php echo $irow['product_qty'] ?></span>
									
									<?php 
										$fpid= $irow['product_id'];
										$rate_result=mysqli_query($connect,"SELECT * FROM product_feedback WHERE order_id='$oid' AND product_id = '$fpid'");
										$rate_row = mysqli_fetch_assoc($rate_result);
										 
										if(mysqli_num_rows($rate_result)>0)
										{
											$fcontent=$rate_row['feedback_content'];
											if(!empty($fcontent))
											{
										?>
											<a class="ratebtn"><button id="rated">rated</button></a>
										<?php
										}
										}
										else
										{
											?>
												<a class="ratebtn" href="rating.php?rate&pid=<?php echo $fpid; ?>&oid=<?php echo $oid?>&pqty=<?php echo $irow['product_qty'];?>&pname=<?php echo $irow['product_name'];?>"><button>rate</button></a>
											<?php
										}
										?>
										
								</p>
							<?php
							}
							?>
			<?php
				}
			}
			else
			{				
					?>
					<tr><th colspan="7"><span><h4 style="color:rgb(105,105,105);">Currently No Data !</h4></span></th></tr>
					<?php
				
			}
			?>
		</table>
	</div>


</body>

</html>
<?php

if (isset($_GET['logout'])) {
	SESSION_DESTROY();
	header("location:login.php");
}

?>

<script>
	var srch = "";
	var opt = "";

	$(document).ready(function() {

		$('.order_info_option').click(function() {
			opt = $(this).val();
			$.ajax({
				url: "MoreOrderInfo.php",
				method: "POST",
				data: {
					option: opt
				},
				success: function(data) {
					$('#order_info').html(data);
				}
			})
		})

	})
</script>


<?php
ob_end_flush();
mysqli_close($connect);
?>
<script>
	jQuery(document).ready(function() {
		jQuery(".test").hide();
		jQuery(".arrow-down").click(function() {
			jQuery(this).parents().next(".test").slideToggle();
		});
	});
</script>