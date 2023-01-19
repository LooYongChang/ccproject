<?php include("connection.php");
SESSION_START();

    $option = $_POST['option'];
    $cusid = $_SESSION['id'];
    $x=1; /* show info data */
if($option == 'ohistory')
{
    ?>
        <table style="padding-bottom:3px; background-color:#e6e6fa">
			<tr>
				<th>Order ID</th>
				<th>Quantity of Item</th>
				<th>Payment Date</th>
				<th>Total Payment</th>
				<th>Payment Status</th>
				<th>More Info</th>
				<th>Comment</th>
			</tr>
			<?php
			$sql = "SELECT * FROM order_list WHERE cus_id = '$cusid'";
			$result = mysqli_query($connect, $sql);
			$data = array();
			$x = 1;
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$x += 1;
			?>
					<tr>
						<th><?php echo $row['order_id']; ?></th>
						<th><?php echo $row['total_product']; ?> items</php>
						</th>
						<th><?php echo $row['payment_date']; ?></th>
						<th>RM <?php echo number_format($row['total_payment'], 2); ?></th>
						<th><?php echo $row['payment_status']; ?></th>
						<th><span class="arrow-down"><i class="fa-solid fa-angle-down"></i></span></th>
						<?php
						if (empty($row['order_feedback'])) {
						?>
							<th><a href="feedback.php?fback&oid=<?php echo $row['order_id']; ?>"><button>Feedback</button></a></th>
						<?php
						} else {
						?>
							<th><button style="background-color:grey">Done</button></th>
						<?php
						}
						?>
					</tr>

					<tr class="test">
						<th colspan='7'>
							<?php
							$oid = $row["order_id"];
							$isql = "SELECT * FROM order_product WHERE order_id = '$oid'";
							$iresult = mysqli_query($connect, $isql);

							while ($irow = mysqli_fetch_assoc($iresult)) {
								
							?>
								<p class="more-info">
									<span style="font-size:25px; color:red;"><?php echo $irow['product_name'] ?></span>
									<span style="font-size:17px; color:grey;"><?php echo $irow['product_type'] ?></span>
									<span style="font-size:15px; color:green;">RM <?php echo $irow['product_price'] ?></span>
									<span style="font-size:15px; color:brown;">x <?php echo $irow['product_qty'] ?></span>
								
									<?php 
										$fpid= $irow['product_id'];
										$rate_result=mysqli_query($connect,"SELECT * FROM product_feedback WHERE order_id='$oid' AND product_id = '$fpid'");
										$rate_row = mysqli_fetch_assoc($rate_result);
										 
										if(mysqli_num_rows($rate_result)>0)
										{
											$fcontent=$rate_row['feedback_content'];
											if(!empty($fcontent))
											{
										?>
											<a class="ratebtn"><button id="rated">rated</button></a>
										<?php
										}
										}
										else
										{
											?>
												<a class="ratebtn" href="rating.php?rate&pid=<?php echo $fpid; ?>&oid=<?php echo $oid?>"><button>rate</button></a>
											<?php
										}
										?>
								
								</p>
							<?php
							}
							?>
						</th>
					</tr>
			<?php
				}
			}
			else
			{
				?>
				<tr><th colspan="7"><span><h4 style="color:rgb(105,105,105);">Currently No Data !</h4></span></th></tr>
				<?php
			}
			?>
		</table>
        
        <?php

}
else if($option == 'dstatus')
{
    ?>
        <table style="padding-bottom:3px; background-color:#e6e6fa">
			<tr>
				<th>Order ID</th> 
				<th>Delivery Date</th> 
				<th>Estimate Date</th> 
				<th>Delivery Status</th>
            </tr>
    <?php
        $sql="SELECT order_id,payment_date, delivery_status FROM order_list WHERE cus_id = '$cusid'";
        $result=mysqli_query($connect, $sql);
   
        if(mysqli_num_rows($result) > 0)
        {
            while($row=mysqli_fetch_assoc($result))
            {
                $stop_date = $row['payment_date'];
                $stop_date = date('Y-m-d', strtotime($stop_date . ' +4 day'));
                ?>
				<tr>
                <th><?php echo $row['order_id'];  ?></th> 
                <th><?php echo $row['payment_date']; ?></th> 
                <th><?php echo $stop_date ?></th> 
                <th><?php echo $row['delivery_status']; ?></th> 
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr><th colspan="6"><span><h4 style="color:rgb(105,105,105);">Currently No Data !</h4></span></th></tr>
            <?php
        }
        ?>
        </table>
        <?php
}
?>

<script>
    jQuery(document).ready(function()
    {
        jQuery(".test").hide();
        jQuery(".arrow-down").click(function(){
            jQuery(this).parents().next(".test").slideToggle();
        });
    });
</script>

<?php
mysqli_close($connect);
?>

