<?php
include('admin-database.php');
$errorMsg="";
//fetchin products from data base 
if(isset($_POST["getProduct"])){ 
    $product_result=$admin_database->read_products();
    $output='<div class="addproduct"><a id="insert-btn" href="manageproduct.php">Click to Add a Product</a></div> <table>
    <tbody>
        <tr>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Product Image</th>
            <th>Product Category</th>
            <th>Product Brand
            </th>
            <th>Update Product
            </th>
            <th>Delete Product
            </th>
        </tr>';
    if(mysqli_num_rows($product_result)>0){
     while($product=mysqli_fetch_assoc($product_result)){
         $product_id=$product['product_id'];
   
         $product_name=$product['product_name'];
         $product_desc=$product['product_description'];
         $product_price=$product['product_price'];
         $product_image=$product['product_image'];
         $product_category=$product['category_name'];
         $product_brand=$product['brand_name'];
        $output.=
        ' <tr>
        <td>'.$product_name.'</td>
        <td>'. $product_desc.'</td>
        <td>'. $product_price.'</td>
        <td><img src="../product-imgs/'.$product_image.'" alt="product image" width="100px" height="100px"></td>
        <td>'.$product_category.'</td>
        <td>'.$product_brand.'</td>
        <td><a id="update-btn" href="updateproduct.php?pid='.$product_id.'">Update</a></td>
        <td><a id="remove-btn"  onClick="return confirm(\'Are you sure you want to delete?\')"
        href="delete.php?pid='.$product_id.'">Remove</a></td>

    </tr>';
    }
    $output.='</tbody></table>';
}

else{
    $errorMsg="No Products Found";
}
echo $output;
}

// fetching categories from data base
if(isset($_POST["getCategory"])){ 
    $cat_result=$admin_database->read_categories();
    $output='<div class="addproduct"><a id="insert-btn" href="managecategory.php">Click here to add a new Category</a></div> <table width="100%">
    <tbody>
        <tr>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>';
    if(mysqli_num_rows($cat_result)>0){
     while($cat=mysqli_fetch_assoc($cat_result)){
         $cat_id=$cat['category_id'];
         $cat_name=$cat['category_name'];
        $output.=
        ' <tr>
        <td>'.$cat_id.'</td>
        <td>'. $cat_name.'</td>
        <td><a id="remove-btn"  onClick="return confirm(\'Are you sure you want to delete?\')"
        href="delete.php?cid='.$cat_id.'">Remove</a></td>

    </tr>';
    }
    $output.='</tbody></table>';
}

else{
    $errorMsg="No Categories Found!";
}
echo $output;
}
//fetching brands from database

if(isset($_POST["getBrand"])){ 
    $b_result=$admin_database->read_brands();
    $output='<div class="addproduct"><a id="insert-btn" href="managebrand.php">Click here to add a new Brand</a></div> <table width="100%">
    <tbody>
        <tr>
            <th>Brand Id</th>
            <th>Brand Name</th>
            <th>Action</th>
        </tr>';
    if(mysqli_num_rows($b_result)>0){
     while($b=mysqli_fetch_assoc($b_result)){
         $b_id=$b['brand_id'];
         $b_name=$b['brand_name'];
        $output.=
        ' <tr>
        <td>'.$b_id.'</td>
        <td>'. $b_name.'</td>
        <td><a id="remove-btn"  onClick="return confirm(\'Are you sure you want to delete?\')"
        href="delete.php?bid='.$b_id.'">Remove</a></td>

    </tr>';
    }
    $output.='</tbody></table>';
}

else{
    $errorMsg="No Brands Found!";
}
echo $output;
}

//fetching orders info from Darabase
if(isset($_POST["getOrder"])){ 
    $o_result=$admin_database->read_users();
    $output='<table width="100%">
        <thead>
        <tr>
            <th>User Name</th>
            <th>User Email</th>
            <th>User Address</th>
            <th>Products</th>
        </tr>
        </thead><tbody>';
  
     while($o=mysqli_fetch_assoc($o_result)){
         $user_id=$o['user_id'];
         $user_name=$o['user_firstname'];
         $user_email=$o['user_email'];
         $user_address=$o['user_address'];
        $output.=
        '<tr>
        <td>'.$user_name.'</td>    
        <td>'.$user_email.'</td>
        <td>'.$user_address.'</td>
        <td>
        <table>
        <thead>
        <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        </tr>
        </thead>
        <tbody>';
        $id=$o['user_id'];
        $u_result=$admin_database->read_userorders($id);
        while($u=mysqli_fetch_assoc($u_result)){
            $pro_name=$u['item_name'];
            $pro_price=$u['item_price'];
            $pro_quantity=$u['quantity'];
            $output.='<tr>
            <td>'.$pro_name.'</td>
            <td>'.$pro_price.'</td>
            <td>'.$pro_quantity.'</td>
            </tr>';

        }
        $output.='</tbody>
        </table>
        
        
        </td>
       
    </tr>'
       ; }

    $output.='</tbody></table>';



echo $output;


}
