<?php include('admin-database.php'); 
$showError="";
$file="";
if($_SERVER['REQUEST_METHOD']=="POST"){

  //insert product in DB
	if(isset($_POST['insertproduct'])){
    if(isset($_POST['productname'])){
      $p_name=$_POST['productname'];
    }  if(isset($_POST['productdesc'])){
      $p_desc=$_POST['productdesc'];
    } if(isset($_POST['productprice'])){
      $p_price=$_POST['productprice'];
    } if(isset($_POST['pquantity'])){
      $p_quantity=$_POST['pquantity'];
    }
    if(isset($_FILES['image'])){
      $file=$_FILES['image'];
    } if(isset($_POST['pcategory'])){
      $p_category=$_POST['pcategory'];
    }
    else{
      $p_category="";
    }
    if(isset($_POST['pbrand'])){
      $p_brand=$_POST['pbrand'];
    }else{
      $p_brand="";
    }

 

    
      $fileName = $file['name'];
      $filetmp=$file['tmp_name'];
  $fileNameAr= explode(".", $fileName);
  $extension = end($fileNameAr);
    
  $ext = strtolower($extension);
  if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
          if ($file['size'] > (1024 * 2)) {
                  $uniqueimage=time().'_'.$fileName;
                  $destinationFile="C:/xampp/htdocs/Ecommerce-Website/product-imgs/".$uniqueimage;
                  if(move_uploaded_file($filetmp,$destinationFile)){
              
  $add_pro=$admin_database->insert_prdouct($p_name,
  $p_category,
  $p_brand,
  $p_desc,
  $p_price,
  $uniqueimage,
  $p_quantity
  );
  if($add_pro){
    $msg= "The Product has been added successfully!";
    header('location:admin-panel.php?msg='.$msg);
  }
  else{
    echo mysqli_error($admin_database->conn);
  }
}else{
  $showError="Cannot Add product. It is not uploaded!";
}
 }
else{
  $showError="Inalid image size. Image must be less than 2MB!";
}
  }
else{
$showError="Invalid image format. Allowed format is (png, jpg, jpeg)!";
}

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
    <h1>Add a Product</h1>

    <div class="container">

        <!-- insert product form -->

        <div class="form-container">
            <div id="errormsg">
                <?php  echo $showError;
                 echo $admin_database->showError; ?>
            </div>
            <form action="manageproduct.php" method="POST" enctype="multipart/form-data">
                <label for="pname">Product Name</label>
                <input type="text" c="pname" name="productname" placeholder="Product Name">
                <label for="pname">Product Description</label><br>
                <textarea name="productdesc" rows="5" cols="55"></textarea><br>
                <label for="pname">Product Price</label>
                <input type="text" id="pprice" name="productprice" placeholder="Product Price">

                <label for="pquantity">Product Quantity</label>
                <input type="text" id="pquantity" name="pquantity" placeholder="Product Quantity">

                <label for="fileimg">Product Image <small>Format: jpeg, png, jpg</small></label>
                <input type="file" name="image" id="fileimg">

                <label for="category">Product Category</label>
                <select id="category" name="pcategory">

                    <?php   
      $cat=$admin_database->read_categories();
      while($r=mysqli_fetch_assoc($cat)){
 ?>

                    <option value="<?php echo $r['category_id'];?>"><?php echo $r['category_name'] ?></option>

                    <?php } ?>
                </select>

                <label for="brand">Product Brand</label>

                <select id="brand" name="pbrand">
                    <?php 
      $brand=$admin_database->read_brands();
      while($r=mysqli_fetch_assoc($brand)){
    ?>
                    <option value="<?php echo $r['brand_id']; ?>"><?php echo $r['brand_name'] ?></option>
                    <?php } ?>
                </select>

                <button type="submit" class="submit-btn" name="insertproduct">Add Product</button>
            </form>
        </div>



    </div>

</body>

</html>