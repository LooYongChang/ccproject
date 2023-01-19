<?php include("connection.php");
ob_start();
SESSION_START();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>About Us</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="aboutus.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        @import url("navbar2.css");

        #about-head {
            background-image: url("image/head/aboutHead.png");
            width: 100%;
            height: 50vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            padding: 14px;
        }

        #about-head h2,
        #about-head p {
            color:darkred;
        }

        #about-head h2 
        {
            font-size:55px;
            font-weight: 900;
        }

        #about-head p
        {
            font-size:20px;
            font-weight: 600;
        }

        .container{
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-position: center center;
        color:brown;
        padding: 0;
        margin-top:-30px;
        }

        
        .about-us{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            flex-direction: column;
        }

        .who-we-are{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .who-we-are span{
            width: 60%;
            align-items: center;
            text-align: center;
        }

        .cards{
            display: flex;
            justify-content: center;
            align-items: center;
            margin:10px;
            flex-wrap: wrap;
        }

        .card-img{
            border-radius: 5px;
        }
        .cards .card{
            width: 13rem;
            margin: 20px;
            background:linear-gradient(darkgrey, transparent),linear-gradient(to top left, black, transparent),linear-gradient(to top right, lightgrey, transparent);
            background-blend-mode: screen;
            padding-left:20px;
            border-radius:10px;
            padding-top:20px;
            padding-bottom:20px;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }
        .card p{
            font-size: 14px;
        }
        .social-media{
            width: 90%;
            display: flex;
            justify-content: flex-end;
        }
        .social-media i{
            margin:10px;
        }
        .active{
            border-bottom: 1px solid #fff;
        }
        .card-img{
            width: 170px;
            height: 8rem;
            background-size: cover;
            background-position: center center;
        }

        .card-body h3
        {
            margin-bottom:12px;
        }

        .card-body 
        {
            text-align:center;
            padding:10px 10px;
            margin-top:10px;
            background-color:white;
            width:170px;
            color:brown;
            border-radius:5px;
        }

        .cinfo
        {
            display:flex;
            justify-content: center;
        }

        .cinfo .info
        {
            width:400px;
            margin:0 40px;
            margin-top:60px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            border-radius:8px;
            padding:20px 25px;
        }

        .cinfo .info h2
        {
            text-align:center;
            font-size:30px;
        }

        .cinfo .info p
        {
            margin:10px;
            padding:5px;
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
                    <div class="animation start-about"></div>
                </nav>
            </div>
        </div>
    </div>

    <section id="about-head">
        <h2>AITURE FURNITURE</h2>
        <p>Renovate your home</p>
        <p>Your happiness is always our target.</p>
    </section>

    <section class="cinfo">

        <div class="info">
        <h2>Company</h2>
            <p>AITURE is a furniture business. We provide the best service to everyone.</p> 
            <p>Those who purchased our product we provide free shipping, limited time offer and 60 days money back guarantee.</p>
            <p>Our products are very cost-effective and we use the best materials in the world to make our furniture.</p>
        </div>

        <div class="info">
        <h2>VISION</h2>
        <p>Our vision is to be a leading international furniture manufactureroffering innovative and superior quality products.</p>
        <p>This statement reflects our purpose and anticipation for the future, inspiring factors that drive us forward in providing the best value-for-money products accompanied by the best service in the industry, right from design to delivery.</p>
        <p>To be a successful and growing international design furniture brand.</p>
        <p>Our quality, solutions and market approach supports innovative partnership,trust and sustainability for our suppliers, customers and employees.</p>    

        </div>

        <div class="info">

        <h2>MISSION</h2>
            <p>Our mission is to create Value for our customers through Reliability and Flexibility.</p>
            <p>We want our customers to experience the warmth and comfort through Respect and Trust.</p>
            <p>We make furniture for life and take Pride in our Danish roots and Craftmanship.</p>
            
        </div>

    </section>


    <div class="container">
	
		<div class="about-us">
			<div class="who-we-are">
				<h3>Who we are</h3>
				<span>
                    We are a team of Aiture furniture online shop. 
                    we provide the best service and quality furniture to our customer.
                </span>
			</div>


			<div class="cards">
            <?php 
                $sresult = mysqli_query($connect,"SELECT * FROM admin");
                while($arow=mysqli_fetch_assoc($sresult))
                {
                    $aimage = $arow["admin_image"];
            ?>
				<div class="card">
					<div class="card-img" style="background-image:url('image/aboutUs/<?php echo $aimage;?>')"></div>
					<div class="card-body">
						<h3><?php echo $arow["admin_name"]; ?></h3>
						<span class="aposi"><?php echo $arow["admin_position"]; ?></span>
						
					</div>
				</div>		
		    
            <?php 
                }
            ?>
            </div>
		</div>
    </div>
        <footer class="section-p1">
            <div class="col">
                <img class="logo" src="image/nobgLogo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Address:</strong> 28, jalan mmu, 75450 Bukit Beruang, Melaka</p>
                <p><strong>Phone:</strong> 012-3456789</p>
                <p><strong>Hours:</strong> 0900 - 2200, Mon - Sat</p>

                <div class="follow">
                    <h4>Follow Us</h4>
                    <div class="icon">
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-twitter"></i>
                        <i class="fa fa-instagram"></i>
                        <i class="fa fa-youtube"></i>
                    </div>
                </div>
            </div>

            <div class="col">
            <h4>About</h4>
            <a href="aboutUs.php">About Us</a>
            <a href="dashboard.php">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="login.php">Sign In</a>
            <a href="cart.php">View Cart</a>
            <a href="dashboard.php">Track My Order</a>
        </div>

            <div class="secured-payment">

                <p>Secured Payment Gateways</p>
                <div>
                    <img class="pay" src="image/payment_medthod.png" alt="">

                </div>

        </footer>
</body>

</html>

<?php
ob_end_flush();
mysqli_close($connect);
?>