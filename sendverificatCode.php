<?php
ob_start();
session_start();
include("connection.php");
?>
<html>

<head>
    <title>Forgot password</title>
    <style>
        @import url("navbar2.css");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            background-image: url(image/login-regis-image/userPage2.png);
            background-repeat: no-repeat;
            background-size: 1550px 750px;
        }


        p.p2 {
            text-align: left;
            color: grey;
            padding-top: 20px;
        }

        .fieldset {
            position: relative;
            background-color: #FFFFFF;
            max-width: 260px;
            margin: 200px auto 100px;
            padding: 10px 45px 30px 45px;
            text-align: center;
            box-shadow: 0 0 20px 0;
            border-radius: 10px;
            background-color: white;
        }

        input[type=submit] {
            background-color: #A87FEA;
            color: white;
            width: 70px;
            padding: 10px 10px 10px 10px;
            border: 0px;
            margin: 10px 0px 15px 4px;

        }

        input[type=email],
        input[type=password] {
            border-radius: 10px;
            background: #F2F2F2;
            width: 100%;
            border: 0;
            margin: 10px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type=password]:hover,
        input[type=text]:hover {
            background-color: #E6E6FA;
        }

        input[type=password]:focus,
        input[type=text]:focus {
            background-color: #E6E6FA;
        }

        fieldset a {
            color: #2691d9;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            margin-top: 10px;
        }

        fieldset a:hover {
            text-decoration: underline;
        }

        fieldset h4 {
            font-weight: 100;
        }

        #error {
            color: red;
            font-size: 15px;
        }

        .smtbtn {
            padding: 5px 10px 5px 10px;
            margin-top: 40px;

            background-color: lightgreen;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            transition: transform .2s;
        }
        
        form .smtbtn:hover {
            transform: scale(1.1);
        }

        form {
            text-align: center;
        }

        form h4 {
            font-size: 25px;

        }

        form h5 {
            font-size: 14px;
            color: grey;
        }

        form input[type='email'] {
            margin-top: 20px;
            width: 100%;
        }
    </style>
   <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
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
                    <div class="animation start-account"></div>
                </nav>
            </div>
        </div>
    </div>


    <fieldset style="width:400px;
					padding:70px;
					margin-top:100px;
                    margin-left:450px;
					border:1px solid #DDD;
					border-radius:30px;
					background-color:white;
					box-shadow:0 0 20px 0;">
        <form method="post" alt="">
            <h4>Enter your email</h4>
            <h5>We've send a verification code to you</h5>
            <input type="email" name="femail" placeholder="Enter email">
            <p><span id="error"></span></p>
            <button class="smtbtn" name="smtbtn">Sent</button>
        </form>
    </fieldset>
</body>

</html>



<?php

if (isset($_POST['smtbtn'])) {
    $cus_email = $_POST['femail'];
    $con_email = "";
    $get_email = "";
    $cus_name = "";
    $cus_id = "";
    $veriCode = rand(10000, 99999);

    if (!empty($cus_email)) {
        $result = mysqli_query($connect, "SELECT * from customer");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["Cus_Email"] == $cus_email) {
                $con_email = true;
                $get_email = $row['Cus_Email'];
                $cus_name = $row['Cus_Name'];
                $cus_id = $row['Cus_ID'];
                $_SESSION['v_name'] = $cus_name;
                $_SESSION['v_email'] = $row['Cus_Email'];
                $_SESSION['v_id'] = $row['Cus_ID'];
?>
                <script>
                    document.getElementById("error").innerHTML = "";
                </script>
            <?php
            } else {
            ?>
                <script>
                    document.getElementById("error").innerHTML = "Email did not exist!";
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            document.getElementById("error").innerHTML = "Cannot be empty!";
        </script>
<?php
    }



    if ($con_email == true) {
        $to = $get_email;
        $subject = "Password";
        $message = "Hello $cus_name \n\n This is your Verification code is : $veriCode";
        $headers = "From: aiture1232022@gmail.com\r\nReply-To: .$get_email.";
        $mail_sent = mail($to, $subject, $message, $headers);

        mysqli_query($connect, "UPDATE customer SET cus_vericode = '$veriCode' WHERE Cus_ID = '$cus_id'");
        ?><script>alert("We're sent a verification code to your email.");</script><?php
        header("refresh:0.2, url=checkVerifiCode.php");
    }
}
mysqli_close($connect);
ob_end_flush();
?>