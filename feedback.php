<?php include("connection.php");
session_start();
ob_start();
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

if (isset($_GET['fback'])) {
    $oid = $_GET['oid'];
    $sql = "SELECT * FROM order_list WHERE order_id = '$oid'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
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

        body {
            background-color: #e6e6fa;
            background-repeat: no-repeat;

        }

        .wrapper {
            max-width: 500px;
            width: 100%;
            background: #fff;
            margin: 60px auto;
            box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.125);
            padding: 30px;
        }

        .wrapper .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fec107;
            text-transform: uppercase;
            text-align: center;
        }

        .wrapper .form {
            width: 100%;
        }

        .wrapper .form .inputfield {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .wrapper .form .inputfield label {
            width: 200px;
            color: #757575;
            margin-right: 10px;
            font-size: 14px;
        }

        .wrapper .form .inputfield .input,
        .wrapper .form .inputfield .textarea {
            width: 100%;
            outline: none;
            border: 1px solid #d5dbd9;
            font-size: 15px;
            padding: 8px 10px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .wrapper .form .inputfield .textarea {
            width: 100%;
            height: 125px;
            resize: none;
        }

        .wrapper .form .inputfield .custom_select {
            position: relative;
            width: 100%;
            height: 37px;
        }

        .wrapper .form .inputfield .custom_select:before {
            content: "";
            position: absolute;
            top: 12px;
            right: 10px;
            border: 8px solid;
            border-color: #d5dbd9 transparent transparent transparent;
            pointer-events: none;
        }

        .wrapper .form .inputfield .custom_select select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            width: 100%;
            height: 100%;
            border: 0px;
            padding: 8px 10px;
            font-size: 15px;
            border: 1px solid #d5dbd9;
            border-radius: 3px;
        }


        .wrapper .form .inputfield .input:focus,
        .wrapper .form .inputfield .textarea:focus,
        .wrapper .form .inputfield .custom_select select:focus {
            border: 1px solid #fec107;
        }

        .wrapper .form .inputfield p {
            font-size: 14px;
            color: #757575;
        }

        .wrapper .form .inputfield .check {
            width: 15px;
            height: 15px;
            position: relative;
            display: block;
            cursor: pointer;
        }

        .wrapper .form .inputfield .check input[type="checkbox"] {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .wrapper .form .inputfield .check .checkmark {
            width: 15px;
            height: 15px;
            border: 1px solid #fec107;
            display: block;
            position: relative;
        }

        .wrapper .form .inputfield .check .checkmark:before {
            content: "";
            position: absolute;
            top: 1px;
            left: 2px;
            width: 5px;
            height: 2px;
            border: 2px solid;
            border-color: transparent transparent #fff #fff;
            transform: rotate(-45deg);
            display: none;
        }

        .wrapper .form .inputfield .check input[type="checkbox"]:checked~.checkmark {
            background: #fec107;
        }

        .wrapper .form .inputfield .check input[type="checkbox"]:checked~.checkmark:before {
            display: block;
        }

        .wrapper .form .inputfield .btn {
            width: 100%;
            padding: 8px 10px;
            font-size: 15px;
            border: 0px;
            background: #fec107;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            outline: none;
        }

        .wrapper .form .inputfield .btn:hover {
            background: #ffd658;
        }

        .wrapper .form .inputfield:last-child {
            margin-bottom: 0;
        }

        @media (max-width:420px) {
            .wrapper .form .inputfield {
                flex-direction: column;
                align-items: flex-start;
            }

            .wrapper .form .inputfield label {
                margin-bottom: 5px;
            }

            .wrapper .form .inputfield.terms {
                flex-direction: row;
            }
        }

        .oid {
            padding: 5px 5px 10px 0;
            color: #757575;
            text-align: center;
            margin-right: 10px;
            padding-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
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

    <div class="wrapper">

        <form method="post">
            <div class="title">
                Feedback Form
            </div>

            <div class="form">
                <div class="oid">
                    <span>Order ID : <?php echo $row['order_id']; ?> </span>
                </div>

                <div class="inputfield">
                    <label>Name</label>
                    <input type="text" class="input" value="<?php echo $row['cus_name']; ?>">
                </div>

                <div class="inputfield">
                    <label>Email Address</label>
                    <input type="text" class="input" value="<?php echo $row['cus_email']; ?>">
                </div>

                <div class="inputfield">
                    <label for="fback">Feedback</label>
                    <textarea class="textarea" name="fb" id="fback"></textarea>
                </div>

                <div class="inputfield">
                    <input type="submit" name="subbtn" value="Submit" class="btn">
                </div>
            </div>
        </form>
    </div>


</body>

</html>


<?php
if (isset($_POST['subbtn'])) {
    $feedback = $_POST['fb'];
    mysqli_query($connect, "UPDATE order_list SET order_feedback = '$feedback' WHERE order_id = '$oid'");

?> <script>
        alert("Thanks for feedback ! Enjoy.");
    </script><?php
                header("refresh:0.2, url=dashboard.php");
            }
            ob_end_flush();
            mysqli_close($connect);
                ?>