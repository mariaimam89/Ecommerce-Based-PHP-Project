<?php


include('database.php');
$errorMsg="";


//fetchin products from data base 
if(isset($_POST["getProduct"])){

    $product_result=$database->read_products();


if(mysqli_num_rows($product_result)>0){
    while($product=mysqli_fetch_assoc($product_result)){
        $product_id=$product['product_id'];
        $product_cat_id=$product['product_cat_id'];
        $product_name=$product['product_name'];
        $product_desc=$product['product_description'];
        $product_price=$product['product_price'];
        $product_image=$product['product_image'];
        $product_quantity=$product['product_quantity'];
        echo
        '<form method ="post" action="index.php"><div class="card">
  
        <img src="product-imgs/'.$product_image.'" alt="'.$product_name.'" id="product_img" style="height:200px; width:200px;"><br>
 
        
        <h3 class="pname"><a href=#>'.$product_name.'</a></h3>
        <p class="price">$'.$product_price.'</p>
        <p>'.$product_desc.'</p><br>
        <h4 style="display:inline-block">Quantity: </h4><input style="text-align:center; height:20px; width:70%;" name="changequantity" type="number"  min="1" max="'.$product_quantity.'" class="pquantity"/>
        <p><button type="submit" name="addtocart"  class="">Add to Cart</button></p>
        <input type="hidden"  name="productid" value="'.$product_id.'" >
        <input type="hidden"  name="productname" value="'. $product_name.'" >
        <input type="hidden"  name="productprice" value="'. $product_price.'" >
        <input type="hidden"  name="productimage" value="'. $product_image.'" >

      </div>
      </form>';
    }

}
else{
    $status="No Products Found";
}
}

// fetching products of certain category from database
if(isset($_POST["getSelectedProduct"])){
    $catid=$_POST['cat_id'];
    $result=$database->read_selected_products($catid);
    while($product=mysqli_fetch_assoc($result)){
        $product_id=$product['product_id'];
        $product_cat_id=$product['product_cat_id'];
        $product_name=$product['product_name'];
        $product_desc=$product['product_description'];
        $product_price=$product['product_price'];
        $product_image=$product['product_image'];
        $product_quantity=$product['product_quantity'];
        echo
        '<form method ="post" action="index.php"><div class="card">
        <img src="#" id="product_img" style="height:200px; width:200px;">
        <h3 class="pname"><a href="product-detail.php?productid='.$product_id.'">'.$product_name.'</a></h3>
        <p class="price">$'.$product_price.'</p>
        <p>'.$product_desc.'</p><br>
        <h4 style="display:inline-block">Quantity: </h4><input style="text-align:center; height:20px; width:70%;" name="changequantity" type="number"  min="1" max="'.$product_quantity.'" class="pquantity"/>
        
        <p><button type="submit" name="addtocart"  class="">Add to Cart</button></p>
        <input type="hidden"  name="productid" value="'.$product_id.'" >
        <input type="hidden"  name="productname" value="'. $product_name.'" >
        <input type="hidden"  name="productprice" value="'. $product_price.'" >
        <input type="hidden"  name="productimage" value="'. $product_image.'" >
      </div></form>'
        ;
    }

}

// fetching products of certain Brand from database
if(isset($_POST["getSelectedBrand"])){
    $bid=$_POST['b_id'];
    $result=$database->read_selected_brands($bid);
    while($brand=mysqli_fetch_assoc($result)){
        $product_id=$brand['product_id'];
        $product_cat_id=$brand['product_cat_id'];
        $product_name=$brand['product_name'];
        $product_desc=$brand['product_description'];
        $product_price=$brand['product_price'];
        $product_image=$brand['product_image'];
        $product_quantity=$brand['product_quantity'];
        echo
        '<form method ="post" action="index.php"><div class="card">
        <img src="product-imgs/'.$product_image.'" alt="'.$product_name.'" id="product_img" style="height:200px; width:200px;">
        <h3 class="pname"><a href="#">'.$product_name.'</a></h3>
        <p class="price">$'.$product_price.'</p>
        <p>'.$product_desc.'</p><br>
        <h4 style="display:inline-block">Quantity: </h4><input style="text-align:center; height:20px; width:70%;" name="changequantity" type="number"  min="1" max="'.$product_quantity.'" class="pquantity"/>
        <p><button type="submit" name="addtocart"  class="">Add to Cart</button></p>
        <input type="hidden"  name="productid" value="'.$product_id.'" >
        <input type="hidden"  name="productname" value="'. $product_name.'" >
        <input type="hidden"  name="productprice" value="'. $product_price.'" >
        <input type="hidden"  name="productimage" value="'. $product_image.'" >
      </div></form>'
        ;
    }

}
if(isset($_POST["getSearchResult"])){
    $keyword=$_POST['keyword'];
    $searchRes=$database->search_products($keyword);
    while($search=mysqli_fetch_assoc($searchRes)){
        $product_id=$search['product_id'];
        $product_cat_id=$search['product_cat_id'];
        $product_name=$search['product_name'];
        $product_desc=$search['product_description'];
        $product_price=$search['product_price'];
        $product_image=$search['product_image'];
        $product_quantity=$search['product_quantity'];
        echo
        '<form method ="post" action="index.php"><div class="card">
        <img src="product-imgs/'.$product_image.'" alt="'.$product_name.'" id="product_img" style="height:200px; width:200px;">
        <h3 class="pname"><a href="#">'.$product_name.'</a></h3>
        <p class="price">$'.$product_price.'</p>
        <p>'.$product_desc.'</p><br>
        <h4 style="display:inline-block">Quantity: </h4><input style="text-align:center; height:20px; width:70%;" name="changequantity" type="number"  min="1" max="'.$product_quantity.'" class="pquantity"/>
        <p><button type="submit" name="addtocart"  class="">Add to Cart</button></p>
        <input type="hidden"  name="productid" value="'.$product_id.'" >
        <input type="hidden"  name="productname" value="'. $product_name.'" >
        <input type="hidden"  name="productprice" value="'. $product_price.'" >
        <input type="hidden"  name="productimage" value="'. $product_image.'" >
      </div></form>'
        ;
    }



}

