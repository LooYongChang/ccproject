<?php include("connection.php");
SESSION_START();
/* default is DESCENDING*/
$sort="";
$ssql="order by Cus_ID ASC";

if (isset($_POST['sort']))
{
    $sort=$_POST['sort'];

    if($sort == 'ASC')
    {
        $ssql = "order by Cus_ID ASC";
    }
    else if($sort == 'DSC')
    {
        $ssql = "order by Cus_ID DESC";
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

?>
    



<div class="header_fixed">
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Password</th>
                <th>Home Address</th>
                <th>Postcode</th>
                <th>State</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr class="adduser">
                <th colspan="10"><a href="adminAddUser.php?cadd">Add Customer <i class="fa-solid fa-plus fa" color="red"></i></a></th>
            </tr>
            <?php
            $result = mysqli_query($connect, "SELECT * FROM customer ".$asql.$ssql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <th><?php echo $row['Cus_ID']; ?></th>
                        <th><?php echo $row['Cus_Name']; ?></th>
                        <th><?php echo $row['Cus_Gender']; ?></th>
                        <th><?php echo $row['Cus_Email']; ?></th>
                        <th><?php echo $row['Cus_Contact']; ?></th>
                        <th><?php echo $row['cus_pass']; ?></th>
                        <th><?php echo $row['Cus_Address']; ?></th>
                        <th><?php echo $row['cus_postcode']; ?></th>
                        <th><?php echo $row['cus_state']; ?></th>

                        <th><a onclick="return confirmationC();" href="adminManageUser.php?cdel&cid=<?php echo $row['Cus_ID']; ?>&cname=<?php echo $row['Cus_Name']; ?>"><button>delete</button></a></th>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>

<?php 
mysqli_close($connect);
?>