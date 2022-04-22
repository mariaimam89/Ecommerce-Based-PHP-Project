<?php include('admin-database.php'); 
$showError="";
$updatemsg="";
$pid=$p_category=$p_brand="";
if(isset($_GET['pid'])){
  $pid=$_GET['pid'];
}
//fetch product from db
$fetch_pro=$admin_database->read_sel_pro($pid);
$row=mysqli_fetch_assoc($fetch_pro);

if($_SERVER['REQUEST_METHOD']=="POST"){

  //insert product in DB
	if(isset($_POST['updateproduct'])){
    if(isset($_POST['productname'])){
      $p_name=$_POST['productname'];
    }else{
      $p_name="";
    }  if(isset($_POST['productdesc'])){
      $p_desc=$_POST['productdesc'];
    } else{
      $p_desc="";
    }
    if(isset($_POST['productprice'])){
      $p_price=$_POST['productprice'];
    }else{
      $p_price="";
    }
     if(isset($_POST['pquantity'])){
      $p_quantity=$_POST['pquantity'];
    }else{
      $p_quantity="";
    }
    if(isset($_FILES['image'])){
      $file=$_FILES['image'];
    }
    
    
    if(isset($_POST['pcategory'])){
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

 

    // if (!empty($p_name) || !empty( $p_desc) || !empty($p_price)|| !empty($p_quantity)|| !empty($file)|| !empty($p_category)|| !empty($p_brand)){
      $fileName = $file['name'];
      $filetmp=$file['tmp_name'];
  $fileNameAr= explode(".", $fileName);
  $extension = end($fileNameAr);
    
  $ext = strtolower($extension);
  // if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
  //         if ($file['size'] > (1024 * 2)) {
                  $uniqueimage=time().'_'.$fileName;
                  $destinationFile="product-imgs/".$uniqueimage;
                  move_uploaded_file($filetmp,$destinationFile);
              
  $update_pro=$admin_database->update_prdouct($p_name,
  $p_category,
  $p_brand,
  $p_desc,
  $p_price,
  $destinationFile,
  $p_quantity, $pid
  );
  if($update_pro){
    $updatemsg="One product has been updated successfully!";
  header('location:admin-panel.php?updatemsg='.$updatemsg);
  }
  else{
    echo mysqli_error($admin_database->conn);
  }
// }else{
//   $showError="Cannot Add product. Some Error Occured!";
// }
//  }
// else{
//   $showError="Inalid image size. Image must be less than 2MB!";
// }
//   }
// else{
// $showError="Invalid image format. Allowed format is (png, jpg, jpeg)!";
// }

  // }
  // else{
  //   $showError="Please fill out all the fields!";
  //     }
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
                <textarea name="productdesc" rows="5" cols="55" value="<?php echo $row['product_description']; ?>"></textarea><br>
                <label for="pname">Product Price</label>
                <input type="text" id="pprice" name="productprice" placeholder="Product Price" value="<?php echo $row['product_price']; ?>">

                <label for="pquantity">Product Quantity</label>
                <input type="text" id="pquantity" name="pquantity" placeholder="Product Quantity" value="<?php echo $row['product_quantity']; ?>">

                <label for="fileimg">Product Image <small>Format: jpeg, png, jpg</small></label>
                <input type="file" name="image" id="fileimg">
                <input type="hidden" name="oldimg" value="<?php echo $row['product_img']; ?>" >
                <img src="<?php echo $row['product_image']; ?>" alt="" width="100px" height="100px">

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