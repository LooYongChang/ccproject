<?php
include("connection.php");
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
    <title>Edit category</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>


    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');

        * {
            font-family: 'Hubballi', cursive;
            margin: auto;
            padding: auto;
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

        .container {
            margin-top:30px;
            max-width: 700px;
            width: 50%;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 5px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
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
        form .user-details .input-box {
            margin-bottom: 15px;
            width: 70%;
        }

        textarea,
        form .input-box span.details {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
        }

        textarea,
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

        textarea:focus,
        textarea:valid,
        .user-details .input-box input:focus,
        .user-details .input-box input:valid {
            border-color: #9b59b6;
        }

        form .ptype-details .ptype-title {
            font-size: 20px;
            font-weight: 500;
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

        #currentCat
        {
            text-align:center;
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
                <a href="Manageproduct.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
                    <a href="adminHome.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    <a href="adminManageUser.php"><i class="fa-solid fa-users"></i></i> Manage User</a>
                    <a href="Manageproduct.php"><i class="fa-solid fa-list-check"></i> Manage product</a>
                    <a href="adminOrder.php"><i class="fa-solid fa-clipboard"></i> Manage Order</a>
                    <a href="adminReport.php"><i class="fa-solid fa-file-invoice"></i> Reports</a>
                    <div class="animation start-product"></div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="title">Edit Category</div>
        <div class="content">
            <form method="post">
                <div class="user-details">

                <?php
                $catid = $_GET['catId'];
                $sql = "SELECT * FROM categories WHERE cat_id = '$catid'";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <p id="currentCat"><strong>Current category : <?php echo $row['cat_title'];?></strong></p><br>

                    <div class="input-box">
                        <span class="details">Category Name</span>
                        <input type="text" name="catname" value="<?php echo $row['cat_title'];?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Category Icon (code)</span>
                        <input type="text" name="caticon" value="<?php echo $row['cat_icon'];?>" required>
                    </div>
                    <?php
                    }
                    }
                    ?>

                <div class="button">
                    <input type="submit" name="udpCat" value="Update Category">
                </div>
            </form>
        </div>
    </div>

    <div class="backbtn">
        <a href="Manageproduct.php"><input type="submit" name="addCat" value="Back"></a>
    </div>


</body>

</html>
<?php
if(isset($_GET['logout']))
{
    SESSION_DESTROY();
    ?> <script>alert("Successfully Log Out");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}

if (isset($_POST['udpCat'])) {
    $catname = $_POST['catname'];
    $caticon = $_POST['caticon'];

    $delLog = "has UPDATED a category (" . $catname . ") from category database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");

    /* update to remove */
    mysqli_query($connect, "UPDATE categories SET cat_title = '$catname', cat_icon='$caticon' WHERE cat_id = '$catid'");
    mysqli_query($connect, "INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$delLog','$date.' '.$time')");

    ?>
        <script>alert("Category updated Successfully!");</script>
    <?php

    header("refresh:0.2, url=Manageproduct.php");
}



mysqli_close($connect);
ob_end_flush();
?>