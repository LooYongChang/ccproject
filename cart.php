<?php include("connection.php");
ob_start();
SESSION_START();
/* if not yet login */
if (!isset($_SESSION['login'])) {
?>
    <script>
        alert('Please Login first!');
    </script>
<?php
    header("Refresh:0.2; url=login.php");
}
else{

    if (!(isset($_SESSION['cart']))) {
        $_SESSION['cart'] = array();
    }
        $cid = $_SESSION['id'];
        $sql = "SELECT * FROM cart WHERE cus_id = '$cid'";
        $Cresult = mysqli_query($connect, $sql);

        if(mysqli_num_rows($Cresult) > 0)
        {
            $_SESSION['cartnum']=mysqli_num_rows($Cresult);
            while($row = mysqli_fetch_assoc($Cresult))
            {
                $pid = $row['product_id'];
                $_SESSION['cart'][$pid] = $row['product_qty'];
            }
        }
        else
        {
            $_SESSION['cartnum']=0;
        }
        


    /* remove selected cart colomn*/
    if (isset($_GET['del'])) {
        $delId = $_GET['proid'];

        unset($_SESSION['cart'][$delId]);
        mysqli_query($connect,"DELETE FROM cart WHERE product_id='$delId' AND cus_id='$cid'");
        header("refresh:0.5; url=cart.php");
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>

        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Cart Page</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function confirmation() {
                var option;
                option = confirm("Do you want to delete this product?")
                return option;
            }
        </script>

        <style>
            @import url("navbar2.css");

            #cart-head {
                background-image: url("image/head/carthead.png");
                width: 100%;
                height: 20vh;
                background-size: cover;
                display: flex;
                justify-content: center;
                text-align: center;
                flex-direction: column;
                padding: 14px;
            }

            #cart-head h2,
            #cart-head p {
                color: #FFFFFF;
                text-shadow: 0 -1px 4px black, 0 -2px 10px black, 0 -10px 20px #ff8000, 0 -18px 40px #F00;
            }

            #cart table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
                white-space: nowrap;
            }

            #cart table img {
                width: 90px;
            }

            #cart table td:nth-child(1) {
                width: 100px;
                text-align: center;
            }

            #cart table td:nth-child(2) {
                width: 150px;
                text-align: center;
            }

            #cart table td:nth-child(3) {
                width: 150px;
                text-align: center;
            }

            #cart table td:nth-child(4)
            {
                width: 100px;
                text-align: center;
            }

            #cart table td:nth-child(5)
            {
                width: 200px;
                text-align: center;
            }

            #cart table td:nth-child(6),
            #cart table td:nth-child(7) {
                width: 120px;
                text-align: center;
            }

            #cart table td:nth-child(8) {
                width: 100px;
                text-align: center;
            }

            #cart table td:nth-child(7) input {
                width: 70px;
                padding: 10px 5px 10px 15px;
            }

            #cart table thead {
                border: 1px solid black;
                border-left: none;
                border-right: none;
            }

            #cart table thead td {
                font-weight: 700;
                text-transform: uppercase;
                font-size: 13px;
                padding: 18px 0;
            }

            #cart table tbody tr td {
                padding-top: 15px;
            }

            #cart table tbody tr td {
                font-size: 13px;
            }

            #cart-add {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            #coupon {
                width: 50%;
                margin-bottom: 30px;
            }

            #coupon h3,
            #subtotal h3 {
                padding-bottom: 15px;
            }

            #coupon input {
                padding: 10px 20px;
                outline: none;
                width: 60%;
                margin-right: 10px;
                border: 1px solid black;
            }

            #subtotal button,
            #update-btn {
                background-color: #088178;
                color: #fff;
                
            }

            #subtotal button
            {
                margin-left: 70px;
            }

            #subtotal {
                width: 50%;
                margin-bottom: 30px;
                border: 1px solid black;
                padding: 30px;
            }

            #subtotal table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
            }

            #subtotal table td {
                width: 50%;
                border: 1px solid black;
                padding: 10px;
                font-size: 13px;
                text-decoration: none;
            }

            .normal {
                padding: 12px 20px;
                border: none;
                border-radius: 5px;
            }

            .normal:hover {
                transform: scale(1.1);
            }

            .normal a {
                text-decoration: none;
                color: white;
            }

            #removeIcon {
                color: red;
                font-size: 18px;
            }

            #removeIcon:hover {
                transform: scale(1.3);
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
                            if(!isset($_SESSION['cartnum']))
                            {
                                $_SESSION['cartnum'] = 0;
                            }
                        ?>
                        <a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $_SESSION['cartnum'] ?>)</a>
                        <a href="aboutUs.php"><i class="fa fa-address-card"></i> About</a>
                        <div class="animation start-cart"></div>
                    </nav>
                </div>
            </div>
        </div>

        <section id="cart-head">
            <h2>Shopping Cart</h2>
            <p>The Most Affordable and Worth Buying Furniture</p>
        </section>

        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>REMOVE</td>
                        <td>IMAGE</td>
                        <td>PRODUCT</td>
                        <td>TYPE</td>
                        <td>SIZE</td>
                        <td>PRICE</td>
                        <td>QUANTITY</td>
                        <td>SUBTOTAL</td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    foreach ($_SESSION['cart'] as $key => $val) {
                        $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_id='$key'";
                        $result = mysqli_query($connect, $sql);
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <form method="get" name="cart" action="">
                            <tr>
                                <td><a onclick="return confirmation();" href="cart.php?del&proid=<?php echo $row['product_id'] ?>"> <i class="fa fa-times-circle" id="removeIcon"></i></a></td>
                                <td><img src="image/AllProductImg/<?php echo $row['product_image'] ?>" alt=""></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['cat_title']; ?></td>
                                <td><?php echo $row['product_size']; ?></td>
                                <td>RM <?php echo number_format($row['product_price'], 2) ?></td>
                                <td><input type="number" class="iqty" id="cart-qty" onchange="subtotal()" name="cartqty" min="1" max="<?php echo $row['product_stock'] ?>" value="<?php echo $val; ?>"></td>
                                <td>RM <span class="itotal" id="proprice"></span></td>

                                <input class="iprice" type="hidden" value="<?php echo number_format($row['product_price'], 2) ?>">
                                <input class="pid" type="hidden" name="pid" value="<?php echo $key; ?>">
                            </tr>
                        </form>

                    <?php
                    }

                    if (empty($_SESSION['cart'])) {
                    ?>
                        <tr>
                            <td colspan='8' style="font-size:20px; color:grey; font-weight:bold; padding-top:30px;">Your Cart is Empty!</td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </section>

        <section id="cart-add" class="section-p1">
        

            <div id="subtotal">
                <h3>Cart Totals</h3>
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td id="gtotal"></td>
                    </tr>

                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>

                    <tr>
                        <td><strong>Total</strong></td>
                        <strong>
                            <td id="gftotal" style="font-weight:bold;"></td>
                        </strong>
                    </tr>
                </table>
                <button class="normal" id="shpbtn"><a href="shop.php">Continue Shopping</a></button> 
                <button class="normal" id="checkoutbtn"><a href="checkout.php">Proceed to checkout</a></button>
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

    <script>
        var gt = 0;
        var iprice = document.getElementsByClassName("iprice");
        var iqty = document.getElementsByClassName("iqty");
        var itotal = document.getElementsByClassName("itotal");
        var gtotal = document.getElementById("gtotal");
        var gftotal = document.getElementById("gftotal");

        /* update total,price (for display only, not in database) */
        function subtotal() {
            gt = 0;
            for (i = 0; i < iprice.length; i++) {
                itotal[i].innerText = parseFloat((iprice[i].value) * (iqty[i].value)).toFixed(2);
                gt += (iprice[i].value) * (iqty[i].value);
            }
        
            gtotal.innerText = "RM " + parseFloat(gt).toFixed(2);
            gftotal.innerText = "RM " + parseFloat(gt).toFixed(2);


        }
        subtotal();

        /* auto update cart qty wihout refresh with ajax (in database) */
        $(document).ready(function(){
            $('.iqty').on('change',function(){
                    var $el = $(this).closest('tr');

                    var pid = $el.find(".pid").val();
                    var qty= $el.find(".iqty").val();
                    $.ajax({
                            url:"AjaxUpdateCartQty.php",
                            method:"POST",
                            data:
                            {
                                prodid:pid,
                                quantity:qty
                            },
                            success: function(response){
                                console.log(response)
                            }              
                        })      
                });
            });


    </script>

    </html>


    <?php
    }
    mysqli_close($connect);
    ?>