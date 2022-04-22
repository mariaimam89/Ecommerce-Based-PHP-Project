<?php

include('admin-database.php');
$delmsg="";
if(!isset($_SESSION['adminlogged_in']) || $_SESSION['adminlogged_in']!=true){
    header("location: admin-login.php");
    exit;
}
if(isset($_GET['msg'])){
  $delmsg=$_GET['msg'];
}
else{
    $delmsg="";
}
if(isset($_GET['updatemsg'])){
 $updatemsg=$_GET['updatemsg'];
}
else{
    $updatemsg="";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="assests/css/indexstyle.css">
    <link rel="stylesheet" href="assests/css/header-footer-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assests/js/main.js"></script>
    <title>Welcome to ShopOnline.com</title>
</head>

<body>

    <?php
 include('assests/header.php');
 ?>



    <div class="main-body">
        <div class="sidenav">
            <h2>Admin Panel</h2>



            <a href="#" id="" class="getproducts">Manage Products</a>
            <a href="#" id="" class="category">Manage Categories</a>
            <a href="#" id="" class="brands">Manage Brands</a>
            <a href="#" id="" class="orders">Order Listings</a>


        </div>
        <br>



        <div class="products">

            <!-- status msg -->
            <div id="failmsg">
        
            </div>
            <div id="successmsg">
          <?php   echo $delmsg; echo $updatemsg; ?>
            </div>
            <!-- products -->
            <div id="fetch_products">
                <div class="table">
             

                </div>
            </div>


        </div>



        <!-- 
<?php
include_once('assests/footer.php');
?> -->
</body>

</html>