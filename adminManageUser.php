<?php include("connection.php");
ob_start();
SESSION_START();

if (isset($_SESSION['admin_id'])) {
    $aid = $_SESSION['admin_id'];
    $aname = $_SESSION['admin_name'];
    $aposition = $_SESSION['admin_position'];
} else {
?> <script>
        alert("Please login first !");
    </script><?php
                header("refresh:0.2, url=adminLogin.php");
            }
                ?>
<html>

<head>
    <title>Admin Users Management Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function confirmationA() {
            var option;
            option = confirm("Are you sure to DELETE this admin?")
            return option;
        }

        function confirmationC() {
            var option;
            option = confirm("Are you sure to DELETE this customer?")
            return option;
        }
    </script>

    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');

        * {
            font-family: 'Hubballi', cursive;
            margin: auto;
        }

        body {
            width: 100%;
            display: block;
            justify-content: center;
        }

        .container {
            display: block;
 
        }

        .adminHead {
            margin-top: 20px;
            text-align: center;
            font-size: 25px;
            color:chocolate;
            padding: 20px 0 20px 0;
            text-shadow: #FC0 1px 0 10px;
        }

        .container .cus,
        .container .adm {
            width: 1200px;
        }

        .container .cus table,
        .container .adm table {
            border-collapse: collapse;
            width: 100%;

        }

        .header_fixed {
            border-radius: 7px;
            max-height: 60vh;
            width: 100%;
            overflow: auto;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }

        .header_fixed thead th {
            position: sticky;
            top: 0;
            background-color: brown;
            color: #e6e7e8;
            font-size: 15px;
        }

        th {
            border-bottom: 1px solid #dddddd;
            padding: 10px 8px;
            font-size: 14px;
        }

        th img {
            height: 60px;
            width: 60px;
            border-radius: 100%;
            border: 5px solid #e6e7e8;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        tr:nth-child(odd) {
            background-color: #edeef1;
        }

        tr:hover th {
            color: #44b478;
            cursor: pointer;
            background-color: #ffffff;
        }

        th button {
            border: none;
            padding: 7px 20px;
            border-radius: 20px;
            background-color: darkgoldenrod;
            color: #e6e7e8;
        }

        footer {
            margin-top: 30px;
            width: 100%;
            height: 23px;
            background-color: #008B8B;
        }

        tbody a {
            text-decoration: none;
            color: black;
            font-size: 22px;

        }

        tbody a .fa {
            color: red;
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

        .search-order
        {
            margin-left:370px;
        }

        .search-order select
        {
            padding:5px 10px;
        }

        .CusHead
        {
            margin-top:40px;
            margin-bottom:-20px;
        }

        #showAdm:hover,
        #showCus:hover
        {
            cursor:pointer;
        }

        .backbtn
        {
            height: 45px;
            margin: 35px 0;
        }

        .backbtn input
        {
            height: 100%;
            width: 100%;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .backbtn:hover
        {
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
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
                    <a href="adminManageUser.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname ?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
                    <a href="adminHome.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    <a href="adminManageUser.php"><i class="fa-solid fa-users"></i></i> Manage User</a>
                    <a href="Manageproduct.php"><i class="fa-solid fa-list-check"></i> Manage product</a>
                    <a href="adminOrder.php"><i class="fa-solid fa-clipboard"></i> Manage Order</a>
                    <a href="adminReport.php"><i class="fa-solid fa-file-invoice"></i> Reports</a>
                    <div class="animation start-user"></div>
                </nav>
            </div>
        </div>
    </div>


    <div class='container'>
        <div class="adm">
            <?php
            if ($_SESSION['admin_position'] == "Main Admin") {
            ?>


                <div class="adminHead">
                    <h3 id="showAdm">Admin</h3>
                    <i class="fa-solid fa-caret-down fa admicon"></i>
                </div>

                <div class="header_fixed">
                    <table>
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Position</th>
                                <th>Password</th>
                                <th>Home Address</th>
                                <th>Postcode</th>
                                <th>State</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($connect, "SELECT * FROM admin ");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $position = $row['admin_position'];
                                    if($aid == $row['admin_id'])
                                    {
                                        $me = " (Me) ";
                                    }
                                    else
                                    {
                                        $me = "";
                                    }
                            ?>
                                    <tr>
                                        <th><?php echo $row['admin_id']; ?></th>

                                        <th><img src="image/aboutUs/<?php echo $row['admin_image']; ?>" /></th>
                                        <th><?php echo $row['admin_name'].$me;?> </th>
                                        <th><?php echo $row['admin_gender']; ?></th>
                                        <th><?php echo $row['admin_email']; ?></th>
                                        <th><?php echo $row['admin_contact']; ?></th>
                                        <th><?php echo $position; ?></th>
                                        <th><?php echo $row['admin_pass']; ?></th>
                                        <th><?php echo $row['admin_address']; ?></th>
                                        <th><?php echo $row['admin_postcode']; ?></th>
                                        <th><?php echo $row['admin_state']; ?></th>
                                       
                                            <?php
                                            if ($position != "Main Admin") {
                                            ?>
                                        <th><a onclick="return confirmationA();" href="adminManageUser.php?adel&aid=<?php echo $row['admin_id'];?>&aname=<?php echo $row['admin_name'];?>"><button>delete</button></a></th>
                                    <?php
                                            } else {
                                    ?>
                                         <th><a href="adminEditUser.php?aedt&aid=<?php echo $row['admin_id']; ?>"><button>Edit</button></a></th>
                                    <?php
                                            }
                                    ?>

                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr class="addadmin">
                        <th colspan="12"><a href="adminAddUser.php?aadd">Add Admin <i class="fa-solid fa-plus fa" color="red"></i></a></th>
                    </tr>

                        </tbody>
                    </table>
                </div>

            <?php
            } else if ($_SESSION['admin_position'] == "Admin") {
            ?>
                <div class="adminHead">
                    <h3 id="showAdm">Admin</h3>
                    <i class="fa-solid fa-caret-down fa admicon"></i>
                </div>

                <div class="header_fixed">
                    <table>
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Image</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Position</th>
                                <th>Password</th>
                                <th>Home Address</th>
                                <th>Postcode</th>
                                <th>State</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                            <?php
                            $result = mysqli_query($connect, "SELECT * FROM admin WHERE admin_id = '$aid'");
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $position = $row['admin_position'];
                            ?>
                                    <tr>
                                        <th><?php echo $row['admin_id']; ?></th>

                                        <th><img src="image/aboutUs/<?php echo $row['admin_image']; ?>" /></th>
                                        <th><?php echo $row['admin_name']; ?> (me)</th>
                                        <th><?php echo $row['admin_gender']; ?></th>
                                        <th><?php echo $row['admin_email']; ?></th>
                                        <th><?php echo $row['admin_contact']; ?></th>
                                        <th><?php echo $position; ?></th>
                                        <th><?php echo $row['admin_pass']; ?></th>
                                        <th><?php echo $row['admin_address']; ?></th>
                                        <th><?php echo $row['admin_postcode']; ?></th> 
                                        <th><?php echo $row['admin_state']; ?></th>        
                                        <th><a href="adminEditUser.php?aedt&aid=<?php echo $row['admin_id']; ?>"><button>Edit</button></a></th>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>

        </div>

       
    <script>
         var srt="";
        var orname="";
            $(document).ready(function() {
            jQuery('#cusid').click(function() {
                    srt = $(this).find(":selected").val();
                    $.ajax({
                        url: "ajaxManageUser.php",
                        method: "POST",
                        data: {sort:srt,cusName:orname},
                        success: function(data) {
                            $('.cus .header_fixed').html(data);
                        }
                    })
                })

                $('#sbox').keyup(function(){

                    orname = $('#sbox').val();
                        $.ajax({
                            url:"ajaxManageUser.php",
                            method:"POST",
                            data:{sort:srt,cusName:orname},
                            success:function(data){
                                $('.cus .header_fixed').html(data);
                            }
                        })   
                })

                $('.adm .header_fixed').hide();
                $('.adminHead .admicon').hide();
                $('#showAdm').click(function(){
                    
                    $('.adm .header_fixed, .adminHead .admicon').slideToggle();
                })

                $('#showCus').click(function(){
                    
                    $('.cus, .CusHead .cusicon').slideToggle();
                })


            })
    </script>


        <div class="adminHead CusHead">
        
                <h3 id="showCus">Customer</h3>
                <i class="fa-solid fa-caret-down fa cusicon"></i>
            </div>
        <div class="cus">


            <div class="search-order">
            <div class="search-box">
            <input type="text" name="s-box" id="sbox" placeholder="Search by Customer name">

            Sort by 
            <select name="order" id="cusid">
                <option value="ASC"> Customer ID Ascending</option>
                <option value="DSC">Customer ID Descending</option>
            </select>

            </div>
            </div>

            <div class="header_fixed">
                <table>
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Password</th>
                            <th>Home Address</th>
                            <th>Postcode</th>
                            <th>State</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr class="adduser">
                        <th colspan="10"><a href="adminAddUser.php?cadd">Add Customer <i class="fa-solid fa-plus fa" color="red"></i></a></th>
                    </tr>
                        <?php
                        $result = mysqli_query($connect, "SELECT * FROM customer ");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <th><?php echo $row['Cus_ID']; ?></th>
                                    <th><?php echo $row['Cus_Name']; ?></th>
                                    <th><?php echo $row['Cus_Gender']; ?></th>
                                    <th><?php echo $row['Cus_Email']; ?></th>
                                    <th><?php echo $row['Cus_Contact']; ?></th>
                                    <th><?php echo $row['cus_pass']; ?></th>
                                    <th><?php echo $row['Cus_Address']; ?></th>
                                    <th><?php echo $row['cus_postcode']; ?></th>
                                    <th><?php echo $row['cus_state']; ?></th>
                                   
                                    <th><a onclick="return confirmationC();" href="adminManageUser.php?cdel&cid=<?php echo $row['Cus_ID'];?>&cname=<?php echo $row['Cus_Name'];?>"><button>delete</button></a></th>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



</body>

</html>
<?php
if (isset($_GET['logout'])) 
{
    SESSION_DESTROY();
?> 
    <script>
        alert("Successfully Log Out");
    </script><?php
    header("refresh:0.2, url=adminLogin.php");
}


if (isset($_GET['adel'])) 
{
    $adid = $_GET['aid'];
    $adname = $_GET['aname']; 
    mysqli_query($connect, "DELETE FROM admin WHERE admin_id = $adid");

    $delLog = "has DELETE an Admin (".$adname.") from Admin database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$adid','$aname','$delLog','$date.' '.$time')");
    
    ?>
    <script>
        alert("You had delete an admin");
    </script> 
    <?php
    header("refresh:0.2, url=adminManageUser.php");
}

if (isset($_GET['cdel'])) {
    $cid = $_GET['cid'];
    $cname = $_GET['cname'];
    mysqli_query($connect, "DELETE FROM customer WHERE Cus_ID = $cid");
    $edtLog = "has DELETE a Customer (".$cname.") from Customer database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$edtLog','$date.' '.$time')");
    ?>
    <script>
        alert("You had delete a customer");
    </script> 
    <?php
    header("refresh:0.2, url=adminManageUser.php");
}

    ob_end_flush();
    mysqli_close($connect);
?>