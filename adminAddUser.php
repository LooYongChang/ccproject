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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');
        *
        {
            font-family:'Hubballi', cursive;
            
        }

        footer {
            margin-top: 30px;
            width: 100%;
            height: 23px;
            background-color: #008B8B;
        }

        .container {
            margin-top:30px;
            max-width: 700px;
            width: 50%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
            margin-bottom:20px;
        }

        .container .title {
            font-size: 25px;
            font-weight: 500;
            position: relative;
        }

        .container .title::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            border-radius: 5px;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        .content form .user-details {
            display: block;
            justify-content: space-between;
            margin: 20px 0 12px 0;
        }

        textarea,
        select,
        form .user-details .input-box {
            margin-bottom: 15px;
            width: 70%;
        }

        textarea,
        select,
        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        textarea,
        select,
        .user-details .input-box input {
            height: 45px;
            width: 100%;
            outline: none;
            font-size: 16px;
            border-radius: 5px;
            padding-left: 15px;
            border: 1px solid #ccc;
            border-bottom-width: 2px;
            transition: all 0.3s ease;
        }

        textarea,:focus,
        textarea,:valid,
        select,:focus,
        select,:valid,
        .user-details .input-box input:focus,
        .user-details .input-box input:valid {
            border-color: #9b59b6;
        }

        form .ptype-details .ptype-title {
            font-size: 20px;
            font-weight: 500;
        }

        form .category {
            display: flex;
            width: 80%;
            margin: 14px 0;
            justify-content: space-between;
        }

        form .category label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        form .category label .dot {
            height: 18px;
            width: 18px;
            border-radius: 50%;
            margin-right: 10px;
            background: #d9d9d9;
            border: 5px solid transparent;
            transition: all 0.3s ease;
        }

        #dot-1:checked~.category label .one,
        #dot-2:checked~.category label .two,
        #dot-3:checked~.category label .three,
        #dot-4:checked~.category label .four {
            background: #9b59b6;
            border-color: #d9d9d9;
        }

        form input[type="radio"] {
            display: none;
        }

        form .button {
            height: 45px;
            margin: 35px 0
        }

        form .button input {
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

        form .button input:hover {
            /* transform: scale(0.99); */
            background: linear-gradient(-135deg, #71b7e6, #9b59b6);
        }

        .errormes
        {
            margin:5px 0 80px 100px;
        }

        .input-box #cn 
        {
            margin-top:20px;
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
                    <a href="adminHome.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
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

    <!-- add admin -->
    <?php 
       if(isset($_GET['aadd']))
       {
    ?>

        <div class="container">
            <div class="title">Add Admin</div>
            <div class="content">
                <form method="post" action="#">
                    <div class="user-details">

                        <div class="input-box">
                            <span class="details">Admin Name</span>
                            <input type="text" name="aname" pattern="[a-zA-Z\s]+" title="Please enter alphabet only."  required>
                        </div>

                        <div class="input-box">
                            <span class="details">Admin Image</span>
                            <input type="text" name="aimg" required>
                        </div>

                        <div class="ptype-details">
                        <input type="radio" name="agender" id="dot-1" value="Male"  checked>
                        <input type="radio" name="agender" id="dot-2" value="Female">

                        
                        <span class="ptype-title">Gender</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="ptype">Male</span>
                            </label>

                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="ptype">Female</span>
                            </label>

                        </div>
                    </div>

                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" pattern=".+\.com" name="aemail">
                        </div>

                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" id="password" name="apass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Comfirm Password</span>
                            <input type="password" id="confirm_password" name="aconpass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                        <p><span id='message' class="errormes"></span></p>

                        <script>
                            $('#password, #confirm_password').on('keyup', function () {
                                if ($('#password').val() == $('#confirm_password').val()) {
                                    $('#message').html('Matched').css('color', 'green');
                                } else 
                                    $('#message').html('Both Password and Confirm Password Not Matching').css('color', 'red');
                                });
                        </script>

                        <div class="input-box">
                            <span class="details" id="cn">Contact No</span>
                            <input type="text"  name="acontact" pattern="[0-9]{10}" maxlength="10" required>
                        </div>

                      

                        <div class="input-box">
                        <label for="position"><span class="details">position</span></label>
                            <select id="position" name="aposition">
                            <option id="position" value="Main Admin">Main Admin</option>
                            <option id="position" value="Admin" selected>Admin</option>
                            </select>
                        </div>
                     

                        <div class="input-box">
                            <span class="details">Home Address</span>
                            <textarea  name="aaddress" placeholder="Enter Home address"  style="width:400px; height:100px; padding-top:8px;"></textarea>
                        </div>

                        <div class="input-box">
                            <span class="details">Postcode</span>
                            <input type="text"  name="apostcode" pattern="[0-9]{5}" maxlength="5" required>
                        </div>

                        <div class="input-box">
                            <span class="details">State</span>
                            <select name="astate" required>
                        <option value="">State</option>
                              <option value="Johor">Johor</option>
							  <option value="Kedah">Kedah</option>
							  <option value="Kelantan">Kelantan</option>
							  <option value="Kuala Lumpur">Kuala Lumpur</option>
							  <option value="Labuan">Labuan</option>
							  <option value="Melaka">Melaka</option>
							  <option value="Negeri Sembilan">Negeri Sembilan</option>
							  <option value="Pahang">Pahang</option>
							  <option value="Penang">Penang</option>
							  <option value="Perak">Perak</option>
							  <option value="Perlis">Perlis</option>
							  <option value="Putrajaya">Putrajaya</option>
							  <option value="Sabah">Sabah</option>
							  <option value="Sarawak">Sarawak</option>
							  <option value="Selangor">Selangor</option>
							  <option value="Terengganu">Terengganu</option>
                    </select>
                        </div>
                        
                    
                    <div class="button">
                        <input type="submit" name="aaddbtn" value="Add Admin">
                    </div>
                </form>
            </div>
            </div>

            <div class="backbtn">
                <a href="adminManageUser.php"><input type="submit" name="addCat" value="Back"></a>
            </div>
        <?php
       }
        
        ?>

        <!-- add customer -->

        <?php 
       if(isset($_GET['cadd']))
       {
    ?>

        <div class="container">
            <div class="title">Add Customer</div>
            <div class="content">
                <form method="post" action="#">
                    <div class="user-details">

                        <div class="input-box">
                            <span class="details">Customer Name</span>
                            <input type="text" name="cname"  pattern="[a-zA-Z\s]+" title="Please enter alphabet only." required>
                        </div>

                        <div class="ptype-details">
                        <input type="radio" name="cgender" id="dot-1" value="Male"  checked>
                        <input type="radio" name="cgender" id="dot-2" value="Female">

                        
                        <span class="ptype-title">Gender</span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="ptype">Male</span>
                            </label>

                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span class="ptype">Female</span>
                            </label>

                        </div>
                    </div>

                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" pattern=".+\.com" name="cemail">
                        </div>

                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" id="password" name="cpass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Comfirm Password</span>
                            <input type="password" id="confirm_password" name="conpass"  pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                        <p><span id='message' class="errormes"></span></p>

                        <script>
                            $('#password, #confirm_password').on('keyup', function () {
                                if ($('#password').val() == $('#confirm_password').val()) {
                                    $('#message').html('Matched').css('color', 'green');
                                } else 
                                    $('#message').html('Both Password and Confirm Password Not Matching').css('color', 'red');
                                });
                        </script>

                        <div class="input-box">
                            <span class="details" id="cn">Contact No</span>
                            <input type="text"  name="ccontact" pattern="[0-9]{10}" maxlength="10" required>
                        </div>
                     
                        <div class="input-box">
                            <span class="details">Home Address</span>
                            <textarea  name="caddress" placeholder="Enter Home address"  style="width:400px; height:100px; padding-top:8px;"></textarea>
                        </div>

                        <div class="input-box">
                            <span class="details">Postcode</span>
                            <input type="text"  name="cpostcode" pattern="[0-9]{5}" maxlength="5" required>
                        </div>

                        <div class="input-box">
                            <span class="details">State</span>
                            <select name="cstate" required>
                        <option value="">State</option>
                              <option value="Johor">Johor</option>
							  <option value="Kedah">Kedah</option>
							  <option value="Kelantan">Kelantan</option>
							  <option value="Kuala Lumpur">Kuala Lumpur</option>
							  <option value="Labuan">Labuan</option>
							  <option value="Melaka">Melaka</option>
							  <option value="Negeri Sembilan">Negeri Sembilan</option>
							  <option value="Pahang">Pahang</option>
							  <option value="Penang">Penang</option>
							  <option value="Perak">Perak</option>
							  <option value="Perlis">Perlis</option>
							  <option value="Putrajaya">Putrajaya</option>
							  <option value="Sabah">Sabah</option>
							  <option value="Sarawak">Sarawak</option>
							  <option value="Selangor">Selangor</option>
							  <option value="Terengganu">Terengganu</option>
                    </select>
                        </div>
                        
                    
                    <div class="button">
                        <input type="submit" name="caddbtn" value="Add Customer">
                    </div>
                </form>
            </div>
            </div>
            <div class="backbtn">
                <a href="adminManageUser.php"><input type="submit" name="addCat" value="Back"></a>
            </div>
            

            
        <?php
        }
        
        ?>


</body>

</html>
<?php
if(isset($_GET['logout']))
{
    SESSION_DESTROY();
    ?> <script>alert("Successfully Log Out");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}

if(isset($_POST['aaddbtn']))
{
    $caemail = $_POST['aemail'];
    $caresult=mysqli_query($connect,"SELECT * FROM admin WHERE admin_email = '$caemail'");
    $checkNoEmail=mysqli_num_rows($caresult);

    if($checkNoEmail == 0)
    {

        if($_POST["apass"] == $_POST["aconpass"])
        {
        $adname= $_POST['aname'];
        $aimg= $_POST['aimg'];
        $agender= $_POST['agender'];
        $apass= $_POST['apass'];
        $aemail= $_POST['aemail'];
        $acontact= $_POST['acontact'];
        $aaddress= $_POST['aaddress'];
        $apostcode= $_POST['apostcode'];
        $aposition=$_POST['aposition'];
        $astate=$_POST['astate'];

        mysqli_query($connect,"INSERT INTO admin (admin_image,admin_name,admin_gender,admin_email,admin_pass,admin_contact,admin_address,admin_postcode,admin_position,admin_state) VALUES ('$aimg','$adname','$agender','$aemail','$apass','$acontact','$aaddress','$apostcode',' $aposition','$astate')");
        
        $aedtLog = "has Add an Admin (".$adname.") into Admin database.";
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$aedtLog','$date.' '.$time')");
        ?>
            <script>alert('Successfully Added!');</script>
        <?php

        header("refresh:0.2, url=adminManageUser.php");
        }
        else
        {
            ?><script>
                alert("Confirm password not match!");
            </script><?php
        
        }
    }
    else
    {
        ?> 
            <script> alert("Email had already taken.");</script>
        <?php
    }
}

if(isset($_POST['caddbtn']))
{
    $ccemail = $_POST['cemail'];
    $ccresult=mysqli_query($connect,"SELECT * FROM customer WHERE Cus_Email = '$ccemail'");
    $checkNoEmail=mysqli_num_rows($ccresult);

    if($checkNoEmail == 0)
    {
        if($_POST["cpass"] == $_POST["conpass"])
        {
        $cdname= $_POST['cname'];

        $cgender= $_POST['cgender'];
        $cpass= $_POST['cpass'];
        $cemail= $_POST['cemail'];
        $ccontact= $_POST['ccontact'];
        $caddress= $_POST['caddress'];
        $cpostcode= $_POST['cpostcode'];
        $cposition=$_POST['cposition'];
        $cstate=$_POST['cstate'];

        mysqli_query($connect,"INSERT INTO customer (Cus_Name,Cus_Gender,Cus_Email,cus_pass,Cus_Contact,Cus_Address,cus_postcode,cus_state) VALUES ('$cdname','$cgender','$cemail','$cpass','$ccontact','$caddress','$cpostcode','$cstate')");
        
        $aedtLog = "has Add a customer (".$cdname.") into customer database.";
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$aedtLog','$date.' '.$time')");
        ?>
            <script>alert('Successfully Added!');</script>
        <?php

        header("refresh:0.2, url=adminManageUser.php");
        }
        else
        {
            ?><script>
                alert("Confirm password not match!");
            </script><?php
        
        }
    }
    else
    {
        ?> 
            <script> alert("Email had already taken.");</script>
        <?php
    }
}

ob_end_flush();
mysqli_close($connect);
?>