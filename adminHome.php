<?php include("connection.php");
ob_start();
SESSION_START();
if(isset($_SESSION['admin_id']))
{
    $aid= $_SESSION['admin_id'];
    $aname = $_SESSION['admin_name'];
    $aposition = $_SESSION['admin_position'];
}
else
{
    ?> <script>alert("Please login first !");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}
?>
<html>

<head>
    <title>Admin Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function datalogconfirmation() {
            var option;
            option = confirm("Are you sure to clear all datalog?")
            return option;
        }
    </script>

    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');
        *
        {
            font-family:'Hubballi', cursive;
        }

        .datainfo
        {
            height:80px;
            width:900px;
            display:flex;
            justify-content: center;
            align-items: center;
            padding-top:20px;
        }

        .datainfo .info 
        {
            text-align: center;
            width:200px;
            height:70px;
            border-radius:5px;
            padding:6px;
            transition: all .2s ease-in-out;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .datainfo .info .data
        {
            font-size:20px;
        }

        .datainfo .info:hover
        {
            transform: scale(1.1);
        }     
        
        .info i
        {
            font-size:22px;
        }

        .datainfo .info h4
        {
             font-size:25px;
             padding-top:8px;
        }

        .datainfo .info:nth-child(1)
        {
            background-color:lightslategray;
            color:blanchedalmond;
        }

        .datainfo .info:nth-child(1) h4
        {
            color:blanchedalmond;
        }

        .datainfo .info:nth-child(2)
        {
            background-color:lightskyblue;
        }

        .datainfo .info:nth-child(2) h4
        {
            color:#008B8B;
        }

        .datainfo .info:nth-child(3)
        {
            background-color:lightgreen;
        }

        .datainfo .info:nth-child(3) h4
        {
            color:darkolivegreen;
        }

        .datainfo .info:nth-child(4)
        {
            background-color:lightcoral;
        }
        
        .datainfo .info:nth-child(4) h4
        {
            color:darkviolet;
        }

        .dataChanges
        {
            text-align:center;
            margin-top:40px;
            width:100%;
            display:flex;

        }

        .dataChanges h2
        {
            padding-bottom:10px;
        }

        .dataChanges .bline
        {
            background-color:red;
            width:95%;
            height:10px;
            margin-bottom:30px;
            
        }

        .History_container
        {
          
            height:250px;
            width:700px;
            margin:auto;
            overflow:hidden;
            overflow-y:scroll;
            border:2px solid #008B8B;
            border-radius:10px 0 0 10px;
            background-color:rgb(224,255,255);
            margin-bottom:10px;
            margin-left:40px;
        }

        .Historytitle
        {
            color: #444444;
            text-shadow: 1px 0px 1px #CCCCCC, 0px 1px 1px #EEEEEE, 2px 1px 1px #CCCCCC, 1px 2px 1px #EEEEEE, 3px 2px 1px #CCCCCC, 2px 3px 1px #EEEEEE, 4px 3px 1px #CCCCCC, 3px 4px 1px #EEEEEE, 5px 4px 1px #CCCCCC, 4px 5px 1px #EEEEEE, 6px 5px 1px #CCCCCC, 5px 6px 1px #EEEEEE, 7px 6px 1px #CCCCCC;
        }

        .History_text p
        {
            text-align:left;
            font-size:20px;
            padding:10px 15px 0 15px;
        }

        .edtbtn
        {
            font-size:20px;
            padding:5px 10px 5px 10px;
            background-color:white;
            border-radius:5px;
        }

        .topSales
        {
            width:30%;
        }

        .topSales h3
        {
            font-size:20px;
            padding-bottom:5px;
        }

        .topSales .top5
        {
            font-weight: bold;
            font-size:25px;
            color:darkred
        }

        footer
        {
            margin-top:5px;
            width:100%;
            height:23px;
            background-color:#008B8B;
        }

        .topprodcontainer
        {
         
            height:355px;
            display:block;
            width:300px;
            margin-bottom:5px;
            border-radius:10px;
        }

        .topsales h3
        {
            padding-top:20px;
        }

        .topprod
        {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            background-color:pink;
            border:1px solid red;
            border-radius:10px;
            height:65px;
            position:relative;
        }

        .topprod .topimg 
        {
            height:100%;
            width:100%;
            position:relative;
            overflow: hidden;
        }

        .topprod .topimg img
        {
            width:70px;
            height:62px;
            position:absolute;
            left:0;
            top:0;
            border-radius:12px;
        }

        .topprod .topinfo
        {
            position:absolute;
            top:10px;
            left:90px;
        }

        .topprod .topinfo p
        {
            float:left;
        }

        .topprod .topimg h3
        {
            position:absolute;
            left:1;
            top:-18;
            font-size:18px;
            color:darkred;
            font-weight:20px;
        }

        body{
        width: 100%;
        background: linear-gradient(-45deg,#5B247A,#A6E0E9,#CCFBFF,#EF96C5);
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
                    <a href="adminHome.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
                    <a href="adminHome.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    <a href="adminManageUser.php"><i class="fa-solid fa-users"></i></i> Manage User</a>
                    <a href="Manageproduct.php"><i class="fa-solid fa-list-check"></i> Manage product</a>
                    <a href="adminOrder.php"><i class="fa-solid fa-clipboard"></i> Manage Order</a>
                    <a href="adminReport.php"><i class="fa-solid fa-file-invoice"></i> Reports</a>
                    <div class="animation start-home"></div>
                </nav>
            </div>
        </div>
    </div>

    <section class="datainfo">
        
        <div class="info">
            <h4><i class="fa-brands fa-product-hunt"></i> Total Product</h4>
            <?php 
                $presult = mysqli_query($connect,"SELECT * FROM product WHERE product_Is_delete = 0");
                $total_prod = mysqli_num_rows($presult);
            ?>
            <span class="data"><?php echo $total_prod ?> products</span>
        </div>

        <div class="info">
            <h4><i class="fa-solid fa-parachute-box"></i> Items Sold</h4>
            <?php 
                $psold = 0;
                $sresult = mysqli_query($connect,"SELECT * FROM product");
                while($srow=mysqli_fetch_assoc($sresult))
                {
                    $psold += $srow["product_sold"];
                }
            ?>
            <span class="data"><?php echo $psold ?> Items</span>
        </div>
    

        <div class="info">
            <h4><i class="fa-solid fa-clipboard"></i> Current Order</h4>
            <?php 
                $oresult = mysqli_query($connect,"SELECT * FROM order_list");
                $total_order = mysqli_num_rows($oresult);
            ?>
            <span class="data"><?php echo $total_order ?> Orders</span>
        </div>
        
        <div class="info">
            <h4><i class="fa-solid fa-hand-holding-dollar"></i> Total Sales</h4>
            <?php 
                $tearn = 0;
                $tresult = mysqli_query($connect,"SELECT * FROM product");
                while($trow=mysqli_fetch_assoc($tresult))
                {
                    $tearn += ($trow["product_price"] * $trow["product_sold"] );
                }
            ?>
            <span class="data">RM <?php echo number_format($tearn,2) ?></span>
        </div>
    </section>


    <section class="dataChanges"> 

        <div class="hischange">
            <div class="HistoryTitle">
                <h2>Historical data changes</h2>
            </div>

            <div class="bline"> </div>

            <div class="History_container">
                <div class="History_text">
                    <p>Admin Log Start. Latest 10 message.</p>
                    <?php
                    $lresult = mysqli_query($connect,"SELECT * FROM admindatalog ORDER BY log_id DESC LIMIT 10");
                    if(mysqli_num_rows($lresult)>0)
                    {
                        while($lrow=mysqli_fetch_assoc($lresult))
                        {
                        ?>
                            <p><?php echo $lrow['log_time']?> <strong><?php echo $lrow['admin_name']?></strong> <?php echo $lrow['log_text']?></p>

                    <?php 
                        }
                    }
                    ?>

                </div>
            </div>
                    <!-- ~~clear datalog data from database~~ -->
                <form method="post" action="">
                    <button class="edtbtn" name="clrdatabtn" onclick="return datalogconfirmation();">Clear All History Data</button>
                </form>     
        </div>

        <div class="topSales">
                <h3><span class="top5">Top 5</span> sales products</h3>
                <div class="topprodcontainer">

                    <?php 
                    $zresult = mysqli_query($connect,"SELECT * FROM product ORDER BY product_sold DESC limit 5 ");
                    $topno = 1;
                    while($zrow=mysqli_fetch_assoc($zresult))
                    {
                    ?>
                    <div class="topprod">
                        <div class="topimg">
                            <img src="image/AllProductImg/<?php echo $zrow['product_image']; ?>">
                            <h3>Top <?php echo $topno; ?></h3>
                        </div>

                        <div class="topinfo">
                                <p>Item name : <strong><?php echo $zrow['product_name']; ?></strong></p>
                                <p>Item price : RM <?php echo number_format($zrow['product_price'],2); ?></p>
                                <p>Item sold : <?php echo $zrow['product_sold']; ?> Items</p>
                        </div>
                    </div>
                    <?php
                    $topno++;
                    }
                    ?>
                </div>
        </div>
    
    </section>


        <footer>
            
        </footer>

</body>

</html>
<?php
if(isset($_GET['logout']))
{
    SESSION_DESTROY();
    ?> <script>alert("Successfully Log Out");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}

if(isset($_POST['clrdatabtn']))
{
    mysqli_query($connect,"DELETE FROM admindatalog");
    header("refresh:0.2, url=adminHome.php");
}
ob_end_flush();
mysqli_close($connect);
?>