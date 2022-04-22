<?php

session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!=true){
    header("location: index.php");
    exit;
}
$status="";
//remove item Functionality
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['removeproduct'])){
		foreach($_SESSION['shopping_cart'] as $key=>$value){
			if($value['name']==$_POST['productname']){
				unset($_SESSION['shopping_cart'][$key]);
				$_SESSION["shopping_cart"]=array_values($_SESSION["shopping_cart"]);
				$status = "<div class='box' style='color:red;'>
				Product is removed from your cart!</div>";
				
			}
	
		}
	}
    if(isset($_POST['changequantity'])){

		foreach($_SESSION['shopping_cart'] as $key=>$value){
			if($value['name']==$_POST['productname']){
		      
                $_SESSION['shopping_cart'][$key]['quantity']=$_POST['changequantity'];
                
				
			}
	
		}
	}
}

?>
<html>

<head>
    <title>My Shopping Cart</title>
    <link rel='stylesheet' href='assests/css/header-footer-style.css' type='text/css' media='all' />
    <link rel="stylesheet" href="assests/css/indexstyle.css">
    <link rel="stylesheet" href="assests/css/cart.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assests/js/cart.js"></script>


</head>

<body>
    <?php include('assests/header.php'); ?>
    <div style="width:700px; margin:50 auto;">
        <!-- ...Message Box.... -->
        <div class="message_box" style="margin:10px 0px;">
            <?php echo $status; ?>
        </div>
        <h2>My Shopping Cart</h2>

        <?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
        <div class="cart_div">
            <a href="cart.php">
                <img src="assests/imgs/cart.png" width="30px" height="30px" />No. of Products:
                <span>
                    <?php echo $cart_count; 
				
					
				?>
                </span></a>
        </div>
        <?php
}
else
{
	$status = "<div class='box' style='color:red;'>
				Your cart is empty.Please add items in your cart!</div>";
	echo $status;

}
?>

        <div class="cart">



            <table class="table">
                <tbody>
                    <tr>

                        <td>Product Name</td>
                        <td>Product Price</td>
                        <td>Product Image</td>
                        <td>Product Quantity</td>
                        <td>Total</td>
                        <td>Action</td>

                    </tr>
                    <?php
$total=0;	
if(isset($_SESSION["shopping_cart"])){
foreach ($_SESSION["shopping_cart"] as $key=>$value){
	$total=$total+$value['price'];
	echo '<tr>
	<td>'.$value['name'].'</td>
	<td>$'.$value['price'].' <input type="hidden" class="pprice" value="'.$value['price'].'"/></td>
	<td><img src="product-imgs/'.$value['image'].'" width="100px" height="100px"></td>
    <form class="quantityform" action="cart.php" method="post">
	<td><input style="text-align:center; height:35px" name="changequantity" type="number" min="1" max="10" class="pquantity" onchange="this.form.submit()" value="'.$value['quantity'].'"/></td>
	<input type="hidden" name="productname" value="'.$value['name'].'"/>
    </form>
    <td class="ptotal"></td>
	<form action="cart.php" method="post">
	<td><button type="submit" name="removeproduct" id="remove-btn">Remove</button></td>
	<input type="hidden" name="productname" value="'.$value['name'].'"/>
	</form>
	</tr>';
} 
} 

?>
                    <tr>

                        <td colspan="5" align="right">
                            <strong>GRAND TOTAL: </strong>
                        </td>
                        <td>$<strong class="gtotal"></strong></td>
                    </tr>
                    <tr><br>
                        <td colspan="6" align="right" cellspacing="0" cellpadding="0">
                            <?php if(!empty($_SESSION["shopping_cart"])) {
                                echo '<button id="btn-checkout">Continue with Cash on Deleivery</button>';
                                } ?> 
                            


                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Trigger/Open The Modal -->


            <!-- The Modal -->

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2>Invoice</h2>
                    </div>
                    <div class="modal-body">
                        <?php 
                        if(isset($_SESSION['user_name']) || isset($_SESSION['user_lname']) ||   isset($_SESSION['user_email']) || isset($_SESSION['user_address'])){
                            $username= $_SESSION['user_name'];
                
                            echo '<br><div class="username"><h4 style="display:inline-block;">Customer Name:</h4>      '.$username .' '.$_SESSION['user_lname'].'</div>
                            <div class="useraddress"><h4 style="display:inline-block;">Customer Email:</h4>      '.$_SESSION["user_email"].'</div>
                            <div class="useraddress"><h4 style="display:inline-block;">Customer Adress:</h4>      '.$_SESSION['user_address'].'<br></div>
                            
                            ';
                            
                          }
                        ?>

                        <table class="table" width="100%">
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Product Price</th>
                            </tr>
                            <?php if(isset($_SESSION["shopping_cart"])){
                            foreach ($_SESSION["shopping_cart"] as $key=>$value){
                           echo '<tr><td>'.$value['name'].'</td><td>'.$value['quantity'].'</td><td>'.$value['price'].'</td> </tr>';
                         } } ?>
                            <tr>

                                <td colspan="2" align="right"> 
                                    <strong>GRAND TOTAL: </strong>
                                </td>
                                <td>$<strong class="gtotal"></strong></td>
                            </tr>
                         
                        </table>
                        <form action="orders.php" method="POST"> <button name="confirmorder" id="btn-confirm">Confirm Order</button></form>
                    
                    </div>
                </div>

            </div>



        </div>

        <div style="clear:both;"></div>




        <br /><br />

    </div>

</body>

</html>