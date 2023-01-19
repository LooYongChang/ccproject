<?php include("connection.php");
SESSION_START();
ob_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Rating</title>
    <script src="https://kit.fontawesome.com/331b41dfe5.js" crossorigin="anonymous"></script>
  </head> 
  <style>
      @import url("navbar2.css");

      *{
          margin:0;
          padding:0;
          box-sizing: border-box;
          font-family:'Hubballi', cursive;
      }
      body{
          height:500px;
          background-color: #e6e6fa;
          text-align: center;
      }
      @import url("navbar2.css");
      .container{
          margin-top:5px;
          margin-left:450px;
          width:400px;
          background: white;
          padding:20px 30px;
          display:flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.125);
      }
      .text{
          font-size:25px;
          color:#666;
          font-weight:500;
          display:none;
      }
      input{
          display:none;
      }
      .title{
          font-size: 24px;
          font-weight: 700;
          margin-bottom: 30px;
          color: #fec107;
          text-transform: uppercase;
          text-align: center;
      }
      .star-widget label{
          font-size: 40px;
          color:#444;
          padding:10px;
          float:right;
          transition: all 0.2s ease;
      }
      input:not(:checked)~label:hover,
      input:not(:checked)~label:hover~label{
          color:#fd4;
      }
      input:checked~label{
          color:#fd4;
      }
      input#rate-5:checked~label{
          color:#fe7;
          text-shadow: 0 0 20px #952;
      }
      #rate-1:checked~div header:before{
    content:"I hate it";
      }
      #rate-2:checked~div header:before{
    content:"I don't like it";
      }
      #rate-3:checked~div header:before{
    content:"Not bad";
      }
      #rate-4:checked~div header:before{
    content:"Good Purchase!";
      }
      #rate-5:checked~div header:before{
    content:"It is awesome!";
      }
      form header{
          width:100%;
          font-size: 25px;
          color:#fec107;
          font-weight: 500;
          margin:5px 0 20px 0;
          text-align:center;
          transition:all 0.2s ease;
      }
      .textarea{
          height: 100px;
          width:100%;
          overflow:hidden;
      }
      .textarea textarea{
          height:100%;
          width:100%;
          outline:none;
          color:#111;
          border:1px solid #333;
          background: #FFFFFF;
          padding:10px;
          font-size: 17px;
      }
      .btn{
          height:45px;
          width:100%;
          margin:15px 0;
      }
      .btn button{
          height:40px;
          width:100%;
          border:1px solid #fec107;
          outline:none;
          background: #fec107;
          color:#F8F8FF;
          font-size: 17px;
          text-transform: uppercase;
          cursor:pointer;
          transition:all 0.3s ease;
          border-radius:3px;
      }
      .btn button:hover {
            background: #ffd658;
        }
        .textarea textarea{
            resize: none;
        }
        .textarea textarea:focus{
            border: 1px solid #fec107;
        }

        .pinfo
        {
            text-align: center;
        }
        
        .pinfo img
        {
            width:150px;
            border-radius:10%;
            padding:10px 0;
        }

        .pinfo
        {
            text-align: center;
        }

        .pinfo h4
        {
            font-size:15px;
            color:grey;
        }

        .pinfo h3
        {
            font-size:19px;
            color:darkgrey;
        }

        body{
        width: 100%;
        background: linear-gradient(-45deg,#F7C2CB,#F6DEFA,#6CC6CB,#EAE5C9);
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


  </style>
  <body>
  <div class="head">
		<div class="navigation">

			<div class="mainlogo">

				<img src="image/nobglogo.png">
			</div>


			<div class="navbar">
				<nav>
					<?php

					if (isset($_SESSION['id'])) {
					?>

						<a href="dashboard.php"><span id="welcome">Welcome, </span><?php echo $_SESSION['name'] ?></a>

					<?php
					} else {
					?>
						<a href="login.php">Login <i class="fa fa-user" aria-hidden="true"></i></a>
					<?php
					}
					?>
					<a href="MainPage.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
					<a href="shop.php"><i class="fa fa-bars" aria-hidden="true"></i> Product</a>
					<?php
					if (!isset($_SESSION['cartnum'])) {

						$_SESSION['cartnum'] = 0;
					} else {
						if (isset($_SESSION['id'])) {
							$cid = $_SESSION['id'];
							$sql = "SELECT * FROM cart WHERE cus_id = '$cid'";
							$Cresult = mysqli_query($connect, $sql);
							if (mysqli_num_rows($Cresult) > 0) {
								$_SESSION['cartnum'] = mysqli_num_rows($Cresult);
							} else {
								$_SESSION['cartnum'] = 0;
							}
						}
					}
					?>
					<a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart (<?php echo $_SESSION['cartnum'] ?>)</a>
					<a href="aboutUs.php"><i class="fa fa-address-card"></i> About</a>
					
					<div class="animation start-account"></div>
				</nav>
			</div>
		</div>
	</div>

            <div class="container">
          <div class="post">
              <div class="text">Thank for rating us!</div>
          </div>
          <div class="title"><b>Rating Us!</b></div>
        <div class="star-widget">
            <?php 
                $pid = $_GET['pid'];
                $result=mysqli_query($connect,"SELECT * FROM product WHERE product_id ='$pid'");
                $row = mysqli_fetch_assoc($result)
            ?>


            <form method="post" alt="">

                <div class="pinfo">
                    <h4>Product ID <?php echo $pid; ?></h4>

                    <h3>Name: <?php echo $row['product_name']; ?></h3>
                    <img src="image/AllProductImg/<?php echo $row['product_image'] ?>" width="100%" id="MainIMG" alt="">
                    <h3>Size: <?php echo $row['product_size']; ?></h3>
                </div>

                <input type="radio" name="star" id="rate-5" value="5">
                <label for="rate-5" class="fa fa-star"></label>

                <input type="radio" name="star" id="rate-4" value="4">
                <label for="rate-4" class="fa fa-star"></label>

                <input type="radio" name="star" id="rate-3" value="3">
                <label for="rate-3" class="fa fa-star"></label>

                <input type="radio" name="star" id="rate-2" value="2">
                <label for="rate-2" class="fa fa-star"></label>

                <input type="radio" name="star" id="rate-1" value="1">
                <label for="rate-1" class="fa fa-star"></label>
                
                <div>
                    <header></header>
                    <div class="textarea">
                        <textarea cols="30" name="feedback" placeholder="Describe your experience..." required></textarea>
                    </div>
                    <div class="btn">
                        <button name="sbtn" type="submit">POST</button>
                    </div>
                </div>
            </form>
      <script>

          const text=document.querySelector(".text");
          const widget=document.querySelector(".star-widget");
          const title=document.querySelector(".title");
          btn.onclick=()=>{
              title.style.display="none";
              widget.style.display="none";
              text.style.display="block";
              return false;
          }


      </script>
  </body>
</html>

<?php

if(isset($_POST['sbtn']))
{
    $proid = $pid;
    $cusid=$_SESSION['id'];
    $cusname=$_SESSION["name"];
    $cusgender=$_SESSION["gender"];
    $star = $_POST['star'];
    $feedback = $_POST['feedback'];
    $date = date("Y-m-d");
    $oid = $_GET['oid'];
    $pqty = $_GET['pqty'];
    $pname= $_GET['pname'];
    

    mysqli_query($connect,"INSERT INTO product_feedback (cus_id,cus_name,cus_gender,product_id,feedback_content,feedback_rating,feedback_date,order_id,product_qty,product_name) 
    VALUES ('$cusid','$cusname','$cusgender','$proid','$feedback','$star','$date','$oid','$pqty','$pname')");


    ?> 
        <script>alert("Thanks for rating!");</script>
    <?php
    header('refresh:0.3, url=dashboard.php');

}
ob_end_flush();
mysqli_close($connect);
?>