<?php include("connection.php");
ob_start();
SESSION_START();
if(isset($_SESSION['admin_id']))
{
    $aid= $_SESSION['admin_id'];
    $aname = $_SESSION['admin_name'];
    $aposition = $_SESSION['admin_position'];
}
else
{
    ?> <script>alert("Please login first !");</script><?php
    header("refresh:0.2, url=adminLogin.php");
}
?>
<html>

<head>
    <title>Reports</title>
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

  <!-- Date Picker-->
  <script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  </script>

    <script type="text/javascript">
        /* print report*/
        $(document).ready(function() {
            $("#print-report").click(function(){
                document.body.innerHTML = document.all.item("reports").innerHTML;
                window.print();
                window.location.reload();
            })
        })
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
        text-align: center;
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

        .search {
            height: 13vh;
            width: 700px;
            display: flex;
            padding-top: 40px;
        }

        .search label {
            height: 60px;
            width: 210px;
            border: 2px solid #483d8b;
            margin: auto;
            border-radius: 10px;
            position: relative;
            color: #483d8b;
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
            font-weight: 500;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, 80%);
        }

        .search input[type="radio"]:checked+label {
            background-color:#483d8b;
            color: #ffffff;
            box-shadow: 0 15px 45px #483d8b;
        }

        input[type="radio"] {
            -webkit-appearance: none;
        }
        
        .print
        {
            margin-top:50px;
        }

        .print button
        {
            padding:3px 12px 3px 12px;
            font-size:20px;
            font-weight:bold;
            background-color:blueviolet;
            color:white;
            border:none;
            border-radius:5px;
            transition: transform .2s;
        }

        .print button:hover
        {
            transform: scale(1.2);
            cursor:pointer;
        }

        #reportInfo
        {
            margin-top:40px;
            background-color:white;
            width:1050px;
            padding:30px 20px;
            margin-bottom:30px;
            border-radius:10px;
        }
 
        .salesAinven table {
        border-collapse: collapse;
        box-shadow: 0 5px 10px grey;
        background-color: white;
        text-align: left;
        overflow: hidden;
        }

        .salesAinven thead 
        {
            box-shadow: 0 5px 10px grey;
        }

        .salesAinven th {
            padding: 1rem 2rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            font-size: 0.7rem;
            font-weight: 900;
        }

        .salesAinven td {
            padding: 1rem 2rem;
        }

        .salesAinven a {
            text-decoration: none;
            color: #2962ff;
        }

        .salesAinven .amount {
            text-align: right;
        }

        .salesAinven tr:nth-child(even) {
            background-color: #f4f6fb;
        }

        .salesAinven h3
        {
            margin-top:15px;
            color:red;
        }

        .salesAinven h4
        {
           text-align:left;
           margin-left:40px;
           font-size:15px;
           color:rgb(128,128,128);
           margin-bottom:5px;
        }
        
        #findbtn
        {
            margin-left:10px;
            padding:2px 5px;
            font-size:15px;
            background-color:white;
            border:0.2px solid black;
        }

        #findbtn:hover
        {
            background-color:grey;
            cursor:pointer;
        }

        .invoiceOption
        {
            font-size:18px;
        }

        .invoiceOption option
        {
            text-align:left;
        }

        .invoice-box
        {
            max-width: 800px;
            margin:auto;
            padding:30px;
            border:1xp solid #eee;
            box-shadow:0 0 10px rgba(0,0,0,0.15);
            font-size:16px;
            line-height:24px;
        }

        .invoice-box table
        {
            width:100%;
            line-height:inherit;
            text-align:left;
        }

        .invoice-box table td
        {
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table tr td:nth-child(4)
        {
            text-align:right;
        }

        .invoice-box table tr .top table td
        {
            padding-bottom:20px;
        }

        .invoice-box table tr .information table td
        {
            padding-bottom:40px;
        }

        .invoice-box table tr.heading td
        {
            background:#eee;
            border-bottom: 1px solid #ddd;
            font-weight:bold;

        }

        .invoice-box table tr.details td
        {
            padding-bottom:20px;
        }

        .invoice-box table tr.item td
        {
            border-bottom:1px solid #eee;
        }


        .invimg img
        {
            width:50px;
            border-radius:8px;
            margin-left:35px;;
        }

        .invFooter
        {
            padding-top:50px;
        }

        .invFooter .comName
        {
            font-weight:bold;
        }

        .invFooter .comAddre
        {
            color:darkgrey;
        }

        .InvenInfo
        {
            margin-top:20px;
            margin-left:55px;
            display:flex;
        }

        .SalesInfo
        {
            display:flex;
            margin-top:20px;
        }
    </style>

    


</head>

<body>

    <div class="head">
        <div class="navigation">
            <div class="mainlogo">
                <img src="image/nobglogo.png">
            </div>

            <div class="navbar">
                <nav>
                    <a href="adminHome.php?logout"><span style="font-size:10px; overflow:none;"><?php echo $aposition ?></span> <?php echo $aname?> <i class="fa fa-user" aria-hidden="true"></i> <span class="logout">Log out <i class="fa-solid fa-right-from-bracket"></i></span></a>
                    <a href="adminHome.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    <a href="adminManageUser.php"><i class="fa-solid fa-users"></i></i> Manage User</a>
                    <a href="Manageproduct.php"><i class="fa-solid fa-list-check"></i> Manage product</a>
                    <a href="adminOrder.php"><i class="fa-solid fa-clipboard"></i> Manage Order</a>
                    <a href="adminReport.php"><i class="fa-solid fa-file-invoice"></i> Reports</a>
                    <div class="animation start-report"></div>
                </nav>
            </div>
        </div>
    </div>

    <div class="searchcontainer">
        <div class="search">
            <input type="radio" name="ptype" class="report-type" id="sales" value="sales" checked>
            <label for="sales">
                <i class="fa-solid fa-sack-dollar fa"></i>
                <span>Sales Report</span></a>
            </label>


            <input type="radio" name="ptype" class="report-type" id="inven" value="ivent">
            <label for="inven">
                <i class="fa-solid fa-cart-flatbed fa"></i>
                <span>Inventory Report</span>
            </label>

            <input type="radio" name="ptype" class="report-type" id="invoice" value="invoice">
            <label for="invoice">
                <i class="fa-solid fa-eye fa"></i>
                <span>Invoice</span>
            </label>

        </div>
    </div>

    <div class="print">
        <button id="print-report">Print</button>
    </div>
    

    <!-- find date period -->
    <script>
    var rtype="";
    $(document).ready(function() {

            /* Reports type */
            jQuery('.report-type').click(function() {
                rtype = $(this).val();

                if(rtype=="sales")
                {
                    location.reload("AdminReport.php");
                }
                else
                {
                    $.ajax({
                        url: "ajaxReport.php",
                        method: "POST",
                        data: {reportType:rtype},
                        success: function(data) {
                            $('#reportInfo').html(data);
                        }
                    })
                }
            })

            /* sales Reports date */
            jQuery('#findbtn').click(function() {

                    f = $("#from").val();
                    t = $("#to").val();

                    if(f!="" && t!="")
                    {
                        $.ajax({
                            url: "ajaxReport.php",
                            method: "POST",
                            data: {from:f,to:t,report:"sales",reportType:rtype},
                            success: function(data) {
                                $('#reports').html(data);
                            }
                        })
                    }
                    else
                    {
                        alert("You must full fill the date.");
                    }
                })
            })
    </script>
    
    <div id="reportInfo">

             Date: 
             <label for="from">From</label>
             <input type="text" id="from" name="from">
             <label for="to">to</label>
             <input type="text" id="to" name="to">
             <button name="find" id="findbtn">Filter</button>


     <div id="reports">
        <div class="salesAinven">
                
                    <h3>Sales Report</h3>

                <div class="SalesInfo">
                    <h4>Date: All (default)</h4>
                    <?php
                        $total_amount=0;
                        $nresult = mysqli_query($connect,"SELECT * FROM order_list");
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

                        $result = mysqli_query($connect,"SELECT * FROM order_list ");
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
                            ?> 
                
                    </tbody>
                </table>
            </div>
        </div>
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

if(isset($_POST["findbtn"]))
{
    echo "<script>alert('ok');</script>";
}


?>