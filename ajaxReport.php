
<?php include("connection.php");
ob_start();
SESSION_START();
$sub_sql = "";
if(isset($_POST['report'])=="sales")
{
    $from = $_POST['from'];
    $fromArr = explode("/",$from);
    $from = $fromArr['2'].'-'.$fromArr['0'].'-'.$fromArr['1'];

    $to = $_POST['to'];
    $toArr = explode("/",$to);
    $to = $toArr['2'].'-'.$toArr['0'].'-'.$toArr['1'];

    $sub_sql = "WHERE payment_date >= '$from' && payment_date <= '$to'";


    ?>
    <div class="salesAinven">
    <h3>Sales Report</h3>
            <div class="SalesInfo">
                <h4>Date: From <?php echo $from;?> to <?php echo $to;?></h4>
                <?php
                $total_amount=0;
                $nresult = mysqli_query($connect,"SELECT * FROM order_list ".$sub_sql);
                $qty_cus =  mysqli_num_rows($nresult);
                while ($nrow = mysqli_fetch_assoc($nresult)) {
                    $total_amount+=$nrow["total_payment"];
                }
                ?>
                <h4>Total Customer: <?php echo $qty_cus;?> person</h4>
                <h4>Total Amount: RM <?php echo number_format($total_amount,2);?></h4>
            </div>
        <table>
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Pay Date</th>
                <th>Status</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
                <?php 

                $result = mysqli_query($connect,"SELECT * FROM order_list ".$sub_sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["order_id"]; ?></td>
                            <td><?php echo $row["cus_name"]; ?></td>
                            <td><?php echo $row["cus_email"]; ?></td>
                            <td><?php echo $row["payment_date"]; ?></td>
                            <td><?php echo $row["payment_status"]; ?></td>
                            <td>RM <?php echo number_format($row["total_payment"],2); ?></td>
                        </tr>
                    <?php 
                    }
                }
                else
                {
                    echo "<tr> <th colspan='6' style='text-align:center;'> Data not found </th> </tr>";
                }
                ?> 
        
            </tbody>
        </table>
    </div>
 
     <?php
}

if(isset($_POST['reportType']))
{
    $reportType = $_POST['reportType'];

 
    if($reportType == "ivent")
    {
        $date = date("Y-m-d");
        ?>
        <div id="reports">
            <div class="salesAinven">
                    <h3>Inventory Report</h3>
                    <div class=InvenInfo>
                        <h4>Date: <?php echo $date; ?> (Current)</h4>
                        <?php
                        $psold=0;
                        $presult = mysqli_query($connect,"SELECT * FROM product ");
                        $qty_pro =  mysqli_num_rows($presult);
                        while ($prow = mysqli_fetch_assoc($presult)) {
                            $psold+=$prow['product_sold'];
                        }
                        ?>
                        <h4>Total Product: <?php echo $qty_pro;?> Items</h4>
                        <h4>Total Product Sold: <?php echo $psold;?> Items</h4>
                    </div>
                <table>
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product price</th>
                        <th>Product Sold</th>
                        <th>Remaining Stock</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 

                        $result = mysqli_query($connect,"SELECT * FROM product ");
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row["product_id"]; ?></td>
                                    <td><?php echo $row["product_name"]; ?></td>
                                    <td>RM <?php echo number_format($row["product_price"],2); ?></td>
                                    <td><?php echo $row["product_sold"]; ?> items</td>
                                    <td><?php echo $row["product_stock"]; ?> items</td>
                                </tr>
                            <?php 
                            }
                            }
                            ?> 
                
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
    /* go to invoice */
    else if($reportType == "invoice")
    {
       ?>
            Select Order ID : 
            <select class="invoiceOption" id="invoiceOption">
                <option style="text-align:center;">-</option>
                <?php 
                $sql = "SELECT * FROM order_list order by order_id desc";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row["order_id"];?>">Order ID: <?php echo $row["order_id"];?> , Customer name: <?php echo $row["cus_name"];?></option>
                    <?php
                    }
                }
                ?>
            </select>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        /* ajax invoice */
    var rtype="";
    $(document).ready(function() {

            /* get invoice by order id */
            jQuery('#invoiceOption').click(function() {
                    opt = $(this).find(":selected").val();
                    
                        $.ajax({
                            url: "reportInvoice.php",
                            method: "POST",
                            data: {invoiceId:opt},
                            success: function(data) {
                                $('#reports').html(data);
                            }
                        })
                    
                })
            })
            </script>

            <div id="reports">
                
            </div>
       <?php
    }
}

?>





<?php
ob_end_flush();
mysqli_close($connect);
?>