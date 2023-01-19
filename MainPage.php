<?php include("connection.php");
SESSION_START();
?>
<html>

<head>
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        @import url("navbar2.css");

        .main1 {
            position: static;
        }

        .mainPageImage {
            width: 100%;
            height: 550px;
            background-image: url(image/mainPagebg.png);
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mainPageImage .logo {
            height: 200px;
            display: block;
            margin: auto;
        }

        .mainPageImage .sub-heading {
            margin-top: 10px;
            text-align: center;
            color: rgb(248, 248, 248);
            text-transform: capitalize;
            font-size: 40px;
            font-weight: bold;
        }

        #feature {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        #feature .fe-box img {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
            transition: transform .2s;
        }

        #feature .fe-box img:hover {
            transform: scale(1.1);
        }

        #feature .fe-box {
            width: 180px;
            height: 200px;
            text-align: center;
            padding: 25px 15px;
            box-shadow: 20px 20px 34px rgba(0, 0, 0, 0.03);
            border: 1px solid #cce7d0;
            border-radius: 4px;
            margin: 15px 0;
        }

        #feature .fe-box:hover {
            box-shadow: 10px 10px 54px rgba(70, 62, 221, 0.1);
        }

        #feature .fe-box h6 {
            display: inline-block;
            padding: 9px 8px 6px 8px;
            line-height: 1;
            border-radius: 4px;
            color: rgb(49, 226, 167);
            background-color: #fddde4;
        }

        #feature .fe-box:nth-child(2) h6 {
            background-color: #cc3052;
        }

        #feature .fe-box:nth-child(3) h6 {
            background-color: #a087cc;
        }

        #feature .fe-box:nth-child(4) h6 {
            background-color: #d16526;
        }

        #feature .fe-box:nth-child(5) h6 {
            background-color: #6a68e4;
        }

        #product1 {
            text-align: center;
            margin: 30px;
        }

        #product1 .pro-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            flex-wrap: wrap;

        }

        #product1 .pro {
            width: 23%;
            min-width: 250px;
            padding: 10px 12px;
            border: 1px solid #cce7d0;
            border-radius: 25px;
            box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.02);
            margin: 15px;
            transition: 0.2 ease;
            position: relative;
        }

        #product1 .pro:hover {
            box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.06);
        }

        #product1 .pro{
            overflow:hidden;
        }

        #product1 .pro img {
            overflow:none;
            width: 100%;
            border-radius: 20px;
            transition: transform .2s;
        }

        #product1 .pro img:hover{
            transform: scale(1.2); 
        }

        #product1 .pro .type {
            text-align: start;
            padding: 10px 0;

        }

        #product1 .pro .type span {
            color: grey;
            font-size: 12px;
        }

        #product1 .pro .type h5 {
            padding-top: 7px;
            color: black;
            font-size: 14px;
        }

        #product1 .pro .type .star {
            color: rgb(243, 181, 25);

        }

        #product1 .pro .type h4 {
            padding-top: 7px;
            font-size: 15px;
            font-weight: 700;
            color: green;
        }

        #product1 .pro .cart {
            text-align: center;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50px;
            background-color: wheat;
            font-weight: 700;
            color: rgb(150, 113, 22);
            border: 1px solid #cce7d0;
            position: absolute;
            padding-top: 10px;
            bottom: 20px;
            right: 15px;
        }

        .sprodbtn {
            background: none;
            color: inherit;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }

        a 
        {
            text-decoration: none;
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
					
                    <div class="animation start-home"></div>
                </nav>
            </div>
        </div>
    </div>




    <div class=mainPageImage>
        <div class="content">

            <img src="image/nobgLogo.png" class="logo" alt="">

            <p class="sub-heading">
                best furniture collection
            </p>
        </div>
    </div>

    <section id="feature" class="section-p1">

        <div class="fe-box">
            <img src="image/feature/online_order.png" alt="">
            <h6>Online Order</h6>
        </div>

        <div class="fe-box">
            <img src="image/feature/free_shipping.png" alt="">
            <h6>Free Shipping</h6>
        </div>

        <div class="fe-box">
            <img src="image/feature/good_service.png" alt="">
            <h6>Best Service</h6>
        </div>

        <div class="fe-box">
            <img src="image/feature/Offer.png" alt="">
            <h6>Promotion</h6>
        </div>

        <div class="fe-box">
            <img src="image/feature/guarantee.png" alt="">
            <h6>60 days Guarantee</h6>
    </section>

    <section id="product1" class="section=p1">

        <h2>Hot Sales Products</h2>
        <p>Top Collection New Morden Design</p>
        <div class="pro-container">

        <?php
            $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0 order by product_sold DESC limit 6";
            $result = mysqli_query($connect, $sql);
            if(mysqli_num_rows($result)>0)
            {
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
               <div class="pro">
               <a href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>"> <img src="image/AllProductImg/<?php echo $row["product_image"]; ?>" alt=""></a>
                    <div class="type">
                        <span><?php echo $row['cat_title'] ?></span>
                        <a href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>">  <h5><?php echo $row["product_name"]; ?></h5></a>
                        <div class="star">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <h4>RM <?php echo number_format($row["product_price"],2) ?></h4>
                        <div class="remain_stock">
                            <h3>Sold: <?php echo $row['product_sold'] ?></h3>
                        </div>
                    </div>
                </div>
                
            <?php
            }
            }
            ?>
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
mysqli_close($connect);
?>