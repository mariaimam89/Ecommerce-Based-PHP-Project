<?php
include('database.php');
$product_id=$_GET['productid'];
//fetch results
$result=$database->fetch_selected_pro($product_id);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assests/css/product-detail.css">
    <title>Product Detail</title>
</head>

<body>
    <div class="container">
        <div class="productimg">
            <img src="product-imgs/1645595938_laptop.jpeg" alt="">

        </div>
        <div class="product-details">
            <h1>Product Name</h1>
            <h3>Product Desc</h3>
            
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat, ipsam eveniet. Quibusdam deleniti quae perferendis dolore molestiae dolor unde deserunt!</p>
            <p><button type="submit" name="addtocart"  class="">Add to Cart</button></p>
        </div>
    </div>
</body>

</html>