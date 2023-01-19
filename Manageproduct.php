<?php
include("connection.php");
ob_start();
SESSION_START();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
    <title>Admin Product Management Page</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        /* confirm delete */
        function confirmationrev() {
            var option;
            option = confirm("Are you sure to REMOVE this product?")
            return option;
        }

        /* confirm restore */
        function confirmationres() {
            var option;
            option = confirm("Are you sure to RESTORE this product?")
            return option;
        }

        /* confirm delete */
        function confirmationdel() {
            var option;
            option = confirm("Are you sure to DELETE this product?")
            return option;
        }

        var srch = "";
        var opt = "";


        $(document).ready(function() {

            /* view product */
            jQuery('#view').change(function() {
                location.reload("Manageproduct.php");
            })

            /* restore product */
            var rstr=""; 
            jQuery('#restore').change(function() {
                $.ajax({
                    url: "Ajaxadminproduct.php",
                    method: "POST",
                    data: {
                        restore: rstr,
                    },
                    success: function(data) {
                        $('.all-info').html(data);
                    }
                })
            })

            jQuery('#editCat').change(function() {
                var ecat=""; 
                $.ajax({
                    url: "Ajaxadminproduct.php",
                    method: "POST",
                    data: {
                        editCat: ecat,
                    },
                    success: function(data) {
                        $('.all-info').html(data);
                    }
                })
            })

            /* search option */
            jQuery('#itemTypes').change(function() {
                opt = $(this).find(":selected").val();
                $.ajax({
                    url: "Ajaxadminproduct.php",
                    method: "POST",
                    data: {
                        option: opt,
                        search: srch
                    },
                    success: function(data) {
                        $('#infot').html(data);
                    }
                })
                document.querySelector('#sbox').value=""; 
            })

            /* search box */
            $('#sbox').keyup(function() {
                srch = $('#sbox').val();
                $.ajax({
                    url: "Ajaxadminproduct.php",
                    method: "POST",
                    data: {
                        option: opt,
                        search: srch
                        
                    },
                    success: function(data) {
                        $('#infot').html(data);
                    }
                })
            })
        })

        
    </script>

    <script type="text/javascript">
        function confirmation() {
            var option;
            option = confirm("Do you want to delete this category?")
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

        table th img
        {
            height:50px;
            width:60px;
        }


        footer {
            margin-top: 5px;
            width: 100%;
            height: 23px;
            background-color: #008B8B;
            z-index: 999;
            position: sticky;
            bottom: -100;
            margin-top: 20px;
        }

        .prodoption {
            margin: auto;
            width: 100%;
            text-align: center;
        }

        input[type="radio"] {
            -webkit-appearance: none;
        }



        .search {
            height: 13vh;
            width: 800px;
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

        .infotable {
            margin-top: 10px;
            width: 98%;
        }

        .content-table {
            border-collapse: collapse;
            font-size: 1.2em;
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
            font-size:14px;
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

        .search-box {
            margin-top: 60px;
            padding-left: 390px;
            justify-content: center;
        }

        .search-box select {
            font-size: 18px;
            margin-left: 20px;
            padding: 5px 15px 5px 15px;
        }

        .no-result th{
            background-color: pink;
            color: red;
            font-size: 20px;
        }


        .infotable tbody a {
            text-decoration: none;
            color: black;
            font-size: 22px;

        }

        .infotable tbody a .fa {
            color: red;
        }

        #catadd a {
            text-decoration: none;
            color: black;
            font-size: 22px;

        }

        #catadd a .fa {
            color: red;
        }

        #restore-table
        {
            margin-top:100px;
        }


    </style>
</head>

<body>


    <section class="prodoption">

        <div class="searchcontainer">
            <div class="search">
                <input type="radio" name="ptype" id="view" value="All" checked>
                <label for="view">
                    <i class="fa-solid fa-pen-to-square fa"></i>
                    <span>View/Edit Product</span>
                </label>

                <input type="radio" name="ptype" id="restore">
                <label for="restore">
                    <i class="fa-solid fa-trash-arrow-up fa"></i></i>
                    <span>Restore Product</span>
                </label>

                <input type="radio" name="ptype" id="editCat">
                <label for="editCat">
                <i class="fa-solid fa-file-pen fa"></i>
                    <span>Edit Category</span>
                </label>

            </div>
        </div>

    </section>


    <div class="all-info">
        <div class="search-box">
            <input type="text" name="s-box" id="sbox" placeholder="Enter item name">

            <select name="itemType" id="itemTypes">
                <option value="all">All</option>
                <option value="table">Table</option>
                <option value="chair">Chair</option>
                <option value="sofa">Sofa</option>
                <option value="cabinet">Cabinet</option>
            </select>

        </div>


        <section class="infotable" id="infot">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Size</th>
                        <th>Product Type</th>
                        <th>Product Price</th>
                        <th>Product Stock</th>
                        <th>Product Sold</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- add product -->
                    <tr class="addprod">
                        <th colspan="10"><a href="adminAddProd.php">Add product <i class="fa-solid fa-plus fa" color="red"></i></a></th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0  order by product_id desc";
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th><?php echo $row["product_id"]; ?></th>
                                <th><?php echo $row["product_name"]; ?></th>
                                <th><img src="image/AllProductImg/<?php echo $row["product_image"]; ?>"></th>
                                <th><?php echo $row["product_size"]; ?></th>
                                <th><?php echo $row["cat_title"]; ?></th>
                                <th>RM <?php echo number_format($row["product_price"], 2); ?></th>
                                <th><?php echo $row["product_stock"]; ?></th>
                                <th><?php echo $row["product_sold"]; ?></th>
                                <th><a href="adminEditProd.php?edt&pid=<?php echo $row['product_id'] ?>&ptype=<?php echo $row['cat_title'] ?>"><button class="btn">edit</button></a></th>
                                <th><a onclick="return confirmationrev()"; href="Manageproduct.php?del&pid=<?php echo $row['product_id'] ?>&pnam=<?php echo $row['product_name'] ?>"><button class="btn">Remove</button></a></th>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="no-result">
                            <th colspan="9"><strong>Data not found !</strong></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
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

if (isset($_GET['del'])) {
    $pid = $_GET['pid'];
    $pname = $_GET['pnam'];
    $delLog = "has REMOVE a product (" . $pname . ") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");

    /* update to remove */
    mysqli_query($connect, "UPDATE product SET product_Is_delete = 1 WHERE product_id = '$pid'");
    mysqli_query($connect, "INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$delLog','$date.' '.$time')");

    ?>
        <script>alert("Product remove Successfully!");</script>
    <?php

    header("refresh:0.2, url=Manageproduct.php");
}

/* get restore from ajaxadminproduct.php */
if(isset($_GET['restore']))
{
    $resid = $_GET['resid'];
    $pname = $_GET['pname'];

    mysqli_query($connect,"UPDATE product SET product_Is_delete = 0 WHERE product_id = '$resid'");
    
    $resLog = "has RESTORE a product (".$pname.") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$resLog','$date.' '.$time')");

    ?>
        <script>alert("Product Restore Successfully!");</script>
    <?php
    header("refresh:0.2, url=Manageproduct.php");


}

/* get delper from ajaxadminproduct.php */
if(isset($_GET['delper']))
{
    $desid = $_GET['desid'];
    $pname = $_GET['pname'];

    mysqli_query($connect,"DELETE FROM product WHERE product_id = '$desid'");
    
    $deLog = "has DELETE (Permanent) a product (".$pname.") from product database.";
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$deLog','$date.' '.$time')");

    ?>
        <script>alert("Product delete permanent Successfully!");</script>
    <?php
    header("refresh:0.2, url=Manageproduct.php");


}

if(isset($_GET['delcat']))
{
    $catid = $_GET['catId'];
    $catname = $_GET['catname'];

    $result = mysqli_query($connect, "SELECT * FROM product WHERE product_type = '$catid'");
    
    if(mysqli_num_rows($result)<=0)
    {
        
        mysqli_query($connect,"DELETE FROM categories WHERE cat_id = '$catid'");
    
        $deLog = "has DELETE a category (".$catname.") from product database.";
        $date = date("Y-m-d");
        $time = date("h:i:sa");
        mysqli_query($connect,"INSERT INTO admindatalog (admin_id, admin_name, log_text, log_time) VALUES ('$aid','$aname','$deLog','$date.' '.$time')");

        ?>
            <script>alert("Category (<?php echo $catname;?>) deleted Successfully!");</script>
        <?php
        header("refresh:0.2, url=Manageproduct.php");
    }
    else
    {
        ?>
            <script>alert("This category contains some product and cannot be deleted.");</script>
        <?php
        header("refresh:0.2, url=Manageproduct.php");
    }


}
mysqli_close($connect);
ob_end_flush();
?>
