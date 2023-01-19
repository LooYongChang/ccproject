<?php include("connection.php");
SESSION_START();
?>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&family=Josefin+Sans&display=swap" rel="stylesheet">

    <script>
        var srch = "";
        var opt = "";
        var pri="";

        $(document).ready(function(){
            
            jQuery('input[type="radio"]').click(function(){
               opt = $(this).val();
                    srch = "";
                    $.ajax({
                        url:"productType.php",
                        method:"POST",
                        data:{option:opt,search:srch,price:pri},
                        success:function(data){
                            $('#product_display').html(data);
                        }
                    }) 
                    document.querySelector('#sbox').value=""; 
            })

            $('#sbox').keyup(function(){
              srch = $('#sbox').val();
                    $.ajax({
                        url:"productType.php",
                        method:"POST",
                        data:{option:opt,search:srch,price:pri},
                        success:function(data){
                            $('#product_display').html(data);
                        }
                    })   
            })

            $('#price').change(function(){
               pri = $(this).find(":selected").val();
                    $.ajax({
                        url:"productType.php",
                        method:"POST",
                        data:{option:opt,search:srch,price:pri},
                        success:function(data){
                            $('#product_display').html(data);
                        }
                    })
            })



        })

    </script>
    
    
    <title>Product Page</title>

    <style>
        @import url("navbar2.css");

        #product1 {
            text-align: center;
            margin: 30px;
            color:maroon;

        }

        #product1 h2{
            font-family: 'Josefin Sans', sans-serif;
            color:maroon;
        }

        #product1 .pro-container {
            display: flex;
            justify-content: center;
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

        #product1 .pro img {
            width: 100%;
            border-radius: 20px;
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
            z-index: 1;
            transition: transform .1s;
        }

        #product1 .pro .cart:hover {
            transform: scale(1.2);
            ;
        }

        .remain_stock {

            color: grey;
            font-size: 13px;

        }

        #shop-head {
            background-image: url("image/head/shop-header.jpg");
            width: 100%;
            height: 30vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            padding: 14px;
        }

        #shop-head h2,
        #shop-head p {
            color: rgb(61, 52, 47);
            font-weight: 1000;
     
        }

        #shop-head h2
        {
            font-size:65px;
        }

        #shop-head p
        {
            font-size:25px;
        }

        input[type="radio"] {
            -webkit-appearance: none;
        }

        .searchcontainer {   
            width: 100%;
        }

        .search {

            background-color: whitesmoke;
            height: 13vh;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .search label {
            height: 50px;
            width: 120px;
            border: 2px solid darkolivegreen;
            margin: auto;
            border-radius: 10px;
            position: relative;
            color: darkolivegreen;
            transition: 0.5s;
        }

        .search .fa {
            font-size: 20px;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -80%);
        }

        .search label>span {
            font-size: 18px;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 80%);
        }

        .search input[type="radio"]:checked+label {
            background-color: darkolivegreen;
            color: #ffffff;
            box-shadow: 0 15px 45px rgb(24, 249, 141, 0.2);
        }

        .search-box
        {
            padding-top:20px;
            padding-bottom:20px;
        }

        .search-box input
        {
            padding:10px 5px 10px 10px;
            width:300px;
            border:2px solid grey;
            border-radius:10px;
 
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
                        $_SESSION['cartnum'] = 0;
                    }
                    ?>
                    <a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $_SESSION['cartnum'] ?>)</a>
                    <a href="aboutUs.php"><i class="fa fa-address-card"></i> About</a>
					
                    <div class="animation start-product"></div>
                </nav>
            </div>
        </div>
    </div>

    <section id="shop-head">
        <h2>#STAY SAFE</h2>
        <p>The Most Affordable and Worth Buying Furniture</p>
    </section>

    <section id="product1" class="section=p1">

        <h2>Aiture's Products</h2>
        <p>Top Collection New Morden Design</p>



        <div class="searchcontainer">
            <div class="search">

            <input type="radio" name="ptype" id="all"  value="All" checked>
                <label for="all">
                    <i class="fa-solid fa-bars fa"></i>
                    <span>All</span>
                </label>
                <?php 
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($result)>0)
                    {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
    
              <input type="radio" name="ptype" id="<?php echo $row['cat_title'];?>"  value="<?php echo $row['cat_title'];?>">
                <label for="<?php echo $row['cat_title'];?>">
                    <i class="<?php echo $row['cat_icon'];?>"></i>
                    <span><?php echo $row['cat_title'];?></span>
                </label>
                <?php 
                } 
                }
                ?>

               
            </div>
        </div>

        <!-- search box -->
        <div class="search-box">
                <input type="text" name="s-box" id="sbox" placeholder="Enter item name"> 

                <!-- sort price -->
                Sort by price
                <select id="price">
                    <option value="ascending">Low - High</option>
                    <option value="descending">High - Low</option>
                </select>
        </div>

        <div class="pro-container" id="product_display">
            <?php
            $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0 order by product_name ASC";
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
                            <h3>Stock: <?php echo $row['product_stock'] ?></h3>
                        </div>
                        <form name="product" method="post" action="">
                            <a class="cart" href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>"><i class="fa fa-shopping-cart"></i></a>
                        </form>
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