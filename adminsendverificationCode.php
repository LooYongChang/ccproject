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
            background-image: url(image/login-regis-image/login3.png);
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
            <input type="email" name="aemail" placeholder="Enter email">
            <p><span id="error"></span></p>
            <button class="smtbtn" name="smtbtn">Sent</button>
        </form>
    </fieldset>
</body>

</html>



<?php

if (isset($_POST['smtbtn'])) {
    $adm_email = $_POST['aemail'];
    $con_email = "";
    $get_email = "";
    $adm_name = "";
    $adm_id = "";
    $veriCode = rand(10000, 99999);

    if (!empty($adm_email)) {
        $result = mysqli_query($connect, "SELECT * from admin");
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["admin_email"] == $adm_email) {
                $con_email = true;
                $get_email = $row['admin_email'];
                $adm_name = $row['admin_name'];
                $adm_id = $row['admin_id'];
                $_SESSION['v_name'] = $adm_name;
                $_SESSION['v_email'] = $row['admin_email'];
                $_SESSION['v_id'] = $row['admin_id'];
?>
                <script>
                    document.getElementById("error").innerHTML = "";
                </script>
            <?php
            } else {
            ?>
                <script>
                    document.getElementById("error").innerHTML = "Email did not registered!";
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
        $message = "Hello $adm_name \n\n This is your Verification code is : $veriCode";
        $headers = "From: aiture1232022@gmail.com\r\nReply-To: .$get_email.";
        $mail_sent = mail($to, $subject, $message, $headers);

        mysqli_query($connect, "UPDATE admin SET admin_vericode = '$veriCode' WHERE admin_id = '$adm_id'");
        ?><script>alert("We're sent a verification code to your email.");</script><?php
        header("refresh:0.2, url=admincheckVerifiCode.php");
    }
}
mysqli_close($connect);
ob_end_flush();
?>