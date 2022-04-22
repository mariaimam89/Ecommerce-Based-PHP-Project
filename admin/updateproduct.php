<?php include('admin-database.php'); 
$showError=$pid=$p_brand=$p_category="";
if(isset($_GET['pid'])){
  $pid=$_GET['pid'];
}
//fetch product from db
$fetch_pro=$admin_database->read_sel_pro($pid);
$row=mysqli_fetch_assoc($fetch_pro);
//check if update product is set
if (isset($_POST['updateproduct'])) {
  $p_name=$_POST['productname'];
  $p_desc=$_POST['productdesc'];
  $p_price=$_POST['productprice'];
 $p_quantity=$_POST['pquantity'];
 $file=$_FILES['image'];
 $p_category=$_POST['pcategory'];
  $p_brand=$_POST['pbrand'];
  if (!empty($p_name) && !empty( $p_desc) && !empty($p_price)&& !empty( $p_quantity)) {
    if (isset($_FILES['image']['name']) 
    && !empty($_FILES['image']['name'])) {
    $result =              
    $update_pro=$admin_database->update_prdouct($p_name,
    $p_category,
    $p_brand,
    $p_desc,
    $p_price,
    $file,
    $p_quantity, $pid
    );
  }else{
    $result =$admin_database->update_prdouct_withoutimg($p_name,
    $p_category,
    $p_brand,
    $p_desc,
    $p_price,
    $p_quantity, $pid);
  }
    if($result){
      $updatemsg="One product has been updated successfully!";
      header('location:admin-panel.php?updatemsg='.$updatemsg);
    }

  }
  
  
  
  else{
    $showError="Please fill out all the fields!";
  }


}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add a Product | Shoponline.com</title>
    <link rel="stylesheet" href="assests/css/indexstyle.css">
    <link rel="stylesheet" href="assests/css/header-footer-style.css">
    <link rel="stylesheet" href="assests/css/insertproduct-style.css">
</head>

<body>
    <?php include('assests/header.php'); ?>
    <h1>Update Product</h1>

    <div class="container">

        <!-- insert product form -->

        <div class="form-container">
            <div id="errormsg">
                <?php  echo $showError; echo $admin_database->showError; ?>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="pname">Product Name</label>
                <input type="text" c="pname" name="productname" placeholder="Product Name" value="<?php echo $row['product_name']; ?>">
                <label for="pname">Product Description</label><br>
                <textarea name="productdesc" rows="5" cols="55" value="<?php echo $row['product_description']; ?>"><?php echo $row['product_description']; ?></textarea><br>
                <label for="pname">Product Price</label>
                <input type="text" id="pprice" name="productprice" placeholder="Product Price" value="<?php echo $row['product_price']; ?>">

                <label for="pquantity">Product Quantity</label>
                <input type="text" id="pquantity" name="pquantity" placeholder="Product Quantity" value="<?php echo $row['product_quantity']; ?>">

                <label for="fileimg">Product Image <small>Format: jpeg, png, jpg</small></label>
                <input type="file" name="image" id="fileimg">
                <input type="hidden" name="oldimg" value="<?php echo $row['product_img']; ?>" >
                <img src="../product-imgs/<?php echo $row['product_image']; ?>" alt="" width="100px" height="100px">

                <label for="category">Product Category</label>
                <select id="category" name="pcategory">

                    <?php   
      $cat=$admin_database->read_categories();
      while($r=mysqli_fetch_assoc($cat)){
 ?>

                    <option value="<?php echo $r['category_id'];?>"  <?php if($r['category_id'] == $p_category){ echo "selected";} ?>><?php echo $r['category_name'] ?></option>

                    <?php } ?>
                </select>

                <label for="brand">Product Brand</label>

                <select id="brand" name="pbrand">
                    <?php 
      $brand=$admin_database->read_brands();
      while($r=mysqli_fetch_assoc($brand)){
    ?>
                    <option value="<?php echo $r['brand_id']; ?>" <?php if($r['brand_id'] == $p_brand){ echo "selected";} ?>><?php echo $r['brand_name'] ?></option>
                    <?php } ?>
                </select>

                <button type="submit" class="submit-btn" name="updateproduct">Update  Product</button>
                
            </form>
            <button  class="submit-btn" name="goback"  onclick="window.location.href='admin-panel.php'"> Go Back</button>
        </div>



    </div>

</body>

</html>