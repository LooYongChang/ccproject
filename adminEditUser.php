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
    /* for check current state*/
    $s1 = ""; $s2 = ""; $s3 = ""; $s4 = ""; $s5 = ""; $s6 = ""; $s7 = ""; $s8 = ""; $s9 = ""; $s10 = ""; $s11 = ""; $s12 = ""; $s13 = ""; $s14 = "";

    /* only main admin can edit position */
    $posi=0;
    if(isset($_GET['main']))
    {
        $posi = 1;
    }

    /* for radio checking follow gender*/ 
    $ty1="";
    $ty2="";



    /* for radio checking follow position*/ 
    $p1="";
    $p2="";
    if(isset($_GET['aedt']))
    {
        $aid = $_GET['aid'];

        $eresult = mysqli_query($connect,"SELECT * FROM admin WHERE admin_id = '$aid'");
            if(mysqli_num_rows($eresult)>0)
            {
                $erow = mysqli_fetch_assoc($eresult);
            }

        $gender =  $erow['admin_gender'];   
        $position =  $erow['admin_position']; 

        if($gender=='Male')
        {
            $ty1 = "checked";
        }
        else if($gender=='Female')
        {
            $ty2 = "checked";
        }

        if($position=='Main Admin')
        {
            $p1 = "selected";
        }
        else if($position=='Admin')
        {
            $p2 = "selected";
        }
    }

    if(isset($_GET['cedt']))
    {
        $cid = $_GET['cid'];

        $eresult = mysqli_query($connect,"SELECT * FROM customer WHERE Cus_ID = '$cid'");
            if(mysqli_num_rows($eresult)>0)
            {
                $erow = mysqli_fetch_assoc($eresult);
            }

        $gender =  $erow['Cus_Gender'];   

        if($gender=='Male')
        {
            $ty1 = "checked";
        }
        else if($gender=='Female')
        {
            $ty2 = "checked";
        }

    }
    //check for state admin
    $aid = $_GET['aid'];
    $result = mysqli_query($connect,"SELECT * FROM admin WHERE admin_id = '$aid'");
    if (mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_assoc($result);

        $check_state = $row['admin_state'];
        if($check_state == 'Johor')
        {
            $s1 = 'selected';
        }
        else if($check_state == 'Kedah')
        {
            $s2 = 'selected';
        }
        else if($check_state == 'Kelantan')
        {
            $s3 = 'selected';
        }
        else if($check_state == 'Malacca')
        {
            $s4 = 'selected';
        }
        else if($check_state == 'Negeri Sembilan')
        {
            $s5 = 'selected';
        }
        else if($check_state == 'Pahang')
        {
            $s6 = 'selected';
        }
        else if($check_state == 'Penang')
        {
            $s7 = 'selected';
        }
        else if($check_state == 'Perak')
        {
            $s8 = 'selected';
        }
        else if($check_state == 'Perlis')
        {
            $s9 = 'selected';
        }
        else if($check_state == 'Sabah')
        {
            $s10 = 'selected';
        }
        else if($check_state == 'Sarawak')
        {
            $s11 = 'selected';
        }
        else if($check_state == 'Selangor')
        {
            $s12 = 'selected';
        }
        else if($check_state == 'Terengganu')
        {
            $s13 = 'selected';
        }
        else if($check_state == 'Kuala Lumpur')
        {
            $s14 = 'selected';
        }

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
                width: 100%;
                height: 23px;
                background-color: #008B8B;
                z-index: 999;
                margin-top: 20px;
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

        <!-- Admin edit -->

        <?php 
        if(isset($_GET['aedt']))
        {
            $aid = $_GET['aid'];
            $eresult = mysqli_query($connect,"SELECT * FROM admin WHERE admin_id = '$aid'");
            if(mysqli_num_rows($eresult)>0)
            {
                $erow = mysqli_fetch_assoc($eresult);
            }
        ?>

        <div class="container">
            <div class="title">Admin Editing</div>
            <div class="content">
                <form method="post" action="#">
                    <div class="user-details">

                        <input type="hidden" name="aid" value="<?php echo $erow['admin_id']; ?>">
                        <div class="input-box">
                            <span class="details">Admin Name</span>
                            <input type="text" name="aname" pattern="[a-zA-Z\s]+" title="Please enter alphabet only." value="<?php echo $erow['admin_name']; ?>" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Admin Image</span>
                            <input type="text" name="aimg" value="<?php echo $erow['admin_image']; ?>" required>
                        </div>

                        <div class="ptype-details">
                        <input type="radio" name="agender" id="dot-1" value="Male" <?php echo $ty1 ?>>
                        <input type="radio" name="agender" id="dot-2" value="Female" <?php echo $ty2 ?>>>

                        
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
                            <input type="email" name="aemail" pattern=".+\.com" value="<?php echo $erow['admin_email']; ?>">
                        </div>

                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" id="password" name="apass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $erow['admin_pass']; ?>" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Comfirm Password</span>
                            <input type="password"  id="confirm_password" name="apass" pattern="(?=.[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $erow['admin_pass']; ?>" required>
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
                            <input type="text"  name="acontact" value="<?php echo $erow['admin_contact']; ?>" pattern="[0-9]{10}" required>
                        </div>

                        <?php 
                            if($posi==1)
                            {
                        ?>
                        <div class="input-box">
                        <label for="position"><span class="details">position</span></label>
                            <select id="position" name="aposition">
                            <option id="position" value="Main Admin" <?php echo $p1; ?>>Main Admin</option>
                            <option id="position" value="Admin" <?php echo $p2; ?>>Admin</option>
                            </select>
                        </div>
                        <?php 
                            }
                        ?>

                        <div class="input-box">
                            <span class="details">Home Address</span>
                            <textarea  name="aaddress" placeholder="<?php echo $erow['admin_address']; ?>"  style="width:400px; height:100px; padding-top:8px;"></textarea>
                        </div>

                        <div class="input-box">
                            <span class="details">Postcode</span>
                            <input type="text"  name="apostcode" maxlength="5" value="<?php echo $erow['admin_postcode'];?>" pattern="[0-9]{5}" required>
                        </div>
                        
                        <div class="input-box">
                        <select name="state">
                            <option value="Johor" <?php echo $s1 ?>>Johor</option>
                            <option value="Kedah" <?php echo $s2 ?>>Kedah</option>
                            <option value="Kelantan" <?php echo $s3 ?>>Kelantan</option>
                            <option value="Malacca" <?php echo $s4 ?>>Malacca</option>
                            <option value="Negeri Sembilan" <?php echo $s5 ?>>Negeri Sembilan</option>
                            <option value="Pahang" <?php echo $s6 ?>>Pahang</option>
                            <option value="Penang" <?php echo $s7 ?>>Penang</option>
                            <option value="Perak" <?php echo $s8 ?>>Perak</option>
                            <option value="Perlis" <?php echo $s9 ?>>Perlis</option>
                            <option value="Sabah" <?php echo $s10 ?>>Sabah</option>
                            <option value="Sarawak" <?php echo $s11 ?>>Sarawak</option>
                            <option value="Selangor" <?php echo $s12 ?>>Selangor</option>
                            <option value="Terengganu" <?php echo $s13 ?>>Terengganu</option>
                            <option value="Kuala Lumpur" <?php echo $s14 ?>>Kuala Lumpur</option>
                        </select>
                        </div>
                    
                    <div class="button">
                        <input type="submit" name="aedtbtn" value="Update Admin Info">
                    </div>
                </form>
            </div>
            </div>
        <?php
        }   
        ?>

        <!-- Customer edit -->

        <?php
        if(isset($_GET['cedt']))
        {
            $cid = $_GET['cid'];
            $result = mysqli_query($connect,"SELECT * FROM customer WHERE Cus_ID = '$cid'");
            if(mysqli_num_rows($result)>0)
            {
                $erow = mysqli_fetch_assoc($result);
            }
        ?>

        <div class="container">
            <div class="title">Customer Editing</div>
            <div class="content">
                <form method="post" action="#">
                    <div class="user-details">

                        <input type="hidden" name="cid" value="<?php echo $row['Cus_ID']; ?>" required>
                        <div class="input-box">
                            <span class="details">Customer Name</span>
                            <input type="text" name="cname" pattern="[a-zA-Z\s]+" title="Please enter alphabet only." value="<?php echo $erow['Cus_Name']; ?>" required>
                        </div>

                        <div class="ptype-details">
                        <input type="radio" name="cgender" id="dot-1" value="Male" <?php echo $ty1 ?>>
                        <input type="radio" name="cgender" id="dot-2" value="Female" <?php echo $ty2 ?>>
                        
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
                            <input type="email" name="cemail" pattern=".+\.com" value="<?php echo $erow['Cus_Email']; ?>" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password"  id="password" name="cpass" value="<?php echo $erow['cus_pass']; ?>" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Comfirm Password</span>
                            <input type="password"  id="confirm_password" name="cpass" value="<?php echo $erow['cus_pass']; ?>" required>
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
                            <input type="text"  name="ccontact" value="<?php echo $erow['Cus_Contact']; ?>" pattern="[0-9]{10}" required>
                        </div>

                        <div class="input-box">
                            <span class="details">Home Address</span>
                            <textarea  name="caddress" placeholder="<?php echo $erow['Cus_Address']; ?>"  style="width:400px; height:100px; padding-top:8px;"></textarea>
                        </div>

                        <div class="input-box">
                            <span class="details">Postcode</span>
                            <input type="text" name="cpostcode" value="<?php echo $erow['cus_postcode']; ?>" pattern="[0-9]{5}" required>
                        </div>
                        
                    <div class="button">
                        <input type="submit" name="cedtbtn" value="Update Customer Info">
                    </div>
                </form>
            </div>
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

    /* Admin edit */
    if(isset($_POST['aedtbtn']))
    {
        $caemail = $_POST['aemail'];
        $caresult=mysqli_query($connect,"SELECT * FROM admin WHERE admin_email = '$caemail'");
        $checkNoEmail=mysqli_num_rows($caresult);

        $checkRepeatEmail = 0;

        if($caemail== $_SESSION['admin_email'])
        {
            $checkRepeatEmail = 1;
        }


    if($checkNoEmail == 0 || $checkRepeatEmail==1)
    {
        $aid = $_POST['aid'];
        $adname= $_POST['aname'];
        $aimg= $_POST['aimg'];
        $agender= $_POST['agender'];
        $apass= $_POST['apass'];
        $aemail= $_POST['aemail'];
        $acontact= $_POST['acontact'];
        $aaddress= $_POST['aaddress'];
        

        if(empty($aaddress))
        {
            $aaddress = $erow['admin_address'];
        }

        $apostcode= $_POST['apostcode'];

        if(isset($_POST['aposition']))
        {
            $aposition= $_POST['aposition'];
            $_SESSION['admin_position'] = $apostion;
        }
        $astate= $_POST['state'];

        mysqli_query($connect,"UPDATE admin SET admin_image='$aimg',admin_name='$adname',admin_gender='$agender',admin_email='$aemail',admin_pass='$apass',admin_contact='$acontact',admin_address='$aaddress',admin_postcode='$apostcode',admin_position='$aposition',admin_state='$astate' WHERE admin_id = '$aid'");
        
        $aedtLog = "has Edit an Admin (".$adname.") from Admin database.";
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$aedtLog','$date' '$time')");
        ?>
            <script>alert('Successfully update!');</script>
        <?php

        $_SESSION['admin_email'] = $aemail;
        $_SESSION["admin_name"] = $adname;

        header("refresh:0.2, url=adminManageUser.php");
    }
    else
    {
        ?> 
            <script> alert("Email had already taken.");</script>
        <?php
    }
    }

    /* customer edit */
    if(isset($_POST['cedtbtn']))
    {
        $ccemail = $_POST['cemail'];
        $ccresult=mysqli_query($connect,"SELECT * FROM customer WHERE Cus_Email = '$ccemail'");
        $checkNoEmail=mysqli_num_rows($ccresult);

    if($checkNoEmail == 0)
    {
            $cid = $_GET['cid'];
            $cname= $_POST['cname'];
            $cgender= $_POST['cgender'];
            $cpass= $_POST['cpass'];
            $cemail= $_POST['cemail'];
            $ccontact= $_POST['ccontact'];
            $caddress= $_POST['caddress'];

            if(empty($caddress))
            {
                $caddress = $erow['Cus_Address'];
            }

            $cpostcode= $_POST['cpostcode'];

            mysqli_query($connect,"UPDATE customer SET Cus_Name='$cname',Cus_Gender='$cgender',Cus_Email='$cemail',cus_pass='$cpass',Cus_Contact='$ccontact',Cus_Address='$caddress',cus_postcode='$cpostcode' WHERE Cus_ID = '$cid'");

            $cedtLog = "has Edit a Customer (".$cname.") from Customer database.";
            $date = date("Y-m-d");
            $time = date("h:i:sa");
            mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$cedtLog','$date.' '.$time')");
            ?>
                <script>alert('Successfully update!');</script>
            <?php

            header("refresh:0.2, url=adminManageUser.php");
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