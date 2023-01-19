<?php include("connection.php");
SESSION_START();


if (isset($_GET["prod"])) {
    $pcode = $_GET["prodid"];
    $cusid = $_SESSION['id'];

    $result = mysqli_query($connect, "SELECT *FROM product inner join categories on product.product_type = categories.cat_id WHERE product_id='$pcode'");
    $row = mysqli_fetch_assoc($result);


/* if array cart not yet open*/
if (!(isset($_SESSION['cart']))) {
    $_SESSION['cart'] = array();
}

/* insert into array follow cus id*/
if (isset($_SESSION['id'])) {
    $cid = $_SESSION['id'];
    $sql = "SELECT * FROM cart WHERE cus_id = '$cid'";
    $Cresult = mysqli_query($connect, $sql);
    if (mysqli_num_rows($Cresult) > 0) {
        while ($Crow = mysqli_fetch_assoc($Cresult)) {
            $cid = $Crow['product_id'];
            $_SESSION['cart'][$cid] = $Crow['product_qty'];
        }
    }
}


if (isset($_POST["addCart"])) {
    if (isset($_SESSION["id"])) {
        $prod_id = $row["product_id"];
        $prod_name = $row["product_name"];
        $prod_img = $row["product_image"];
        $prod_price = $row["product_price"];


        $prod_qty = $_POST["qty"];
        if (isset($prod_qty)) 
        {
            $cus_id = $_SESSION['id'];
            $pid = $prod_id;
            $qty = $prod_qty;
        

            if (isset($_SESSION['cart'][$pid])) {
                $_SESSION['cart'][$pid] += $qty;
                $udpqty = $_SESSION['cart'][$pid];
                mysqli_query($connect, "UPDATE cart SET product_qty = '$udpqty' WHERE cus_id='$cus_id' AND product_id = '$pid'");
                
                ?> 
                <script>
                    alert("You had added an item to your cart")
                </script>
                <?php
                } 
                else 
                {
                    $_SESSION['cartnum']+=1;
                    $_SESSION['cart'][$pid] = $qty;
                    mysqli_query($connect, "INSERT INTO cart (cus_id,product_id,product_qty) VALUES ('$cus_id','$pid','$qty')");
                            ?> <script>
                    alert("You had added an item to your cart")
                </script><?php
                        }
        }
                } else {
                            ?><script>
            alert("Please Login first!")
        </script><?php

                }
            }

                    ?>
<!DOCTYPE html>
<html>

<head>

    
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <title>Product Page</title>

    <style>
        @import url("navbar2.css");

        #prodetails {
            display: flex;
            margin-top: 20px;

        }

        #prodetails .single-pro-details {
            width: 50%;
            padding-top: 30px;

        }

        #prodetails .single-pro-image {
            width: 40%;
            margin-right: 50px;
            border-radius: 15px;
        }

        #prodetails .single-pro-image img{
            border-radius: 15px;
        }

        #prodetails .single-pro-details h4 {
            padding: 40px 0 20px 0;
        }

        #prodetails .single-pro-details h2 {
            font-size: 24px;
        }

        #prodetails .single-pro-details h6 {
            color: rgb(112, 112, 112);
        }

        #prodetails .single-pro-details select {
            display: block;
            padding: 5px 10px;
            margin-bottom: 10px;
        }

        #prodetails .single-pro-details input {
            width: 50px;
            height: 47px;
            padding-left: 10px;
            font-size: 16px;
            margin-right: 10px;
        }

        #prodetails .single-pro-details input:focus {
            outline: none;
        }



        #prodetails .single-pro-details span {
            line-height: 25px;
            color: grey;
        }

        #pprice
        {
            color:red;
        }

        #ptype
        {
            font-size:18px;
            margin-top:-20px;
            margin-bottom:-30px;
        }

        #pname
        {
            font-size:30px;
            margin-bottom:-20px;
        }

        #nowonly
        {
            
            font-size:16px;
            color:red;
        }

        .ftitle
        {
            margin-bottom:25px;
        }

        .ftitle h3
        {
            font-size:30px;
        }

        .pfeedback
        {
            width:600px;
            border-top:1px solid black;
            border-bottom:1px solid black;
            padding:15px 25px;
        }

        .user-info
        {
            margin-bottom:5px;
        }

        .user-info .male
        {
            font-size:16px;
            color:cadetblue;
        }

        .user-info .female
        {
            font-size:16px;
            color:coral;
        }

        .user-info .fname
        {
            font-size:20px;
            margin-left:10px;
        }

        .fstar
        {
            color:goldenrod;
            font-size:12px;
            
        }

        .rstar
        {
            color:grey;
        }

        .fcomment
        {
            margin-top:12px;
        }

        .pqty
        {
            margin-left:10px;
            font-size:14px;
        }

        .psize
        {
            color:grey;
            font-weight:200;
            font-size:15px;
        }

        .backshopbtn a
        {
            text-decoration: none;
            background-color: #088178;
            color:#fff;
            padding:12px 20px;
            font-size:13px;
        }

        #addcartbtn
        {
            border:none;
            background-color: #088178;
            color:#fff;
            padding:12px 20px;
        }

        #addcartbtn:hover
        {
            cursor:pointer;
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
					<div class="animation start-product"></div>
				</nav>
			</div>
		</div>
	</div>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="image/AllProductImg/<?php echo $row['product_image'] ?>" width="100%" id="MainIMG" alt="">
        </div>

        <div class="single-pro-details">
            
            <h6 id="ptype"><?php echo $row['cat_title'] ?></h6>
            <h4 id="pname"><?php echo $row['product_name'] ?></h4>
            <h2 id="pprice">RM <?php echo $row['product_price'] ?><span id="nowonly" style="color:green;"> only !</span> </h2>
            <div class="remain_stock" style="padding-bottom:4px;">
                <h3>Remaining Stock: <?php echo $row['product_stock'] ?></h3>
            </div>

            <br><br>
            
            <form method="post" name="addcart" action="">

                <input name="qty" type="number" value="1" min="1" max="<?php echo $row['product_stock']; ?>">
                <?php

                $stock_remain = $row['product_stock'];
                if ($stock_remain == 0) {
                ?>
                    <html>
                    <button class="no-stock" style="background-color:grey;color:#fff;padding:12px 20px;">Out of stock</button>

                    </html>
                <?php
                } else {

                ?>
                    <button class="normal" name="addCart" id="addcartbtn">Add To Cart</button>
                    <span class="backshopbtn"><a href="shop.php">Back to shop</a></span>
                <?php

                }

                ?>
            </form>
            <h4>Product Size</h4>
            <h5 class="psize"><?php echo $row['product_size'] ?></h5>
            <h4>Product Description</h4>
            <span><?php echo $row['product_discript'] ?></span>
        </div>

    </section>


    <section class="section-p1" id="prodfeedback">
        <div class="ftitle">
            <h3>Customer Feedback</h3>
        </div> 
        
        
        <?php 
                $sql = "SELECT * FROM product_feedback WHERE product_id = '$pcode' AND cus_id = '$cusid' order by prod_feedbackid DESC";
                mysqli_query($connect,$sql);
                $result = mysqli_query($connect, $sql);
                if(mysqli_num_rows($result)>0)
                {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $oid = $row['order_id'];

                        ?>
                        <div class="pfeedback">

                            <div class='user-info'>
                                <p>
                                <?php 
                                    if($row['cus_gender']=="Male" )
                                    {
                                        ?>
                                            <i class="fa-solid fa-person male"></i>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <i class="fa-solid fa-person-dress female"></i>
                                        <?php
                                    }
                                ?> 
                                
                                <span class="fname"><?php echo $row['cus_name'] ?></span>

                                <!-- order qty -->
                                <span class="pqty"> <?php echo $row['product_name'] ?> x <?php echo $row['product_qty'] ?></span>
                                <span class="qty-item"></span>
                            </p>
                            </div>

                        <p>
                            <?php 
                            
                                $star = $row['feedback_rating'] ;
                                $remainstar = 5 - $star;
                                for($i=0 ; $i<$star ; $i++)
                                {
                                    ?>
                                    <i class="fa-solid fa-star fstar"></i>
                                    <?php
                                }

                                for($i=0 ; $i<$remainstar ; $i++)
                                {
                                    ?>
                                    <i class="fa-solid fa-star fstar rstar"></i>
                                    <?php
                                }
                            ?>
                        </p>
                            
                            <div class="fcomment">
                                <p><?php echo $row['feedback_content'] ?></p>
                            </div>       
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "No any comment yet.";
                }
        
        ?>


    </section>


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
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
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
}
mysqli_close($connect);
?>