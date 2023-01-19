

<?php include("connection.php");
ob_start();
SESSION_START();

if(isset($_POST["invoiceId"]))
{
    $aname = $_SESSION["admin_name"];
    $aposition = $_SESSION["admin_position"];
    $aemail = $_SESSION["admin_email"];

    $oid = $_POST["invoiceId"];

    $result = mysqli_query($connect,"SELECT * FROM order_list inner join customer on order_list.cus_id = customer.Cus_ID WHERE order_id='$oid'");
    $row = mysqli_fetch_assoc($result);

    


    if($oid != "-")
    {
    echo "<div class='salesAinven'><h3>Invoice</h3></div><br>";

    ?>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <div class="invimg"><img src="image/header_logo.jpeg"><h4>Aiture Furniture</h4></div>
                                </td>

                                <td></td>
                                <td></td>

                                <td>
                                    <strong>Invoice #</strong> <?php echo $row['order_id'];?><br>
                                    Created: <?php echo $row['payment_date'];?><br>
                                </td>
                            </tr>
                        </table>
                            <!-- End the table -->
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <strong>Delivery To</strong><br>
                                    Name: <?php echo $row["Cus_Name"] ?><br>
                                    Tel : <?php echo $row["Cus_Contact"] ?><br>
                                    <?php echo $row["Cus_Address"] ?><br>
                                    Postcode: <?php echo $row["cus_postcode"] ?><br>
                                </td>

                                <td></td>
                                <td></td>

                                <td>
                                    <strong>Create By</strong><br>
                                    <?php echo $aposition; ?> : <?php echo $aname; ?><br>
                                    Email: <?php echo $aemail; ?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    
                    <td>Payment Type</td>
                    <td></td>
                    <td></td>
                    <td>Payment Method</td>

                </tr>

                <tr class="details">
                    <td>Online Payment</td>
                    <td></td>
                    <td></td>
                    <td><?php echo $row["payment_method"];?></td>
                </tr>

                <tr class="heading">
                    <td>Item</td>
                    <td>Price (1 Item)</td>
                    <td>Quantity</td>
                    <td>Sub Total</td>
                </tr>

                <?php 
                $presult = mysqli_query($connect,"SELECT * FROM order_product inner join order_list on order_product.order_id = order_list.order_id WHERE order_product.order_id = '$oid'");
                $sub = 0;
                $total=0;
                    while ($prow = mysqli_fetch_assoc($presult)) {
                        $sub = $prow["product_price"] * $prow["product_qty"];
                        $total+=$sub;
                    ?>
                    <tr class="item">
                        <td><?php echo $prow["product_name"];?></td>
                        <td>RM <?php echo number_format($prow["product_price"],2);?></td>
                        <td><?php echo $prow["product_qty"];?></td>
                        <td>RM <?php echo number_format($sub,2);?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Grand Total: RM <?php echo number_format($total,2);?></td>
                    </tr>
            </table>

            <div class="invFooter">
            <p class="comName">Aiture Funiture</p>
            <p class="comAddre">87, Jalan MMU 9, Bandar DDU, Johor, Malaysia</p>
            </div>
        </div>
    <?php
}
}
?>

<?php
ob_end_flush();
mysqli_close($connect);
?>