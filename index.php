<?php
include_once('database.php');?>
<?php 
//Add to cart Functionality
$quantity="";
$count="";
$status="";
$successmsg="";
$id="";
$flag=0;
if(isset($_POST['productid'])){
  $id=$_POST['productid'];
}
if(isset($_GET['msg'])){
  $successmsg=$_GET['msg'];
}
//checking if the user is logged in
if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){
  $status = "<div class='box' style='color:red;'>
  You have to first LOGIN to continue shopping!</div>";
}
else{
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(isset($_POST['addtocart'])){
   $cart_array=array('productid'=>$_POST['productid'],'name'=>$_POST['productname'],'price'=>$_POST['productprice'],'image'=>$_POST['productimage'],'quantity'=>$_POST['changequantity']);
  // print_r($cart_array);
  if (empty($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'][$id] = $cart_array;
    $status ="Product is Added To Your Cart! ";
  }else{
      foreach ($_SESSION['shopping_cart'] as $key => $value) {
        if ($id == $key ) {
          $flag =1;		
        }
      }
      if ($flag) {
       $_SESSION['shopping_cart'][$id]['quantity'] =$_SESSION['shopping_cart'][$id]['quantity']+1;
       $status ="Product is Added To Your Cart!";
      }
      else{
        $_SESSION['shopping_cart'][$id] = $cart_array;
        $status ="Product is Added To Your Cart!";
     
      }
   }



  }
	
		}
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
    <link rel="stylesheet" href="assests/css/pagination.css">
    <link rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assests/js/main.js"></script>
    <script>
    </script>

    <title>Welcome to ShopOnline.com</title>
</head>

<body>

    <?php
 include('assests/header.php');

  //    Code to display categories after fetching from database

  // Categories
  $fetch_cat = $database->read_categories();
  ?>
   
    <div class="main-body">
        <div class="sidenav">
            <h2>Categories</h2>
            <a href="index.php">All Categories</a>
            <?php while ($cat = mysqli_fetch_assoc($fetch_cat)) {
        $cat_id = $cat['category_id']; ?>
            <a href="#" id="<?php echo  $cat_id ?>" class="category"><?php echo $cat['category_name'];  ?></a>
            <?php } ?>
            <br>
            <!-- Brands -->
            <?php  $fetchbrands=$database->read_brands();?>
            <h2>Brands</h2>
            <?php while ($brnd = mysqli_fetch_assoc($fetchbrands)) {
        $brand_id = $brnd['brand_id']; ?>
            <a href="#" id="<?php echo $brand_id ?>" class="brand"><?php echo $brnd['brand_name'];  ?></a>
            <?php } ?>
        </div>


        <div class="products">

            <!-- status msg -->
            <div id="statusmsg">
                <?php echo $status; ?>
            </div>
            <div id="successmsg">
                <?php echo $successmsg; ?>
            </div>
            <!-- product results -->
            <div id="fetch_products">


            </div>
        </div>



    </div>
    
</body>

</html>