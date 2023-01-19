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
    <title>Admin Add Product Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');
        *
        {
            font-family:'Hubballi', cursive;
            margin:auto;
            padding:auto;
        }

        footer
        {
            margin-top:5px;
            width:100%;
            height:23px;
            background-color:#008B8B;
            z-index:999;
            position:sticky;
            bottom:-100;
            margin-top:20px;
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

  
    <div class="container">
        <div class="title">Add Product</div>
        <div class="content">
            <form method="post" action="#">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Product Name</span>
                        <input type="text" name="proname" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Image name</span>
                        <input type="text" name="imgname" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Size</span>
                        <input type="text" name="psize" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Describtion</span>
                        <textarea name="prodis" style="width:400px; height:100px; padding-top:8px;"></textarea>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Price (RM)</span>
                        <input type="number"  name="proprice"  required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Stock</span>
                        <input type="number" name="prostock" placeholder="QTY" style="width:70px" min="0" required>
                    </div>
                    
                    
                </div>


                <div class="ptype-details">
                <span class="ptype-title">Product type</span><br>
                <select name="protype" id="">
                    <?php
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($connect, $sql);
                    if(mysqli_num_rows($result)>0)
                    {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['cat_id'] ?>" selected>
                            <?php echo $row['cat_title'] ?>
                            </option>
                        <?php
                    }
                    }
                    ?>
                    </select>
                </div>

                <div class="button">
                    <input type="submit" name="addbtn" value="Add Product">
                </div>
            </form>
        </div>
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

if(isset($_POST['addbtn']))
{
    $pname = $_POST['proname'];
    $pstock = $_POST['prostock'];
    $pimg = $_POST['imgname'];
    $ptyp = $_POST['protype'];
    $pprice = $_POST['proprice'];
    $pdis = $_POST['prodis'];
    $psize = $_POST['psize'];
    

    mysqli_query($connect,"INSERT INTO product (product_name, product_stock, product_image, product_type, product_price, product_discript, product_sold, product_Is_delete, product_size) VALUES ('$pname','$pstock','$pimg','$ptyp',' $pprice','$pdis','0','0','$psize')");
                    
    $addLog = "has ADD a product (".$pname.") into product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$addLog','$date.' '.$time')");
   
   ?> 
        <script>alert("Successfully Add!");</script>
    <?php

    header("refresh:0.1, url=Manageproduct.php");
}

mysqli_close($connect);
ob_end_flush();
?>