<?php include("connection.php");
session_start();
ob_start();

$check=0;
if(isset($_POST['pymbtn']))
{
    $Uname = $_POST['Uname'];
    $phoneNo = $_POST['pno'];
    $address = $_POST['address'];
    $paymethod = $_POST['radio'];

    $cardNo1 = $_POST['cardNo1'];
    $cardNo2 = $_POST['cardNo2'];
    $cardNo3 = $_POST['cardNo3'];
    $cardNo4 = $_POST['cardNo4'];

    $cardNo = $cardNo1."".$cardNo2."".$cardNo3."".$cardNo4;


    $paydate = $_POST['paydate'];
    $paycw = $_POST['paycw'];
    $cusid = $_SESSION['id'];

    /*send mail */
    $resultd = mysqli_query($connect, "SELECT * FROM customer WHERE cus_id = '$cusid'");
    $rowa=mysqli_fetch_assoc($resultd);
    $get_email=$rowa['Cus_Email'];
    $to = $get_email;
    $resulte = mysqli_query($connect, "SELECT * FROM cart INNER JOIN product ON cart.product_id=product.product_id WHERE cus_id='$cusid'");
    $buy_prod="";
    while($rowe=mysqli_fetch_assoc($resulte))
    {
        $product=$rowe['product_name'];
        $prod_qty=$rowe['product_qty'];
        $buy_prod=$buy_prod."\n$product x $prod_qty";
    }
    $subject = "Payment Confirmed";
    $message = "Hello $Uname \n\n We had received your order! \n ".$buy_prod."\n\n We will delivery your product soon!";
    $headers = "From: aiture1232022@gmail.com\r\nReply-To: .$get_email.";
    $mail_sent = mail($to, $subject, $message, $headers);

    /* Get Total Payment */
    $totalpayment=0;
    $sqlc="SELECT * FROM cart inner join product on cart.product_id = product.product_id";
    $resultc = mysqli_query($connect, $sqlc);
    $prodNo = mysqli_num_rows($resultc);
    while($rowc = mysqli_fetch_assoc($resultc))
    {
        $price=$rowc['product_price'];
        $qty=$rowc['product_qty'];
        $totalpayment += ($price*$qty);
    }

    /* Get Customer Info */
    $sqla="SELECT * FROM customer WHERE cus_id = '$cusid '";
    $resulta = mysqli_query($connect, $sqla);
    $cusInfo =  mysqli_fetch_assoc($resulta);
   
    $cusEmail = $cusInfo['Cus_Email'];


    /* insert new info AND get last insert id */
    $psql = "INSERT INTO order_list (cus_id, cus_name, cus_contact, cus_email, cus_address, cus_cardNo, cus_CW, payment_method, total_product, total_payment, payment_date, payment_status, delivery_status) VALUES ('$cusid','$Uname','$phoneNo','$cusEmail','$address','$cardNo','$paycw','$paymethod','$prodNo','$totalpayment', '$paydate','Completed', 'In Transit') ";
    if (mysqli_query($connect, $psql)) 
    {
        $oid = mysqli_insert_id($connect);
    }

    /* delete all from cart database follow by cus id*/
    mysqli_query($connect, "DELETE FROM cart WHERE cus_id = '$cusid'");


    /* update stock and sold after checkout */
    foreach ($_SESSION['cart'] as $key => $val)
    {
        $sql = "SELECT * FROM product WHERE product_id='$key'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        $balance_qty = $row['product_stock'] - $val;

        mysqli_query($connect, "UPDATE product SET product_stock = '$balance_qty' WHERE product_id='$key'");
        
        /* get qty of product sold */
        $result=mysqli_query($connect, "SELECT product_sold FROM product WHERE product_id='$key'");
        $psold=mysqli_fetch_assoc($result);
        $prosold = $psold['product_sold'];
        if($prosold == 0)
        {
            mysqli_query($connect, "UPDATE product SET product_sold = '$val' WHERE product_id='$key'");
        }
        else
        {
            $newprosold = $prosold + $val;
            mysqli_query($connect, "UPDATE product SET product_sold = '$newprosold' WHERE product_id='$key'");
        
        }
    }

     /* use to store order product detail in database*/
     foreach ($_SESSION['cart'] as $key => $val)   
     {
         $isql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id  WHERE product_id='$key'";
         $iresult = mysqli_query($connect, $isql);
         $irow = mysqli_fetch_assoc($iresult);
 
        $pname = $irow['product_name'];
        $ptype = $irow['cat_title'];
        $pqty = $val;
        $pprice = $irow['product_price'];
 
         mysqli_query($connect, "INSERT INTO order_product (order_id, product_id, product_name, product_type, product_qty, product_price) VALUES ('$oid','$key','$pname','$ptype','$pqty','$pprice')");
    }
  

        
    

     /* clear cart array after checkout */
    unset($_SESSION['cart']);

    
    ?>
    <script>alert("Successfully Check Out. We had send your receipt to your email");</script>
    <?php
    $check=1;

    header('refresh:0.2 ; url=MainPage.php');

}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Checkout Page</title>
    <style>
        @import url("navbar2.css");

        #checkout-head {
            background-image: url("image/head/checkhead.jpg");
            width: 100%;
            height: 20vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            padding: 14px;

        }

        #checkout-head h2,
        #checkout-head p {
            color: white;
            font-weight: 800;
        }

        .line {
            border-left-style: solid;
            border-left-color: whitesmoke;
            border-left-width: 90px;
            width: 95%;
        }

        .head_line1 {
            background-color: lightskyblue;
            height: 5px;
        }

        .head_line2 {
            background-color: lightslategray;
            width: 100%;
            height: 20px;
        }

        #checkout-head h2 {
            padding-bottom: 10px;
            text-align: center;

        }


        .checkout {
            justify-content: center;

            display: flex;

        }

        .bill-info {
            margin-top: 10px;
            margin-left: 25px;
            padding: 20px;
            border-radius: 10px;
            width: 55%;

        }

        .bill-info h2 {
            font-size: 20px;
            font-weight: 500;
            padding-top: 10px;
            color: #e60000;
        }

        .bill-info h4 {
            font-size: 20px;
            font-weight: 500;
            color: #e60000;
        }

        .bill-info p {
            color: rgb(88, 88, 88);
            font-size: 14px;
            padding-top: 10px;
        }

        .bill-info input {
            margin: 10px 0px;
            padding: 6px 6px;
            width: 95%;
            font-size: 12px;
            color: rgb(136, 136, 136);
        }



        .bill-info textarea {
            margin: 10px 0px;
            padding: 6px 6px;
            width: 95%;
        }

        .sub-sumarry {
            margin-top: 60px;
            height: 50%;
            position: sticky;
            top: 80px;
            left: 0;
            padding: 15px 12px;
            border-radius: 15px;
            background-color: rgb(105, 105, 105);
        }

        .sub-sumarry h4 {
            font-size: 16px;
            font-weight: 100;
            color: white;
        }

        .sub-sumarry table,
        th,
        td {

            text-align: center;
            font-size: 14px;
            color: rgb(216, 216, 216);
            padding: 4px 6px 5px 5px;
        }

        .totalbill {
            float: right;
            padding: 5px 10px 10px 5px;
            font-size: 14px;
            font-weight: 150;
            color: white;
        }

        .payment-method-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
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
            width: 110px;
            height: 150px;
            border: 3px solid transparent;
            display: inline-block;
            border-radius: 10px;
            position: relative;
            text-align: center;
            box-shadow: 0 0 20px grey;
            cursor: pointer;
        }

        .radio-btn>i {
            color: #ffffff;
            background-color: #7FFFD4;
            font-size: 20px;
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

        .radio-btn .payment-method-image {
            width: 90px;
            height: 100px;
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);

        }


        .radio-btn .payment-method-image img {
            line-height: 80px;
            width: 100%;
        }

        .radio-btn .payment-method-image h3 {
            color: black;
            font-size: 12px;
            font-family: "Raleway", sans-serif;
            text-transform: uppercase;
        }

        .custom-radio input:checked+.radio-btn {
            border: 3px solid lightblue;
        }

        .custom-radio input:checked+.radio-btn>i {
            opacity: 1;
            transform: translateX(-50%) scale(1);
        }

        .visa {
            padding-top: 15px;
        }

        .master {
            padding-top: 21px;
        }

        .tng {
            padding-top: 8px;
        }


        .cimb {
            padding-top: 25px;
        }

      

        #payment_date {
            width: 100%;
        }

        #payment_cw {

            width: 60%;
        }

        .date-cw {
            display: flex;
        }

        .container-date-cw {
            margin-right: 50px;
           
        }

        .container-date-cw h4{
            margin-top:10px;
            color:black;
        }

        .bill-info .submitbtn {
            background-color: #088178;
            margin-left: 20px;
            margin-top: 30px;
            width: 40%;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
        }

        

        .backbtn a
        {
            background-color: #088178;
            margin-left: 20px;
            margin-top: 30px;
            text-decoration: none;
            color: #fff;
            padding: 12px 80px;
            border: none;
            font-size: 12px;
            border-radius: 5px;
        }
        

        .date-time
        {
            margin-bottom:15px;
        }

        .card_num input[type="text"] 
        {
            width:9%;
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
					
					<div class="animation start-cart"></div>
				</nav>
			</div>
		</div>
	</div>

    <section id="checkout-head">
        <h2>#Checkout</h2>
        <p>The Most Affordable and Worth Buying Furniture</p>
    </section>

    <section class="section-p1" id="check">
        <div class="checkout_container">

            <div class="head_line">
                <div class="line">
                    <div class="head_line1"></div>
                    <div class="head_line2"></div>
                </div>
            </div>

            <div class="checkout">

                <div class="bill-info">
                    <form method="post" name="bill">
                        <?php 
                            $cus_id = $_SESSION['id'];
                            $result = mysqli_query($connect, "SELECT * FROM customer WHERE Cus_ID = '$cus_id' ");
                            $row = mysqli_fetch_assoc($result)

                        ?>

                        <h4>Billing Details</h4>
                        <p><label for="user_name">Name:</label></p>
                        <input type="text" id="user_name" name="Uname" placeholder="Enter your name" value="<?php echo $row['Cus_Name']; ?>" required>

                        <p><label for="user_pnumber">Phone Number:</label></p>
                        <input type="text" id="user_pnumber" name="pno" placeholder="Enter your phone number"  value="<?php echo $row['Cus_Contact']; ?>" maxlength="10" required pattern="[0-9]{10}">

                        <p><label for="user_address">Delivery Address:</label></p>
                        <textarea id="user_address" name="address" placeholder="Enter delivery address"  rows="4" cols="60" required><?php echo $row['Cus_Address']; ?></textarea>

                        <h2>Select Payment Method</h2>
                        <div class="paymet-method-container">
                            <div class="radio-buttons">

                                <label class="custom-radio">
                                    <input type="radio" name="radio" value="visa" checked>
                                    <span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
                                        <div class="payment-method-image">
                                            <img src="image/checkout/visa.png" alt="">
                                            <div class="visa">
                                                <h3>Visa</h3>
                                            </div>

                                        </div>
                                    </span>
                                </label>

                                <label class="custom-radio">
                                    <input type="radio" value="mastercard" name="radio">
                                    <span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
                                        <div class="payment-method-image">
                                            <img src="image/checkout/mastercard.png" alt="">
                                            <div class="master">
                                                <h3>Mastercard</h3>
                                            </div>

                                        </div>
                                    </span>
                                </label>

                                <label class="custom-radio">
                                    <input type="radio" value="Union Pay" name="radio">
                                    <span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
                                        <div class="payment-method-image">
                                            <img src="image/checkout/unionpay.png" alt="">
                                            <div class="tng">
                                                <h3>Union Pay</h3>
                                            </div>

                                        </div>
                                    </span>
                                </label>

                                <label class="custom-radio">
                                    <input type="radio" value="American Express" name="radio">
                                    <span class="radio-btn"><i class="fa-li fa fa-check-square"></i>
                                        <div class="payment-method-image">
                                            <img src="image/checkout/American_Express.png" alt="">
                                            <div class="cimb">
                                                <h3>American Express</h3>
                                            </div>

                                        </div>
                                    </span>
                                </label>

                            </div>
                        </div>

                        <p><label for="card_name">Name on Card:</label></p>
                        <input type="text" id="card_name" name="cardName" pattern="[a-z A-Z]+" placeholder="Enter your name on card" required>

                        <p><label for="card_num">Card No:</label></p>
                        <div class="card_num">
                        <input type="text" id="card_num"  name="cardNo1" placeholder="0000" pattern="[0-9]{4}" maxlength="4" required> -
                        <input type="text" id="card_num"  name="cardNo2" placeholder="0000" pattern="[0-9]{4}" maxlength="4" required> -
                        <input type="text" id="card_num"  name="cardNo3" placeholder="0000" pattern="[0-9]{4}" maxlength="4" required> -
                        <input type="text" id="card_num"  name="cardNo4" placeholder="0000" pattern="[0-9]{4}" maxlength="4" required>
                        </div>

                        <div class="date-cw">
                            <div class="container-date-cw">
                                <p>
                                    <label for="payment_date">Expired Date:</label>
                                </p>
                                <!-- set checkout date disable past date-->
                                <?php 
                                    $date = date("Y-m-d");
                                ?>

                                <input type="date" name="paydate" min="<?php echo $date; ?>">
                            
                                
                            </div>

                            <div class="container-date-cw">
                                <p>
                                    <label for="payment_cw">CVV:</label>
                                </p>
                                <input type="text" id="payment_cw" name="paycw" placeholder="CVV (3 digit)" maxlength="3" pattern="[0-9]{3}" required>
                            </div>
                        </div>


                        <input type="submit" name="pymbtn" class="submitbtn" value="Submit Payment">
                        <span class="backbtn"><a href="cart.php">Back to cart</a></span>
                    </form>
                    
                </div>
               

                <div class="sub-sumarry">
                    <h4>Order Summary</h4>
                    <table>
                        <thread>
                            <tr>
                                <td>No</td>
                                <td>Item</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </tr>
                            <?php

                            $cid = $_SESSION['id'];
                            $sql = "SELECT * FROM cart inner join product on cart.product_id = product.product_id WHERE cus_id = '$cid'";
                            $Cresult = mysqli_query($connect, $sql);
                            $total_payment = 0;
                            $no = 1;

                            if (mysqli_num_rows($Cresult) > 0) {
                                while ($row = mysqli_fetch_assoc($Cresult)) {

                            ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td><?php echo $row['product_qty']; ?></td>
                                        <td>RM <?php echo number_format((float)$row['product_price'], 2, '.', ''); ?></td>
                                    </tr>
                                <?php
                                    $no += 1;
                                    $total_payment += $row['product_qty'] * $row['product_price'];
                                }
                            } else if(mysqli_num_rows($Cresult) <= 0 && $check==0)
                            {
                                ?>
                                <script>
                                    alert("Your cart is empty! Please add something.");
                                </script>
                            <?php
                                header("refresh:0.2 ; url=cart.php");
                            }

                            ?>
                        </thread>
                    </table>
                    <hr>
                    <p class="totalbill">Grand Total : RM <?php echo number_format((float)$total_payment, 2, '.', ''); ?></p>
                </div>

            </div>

            <div class="head_line">
                <div class="line">
                    <div class="head_line2"></div>
                    <div class="head_line1"></div>
                </div>
            </div>
        </div>

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
ob_end_flush();
mysqli_close($connect);
?>