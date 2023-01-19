<?php include("connection.php");
SESSION_START();

$otp="delivery";

/* default is DESCENDING*/
$sort="";
$ssql="order by order_id DESC";

if (isset($_POST['sort']))
{
    $sort=$_POST['sort'];

    if($sort == 'DSC')
    {
        $ssql = "order by order_id DESC";
    }
    else if($sort == 'ASC')
    {
        $ssql = "order by order_id ASC";
    }
}

/* set search by cus name, default is empty */
$asql="";

if (isset($_POST['cusName'])) {
    $search = $_POST['cusName'];
    if(!empty($search))
    {
        $asql = " WHERE cus_name LIKE '%$search%'";
    }
    else
    {
        $asql="";
    }
}


if (isset($_POST['option'])) {
    $otp=$_POST['option'];

    if(empty($otp))
    {
        $otp="delivery";
    }

   
    if ($otp == "delivery") {
?>

        <section class="infotable" id="infot">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>order ID</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Delivery Status</th>
                        <th>Change Status</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM order_list ".$asql." ".$ssql;
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th><?php echo $row["order_id"]; ?></th>
                                <th><?php echo $row["cus_name"]; ?></th>
                                <th><?php echo $row["cus_address"]; ?></th>
                                <th><?php echo $row["delivery_status"]; ?></th>
                                <?php
                                if($row["delivery_status"] == "In Transit")
                                {
                                ?>                 
                                 <th><a href="adminOrder.php?arr&oid=<?php echo $row['order_id'] ?>"><button class="btn">Arrived</button></a></th>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <th><a href="adminOrder.php?una&oid=<?php echo $row['order_id'] ?>"><button class="btn">Unarrive</button></a></th>
                                    <?php
                                }
                                
                                if($row['delivery_status'] != "Arrived")
                                {
                                ?>

                                 <th><a href="adminOrder.php?cancel&oid=<?php echo $row['order_id'] ?>"><button class="btn">Cancel</button></a></th>
                                <?php 
                                }
                                else
                                {
                                    ?>

                                    <th></th>
                                   <?php  
                                }
                                ?>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr class="no-result">
                            <th colspan="9"><strong>Currently no order !</strong></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>

    <?php
    } else if ($otp== "view") {
    ?>
        <section class="infotable" id="infot">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>order ID</th>
                        <th>Customer Name</th>
                        <th>Ordered Product</th>
                        <th>Total Payment</th>
                        <th>Payment Method</th>
                        <th>Name on Card</th>
                        <th>Card No</th>
                        <th>CVV No</th>
                        <th>Payment Date</th>
                        <th>Feedback</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM order_list ".$asql." ".$ssql;
                    $result = mysqli_query($connect, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <th><?php echo $row["order_id"]; ?></th>
                                <th><?php echo $row["cus_name"]; ?></th>
                                <th><?php echo $row["total_product"]; ?></th>
                                <th><?php echo $row["total_payment"]; ?></th>
                                <th><?php echo $row["payment_method"]; ?></th>
                                <th><?php echo $row["cus_nameOncard"]; ?></th>
                                <th><?php echo $row["cus_cardNo"]; ?></th>
                                <th><?php echo $row["cus_CW"]; ?></th>
                                <th><?php echo $row["payment_date"]; ?></th>
                                <th><button class="btn">view</button></th>
                            </tr>

                            <tr class="feedback">
                                <?php 
                                    if(!empty($row["order_feedback"]))
                                    {
                                ?>
                                <th colspan="10" class="orderInfo">
                                    <h3>Feedback : </h3>
                                    <p><?php echo $row["order_feedback"]; ?></p>
                                </th>
                                <?php 
                                    }
                                    else
                                    {
                                        ?>
                                        <th colspan="10" class="orderInfo">
                                        <h6>Customer not yet give any feedback</h6>
                                        </th>
                                        <?php
                                    }
                                ?>
                            </tr>
                        <?php
                        }
                    } 
                    else 
                    {
                        ?>
                        <tr class="no-result">
                            <th colspan="10"><strong>Currently no order !</strong></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>


<?php
    }
}

?>
<script>
            /* hide feedback */
            jQuery(document).ready(function() {
                jQuery(".feedback").hide();
                jQuery(".btn").click(function() {
                    jQuery(this).parents().next(".feedback").slideToggle();
                });
            });
        </script>
<?php

mysqli_close($connect);
?>
