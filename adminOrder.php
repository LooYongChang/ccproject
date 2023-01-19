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
    <title>Orders Management</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>

        var infoOpt="";
        var srt="";
        var orname="";
        
        $(document).ready(function() {

            /* select order-info and search*/
            jQuery('.orderinfo').click(function() {
                infoOpt = $(this).val();
                $.ajax({
                    url: "AjaxadminOrder.php",
                    method: "POST",
                    data: {option:infoOpt,sort:srt,cusName:orname},
                    success: function(data) {
                        $('#infotable').html(data);
                    }
                })
                    document.querySelector('#sbox').value="";
                    orname="";
            })

            jQuery('#orderid').click(function() {
                srt = $(this).find(":selected").val();
                $.ajax({
                    url: "AjaxadminOrder.php",
                    method: "POST",
                    data: {option:infoOpt,sort:srt,cusName:orname},
                    success: function(data) {
                        $('#infotable').html(data);
                    }
                })
            })

            $('#sbox').keyup(function(){
                orname = $('#sbox').val();
                    $.ajax({
                        url:"AjaxadminOrder.php",
                        method:"POST",
                        data:{option:infoOpt,sort:srt,cusName:orname},
                        success:function(data){
                            $('#infotable').html(data);
                        }
                    })   
            })


        })
    </script>

    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');

        * {
            font-family: 'Hubballi', cursive;
            margin: auto;
            padding: auto;
            text-align: center;
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

        .infotable {
            margin-top: 10px;
            width: 90%;

        }

        .content-table {
            border-collapse: collapse;
            min-width: 900px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: rgb(65, 105, 225);
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .content-table th {
            padding: 12px 15px;
            font-size: 14px;
        }

        .content-table thead tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(odd) {
            background-color: whitesmoke;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #dcdcdc;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid rgb(65, 105, 225);
        }

        .content-table tbody tr:hover {
            font-weight: bold;
            color: cadetblue;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: lightseagreen;
            color: white;
            font-size: 20px;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        .btn a {
            text-decoration: none;
            color: white;
        }


        footer {
            margin-top: 60px;
            width: 100%;
            height: 23px;
            background-color: #008B8B;
        }

        .search {
            height: 13vh;
            width: 600px;
            display: flex;
            padding-top: 40px;
        }

        .search label {
            height: 60px;
            width: 250px;
            border: 2px solid rgb(70, 130, 180);
            margin: auto;
            border-radius: 10px;
            position: relative;
            color: rgb(70, 130, 180);
            transition: 0.5s;
        }

        .search .fa {
            font-size: 20px;
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -80%);
        }

        .search label>span {
            width: 100%;
            font-size: 18px;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 80%);
        }

        .search input[type="radio"]:checked+label {
            background-color: rgb(70, 130, 180);
            color: #ffffff;
            box-shadow: 0 15px 45px rgb(24, 249, 141, 0.2);
        }

        .search-box {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .search-box input {
            padding: 10px 5px 10px 10px;
            width: 300px;
            border: 2px solid grey;
            border-radius: 10px;

        }

        input[type="radio"] {
            -webkit-appearance: none;
        }

        .prodoption {
            margin: auto;
            width: 100%;
            text-align: center;
        }

        .orderInfo {
            background-color: lightsteelblue;
        }

        .orderInfo h3 {
            text-align: left;
            color: darkslateblue;
            font-size: 20px;
        }

        .orderInfo p {
            text-align: left;
            color: black;
            font-size: 16px;
            margin-left:5px;
        }

        .search-order
        {
            margin-top:60px;
        }

        .search-order select
        {
            padding:5px 10px;
        }

        table h6
        {
            text-align: center;
            font-size:18px;
            color:red;
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
                <a href="adminOrder.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
                    <a href="adminHome.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    <a href="adminManageUser.php"><i class="fa-solid fa-users"></i></i> Manage User</a>
                    <a href="Manageproduct.php"><i class="fa-solid fa-list-check"></i> Manage product</a>
                    <a href="adminOrder.php"><i class="fa-solid fa-clipboard"></i> Manage Order</a>
                    <a href="adminReport.php"><i class="fa-solid fa-file-invoice"></i> Reports</a>
                    <div class="animation start-order"></div>
                </nav>
            </div>
        </div>
    </div>

    <div class="searchcontainer">
        <div class="search">
            <input type="radio" name="ptype" class="orderinfo" id="delivery" value="delivery" checked>
            <label for="delivery">
                <i class="fa-solid fa-truck-ramp-box fa"></i>
                <span>Manage Order Delivery</span></a>
            </label>


            <input type="radio" name="ptype" class="orderinfo" id="viewOrder" value="view">
            <label for="viewOrder">
                <i class="fa-solid fa-eye fa"></i>
                <span>View Order / Feedback</span>
            </label>

        </div>
    </div>

    <!-- search and sort order -->
    <div class="search-order">
        <div class="search-box">
            <input type="text" name="s-box" id="sbox" placeholder="Search by Customer name">

            Sort by 
            <select name="order" id="orderid">
                <option value="DSC"> Order ID Descending</option>
                <option value="ASC">Order ID Ascending</option>
            </select>

        </div>



    <div id="infotable">
    <section class="infotable" id="infot">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>order ID</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Delivery Status</th>
                        <th>Change Status</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM order_list order by order_id desc";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th><?php echo $row["order_id"]; ?></th>
                                <th><?php echo $row["cus_name"]; ?></th>
                                <th><?php echo $row["cus_address"]; ?></th>
                                <th><?php echo $row["delivery_status"]; ?></th> 
                                <?php
                                if($row["delivery_status"] == "In Transit")
                                {
                                ?>                  
                                <th><a href="adminOrder.php?arr&oid=<?php echo $row['order_id'] ?>"><button class="btn">Arrived</button></a></th>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <th><a href="adminOrder.php?una&oid=<?php echo $row['order_id'] ?>"><button class="btn">Unarrive</button></a></th>
                                    <?php
                                }

                                if($row['delivery_status'] != "Arrived")
                                {
                                ?>

                                 <th><a href="adminOrder.php?cancel&oid=<?php echo $row['order_id'] ?>"><button class="btn">Cancel</button></a></th>
                                <?php 
                                }
                                else
                                {
                                    ?>

                                    <th></th>
                                   <?php  
                                }
                                ?>
                                </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="no-result">
                            <th colspan="9"><strong>Currently no order !</strong></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>


    <footer></footer>

</body>

</html>
<?php
if(isset($_GET['logout']))
{
    SESSION_DESTROY();
    ?> <script>alert("Successfully Log Out");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}

/* arrived */
if(isset($_GET['arr']))
{
    $oid = $_GET['oid'];

    mysqli_query($connect,"UPDATE order_list SET delivery_status = 'Arrived' WHERE order_id = '$oid'");

    $Log = "has UPDATE a order delivery status : (ID " . $oid . ") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");

    mysqli_query($connect, "INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$Log','$date.' '.$time')");

    header("refresh:0.2, url=adminOrder.php");
}

/* unarrive */
if(isset($_GET['una']))
{
    $oid = $_GET['oid'];

    mysqli_query($connect,"UPDATE order_list SET delivery_status = 'In Transit' WHERE order_id = '$oid'");

    $Log = "has UPDATE a order delivery status : (ID " . $oid . ") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");

    mysqli_query($connect, "INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$Log','$date.' '.$time')");

    header("refresh:0.2, url=adminOrder.php");
}

if(isset($_GET['cancel']))
{
    $oid = $_GET['oid'];
                          
    mysqli_query($connect,"DELETE FROM order_list WHERE order_id='$oid'");
   
    $Log = "has CANCEL a order: (ID " . $oid . ") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect, "INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$Log','$date.' '.$time')");

    ?> <script>alert("Order ID : <?php echo $oid; ?> has been cancel.");</script><?php
    header("refresh:0.2, url=adminOrder.php");
}

ob_end_flush();
mysqli_close($connect);
?>