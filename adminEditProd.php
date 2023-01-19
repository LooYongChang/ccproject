<?php
include("connection.php");
ob_start();
SESSION_START();

    $ty1="";
    $ty2="";
    $ty3="";
    $ty4="";

/* for radio checking follow product type*/ 
if(isset($_GET['edt']))
{

    $ptype = $_GET['ptype'];
    $pid = $_GET['pid'];

    
}


?>
<html>

<head>
    <title>Admin Home Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    
    <script>
        function confirmation() {
            var option;
            option = confirm("Are you sure to update?")
            return option;
        }
    </script>
    <style>
        @import url("adminNav.css");
        @import url('https://fonts.googleapis.com/css2?family=EB+Garamond:ital@0;1&family=Hubballi&display=swap');

        * {
            font-family: 'Hubballi', cursive;
            margin: auto;
            padding: auto;
        }

        footer {
            width: 100%;
            height: 23px;
            background-color: #008B8B;
            z-index: 999;
            position: sticky;
            bottom: 0;
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

        .dot-i:checked~.category label 
        {
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

    <?php 
        $eresult = mysqli_query($connect,"SELECT * FROM product WHERE product_id = '$pid'");
        if(mysqli_num_rows($eresult)>0)
        {
            $erow = mysqli_fetch_assoc($eresult);
        }
    ?>

    <div class="container">
        <div class="title">Product Editing</div>
        <div class="content">
            <form method="post" action="#">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Product Name</span>
                        <input type="text" name="proname" value="<?php echo $erow['product_name']; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Image name</span>
                        <input type="text" name="imgname" value="<?php echo $erow['product_image']; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Size</span>
                        <input type="text" name="prosize" value="<?php echo $erow['product_size']; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Description</span>
                        <textarea name="prodis" placeholder="<?php echo $erow['product_discript']; ?>"  style="width:400px; height:100px; padding-top:8px;"></textarea>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Price (RM)</span>
                        <input type="number"  name="proprice" value="<?php echo $erow['product_price']; ?>" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Product Stock</span>
                        <input type="number" name="prostock" placeholder="QTY" style="width:70px" value="<?php echo $erow['product_stock']; ?>" required>
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
                    if($ptype == $row['cat_title'])  
                    {
                        ?>
                        <option value="<?php echo $row['cat_id'] ?>" selected>
                            <?php echo $row['cat_title'] ?>
                            </option>
                        <?php
                    }
                    else
                    {
                    ?>         
                                      
                            <option value="<?php echo $row['cat_id'] ?>">
                            <?php echo $row['cat_title'] ?>
                            </option>
                    <?php 
                    }
                    }
                    }
                    ?>
                    </select>
                </div>

                <div class="button">
                    <input type="submit" name="edtbtn" onclick="return confirmation();" value="Update Product Info">
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

if(isset($_POST['edtbtn']))
{
    $pname = $_POST['proname'];
    $pstock = $_POST['prostock'];
    $pimg = $_POST['imgname'];
    $ptyp = $_POST['protype'];
    $pprice = $_POST['proprice'];
    $psize = $_POST['prosize'];

    if(!empty($_POST['prodis']))
    {
        $pdis = $_POST['prodis'];
    }
    else
    {
        $pdis = $erow['product_discript'];
    }

    mysqli_query($connect,"UPDATE product SET product_name='$pname', product_stock='$pstock', product_image='$pimg', product_discript='$pdis', product_type='$ptyp',product_price='$pprice',product_size='$psize' WHERE product_id = '$pid'");
    
    $edtLog = "has EDIT a product (".$pname.") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$edtLog','$date.' '.$time')");
   
   ?> 
        <script>alert("Successfully UPDATED!");</script>
    <?php

    header("refresh:0.1, url=Manageproduct.php");
}




mysqli_close($connect);
ob_end_flush();
?>