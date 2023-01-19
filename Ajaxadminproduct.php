<?php include("connection.php");
SESSION_START();

/* default sql */
$sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0";      
$desending = " order by product_id desc";

if(isset($_POST['option']) || isset($_POST['search']))
{
    if(isset($_POST['option']))
    {
        $option = $_POST['option'];
        if(!empty($option))
        {
            if($option == "all")
            {
                $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0";      
            }
            else 
            {
                $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE categories.cat_title = '$option' AND product_Is_Delete=0";      
            
            }
        }
    }
    
    if(isset($_POST['search']))
    {
        $search = $_POST['search'];

        if(!empty($search))
        {
            $sql .= " AND product_name LIKE '%$search%'";
        }
    }

    ?>

            <table class="content-table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
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
                    <tr  class="addprod">
                        <th colspan="9"><a href="adminAddProd.php">Add product <i class="fa-solid fa-plus fa" color="red"></i></a></th>                      
                    </tr>
                    <?php
                        $result = mysqli_query($connect, $sql." ".$desending);
                        if(mysqli_num_rows($result)>0)
                        {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <th><?php echo $row["product_id"]; ?></th>
                                <th><?php echo $row["product_name"]; ?></th>
                                <th><img src="image/AllProductImg/<?php echo $row["product_image"]; ?>"></th>
                                <th><?php echo $row["cat_title"]; ?></th>
                                <th>RM <?php echo number_format($row["product_price"],2); ?></th>
                                <th><?php echo $row["product_stock"]; ?></th>
                                <th><?php echo $row["product_sold"]; ?></th>
                                <th><a href="adminEditProd.php?edt&pid=<?php echo $row['product_id']?>&ptype=<?php echo $row['cat_title']?>"><button class="btn">edit</button></a></th>
                                <th><a onclick="return confirmationrev()"; href="Manageproduct.php?del&pid=<?php echo $row['product_id']?>"><button class="btn">Remove</button></a></th>
                            </tr>
                    <?php 
                    }
                    }
                    else
                    {
                        ?> 
                            <tr class="no-result">
                                <th colspan="9"><strong>Data not found !</strong></th>
                            </tr>
                        <?php
                    }
                    ?>  
                </tbody>
            </table>
<?php           
}


if(isset($_POST['restore']))
{
    $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=1";
    $desending = "order by product_id desc";
?>
        <table class="content-table" id="restore-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Type</th>
                    <th>Product Price</th>
                    <th>Product Stock</th>
                    <th>Product Sold</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                <form method="post" alt="">
                <?php
                    $result = mysqli_query($connect, $sql." ".$desending);
                    if(mysqli_num_rows($result)>0)
                    {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <th><?php echo $row["product_id"]; ?></th>
                            <th><?php echo $row["product_name"]; ?></th>
                            <th><img src="image/AllProductImg/<?php echo $row["product_image"]; ?>"></th>
                            <th><?php echo $row["cat_title"]; ?></th>
                            <th>RM <?php echo number_format($row["product_price"],2); ?></th>
                            <th><?php echo $row["product_stock"]; ?></th>
                            <th><?php echo $row["product_sold"]; ?></th>
                            
                            <th><a onclick="return confirmationres()"; href="Manageproduct.php?restore&resid=<?php echo $row["product_id"];?>&pname=<?php echo $row["product_name"];?>"><button class="btn" name="resbtn">Restore</button></a></th>
                            <th><a onclick="return confirmationdel()"; href="Manageproduct.php?delper&desid=<?php echo $row["product_id"];?>&pname=<?php echo $row["product_name"];?>"><button class="btn" name="resbtn">Delete</button></a></th>
                        </tr>
                <?php 
                }
                ?>
                </form>
                <?php
                }
                else
                {
                    ?> 
                        <tr class="no-result">
                            <th colspan="9"><strong>Data not found !</strong></th>
                        </tr>
                    <?php
                }
                ?>  
            </tbody>
        </table>
<?php
}
?>

<?php
if(isset($_POST['editCat']))
{
    $sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=1";
    $desending = "order by product_id desc";
?>
        <table class="content-table" id="restore-table">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Category Icon</th>
                    <th>Icon Code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>
                <form method="post" alt="">
                <th colspan="6"><span id="catadd"><a href="adminAddCat.php">Add category <i class="fa-solid fa-plus fa" color="red"></i></a></span></th>                      
                <?php
                    $result = mysqli_query($connect, "SELECT * FROM categories");
                    if(mysqli_num_rows($result)>0)
                    {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <th><?php echo $row["cat_id"]; ?></th>
                            <th><?php echo $row["cat_title"]; ?></th>
                            <th><i class="<?php echo $row["cat_icon"]; ?>"></i></th>
                            <th><?php echo $row["cat_icon"]; ?></th>
                            <th><a href="adminEditCat.php?edtCat&catId=<?php echo $row['cat_id'];?>"><button class="btn" name="edtcat">Edit</button></a></th>
                            <th><a onclick="return confirmation();" href="Manageproduct.php?delcat&catId=<?php echo $row['cat_id'];?>&catname=<?php echo $row['cat_title'];?>"><button class="btn" name="delcat">Delete</button></th>
                        </tr>
                        <?php 
                        }
                        ?>
            </tbody>
        </table>
<?php
}

}
?>

