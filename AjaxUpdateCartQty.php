<?php
include("connection.php");
SESSION_START();
/* update item qty */
if (isset($_POST["prodid"])) {
    $udpid = $_POST["prodid"];
    $udpqty = $_POST["quantity"];
    $cid = $_SESSION['id'];

    $_SESSION['cart'][$udpid] = $udpqty;
    mysqli_query($connect,"UPDATE cart SET product_qty='$udpqty' WHERE product_id='$udpid' AND cus_id='$cid'");
}
mysqli_close($connect);
?>