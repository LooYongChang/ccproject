<?php include("connection.php");
SESSION_START();

$csql="";
$ssql="";
$psql="";


$sql = "SELECT * FROM product inner join categories on product.product_type = categories.cat_id WHERE product_Is_Delete=0";

if(isset( $_POST['option']))
{
    $option = $_POST['option'];
    if($option == "All")
    {
        $csql = "";
    }
    else 
    {
        $csql = " AND categories.cat_title = '$option'";
    
    }
}


if(isset($_POST['search']))
{
    $search = $_POST['search'];

    if(!empty($search))
    {
        $ssql = " AND product_name LIKE '%$search%'";
    }
    else
    {
        $ssql="";
    }
    
}

if(isset($_POST['price']))
{
    $price = $_POST['price'];

    if($price == "ascending")
    {
        $psql = " ORDER BY product_price ASC";
    }
    else if($price == "descending")
    {
        $psql =  " ORDER BY product_price DESC";
    }
    else
    {
        $psql="";
    }
}

$sql = $sql." ".$csql." ".$ssql." ".$psql;


            $result = mysqli_query($connect, $sql);
            if(mysqli_num_rows($result)>0)
            {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="pro">
                <a href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>"> <img src="image/AllProductImg/<?php echo $row["product_image"]; ?>" alt=""></a>
                        <div class="type">
                            <span><?php echo $row['cat_title'] ?></span>
                            <a href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>">  <h5><?php echo $row["product_name"]; ?></h5></a>
                            <div class="star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h4>RM <?php echo number_format($row["product_price"],2) ?></h4>
                            <div class="remain_stock">
                                <h3>Stock: <?php echo $row['product_stock'] ?></h3>
                            </div>
                            <form name="product" method="post" action="">
                                <a class="cart" href="singleprod.php?prod&prodid=<?php echo $row['product_id'] ?>"><i class="fa fa-shopping-cart"></i></a>
                            </form>
                        </div>
                    </div>
                    </form>
                <?php
                }
            }
            else
            {
                echo "<h3>Item Not Found !</h3>";
            }
            ?>
 


<?php

mysqli_close($connect);
?>