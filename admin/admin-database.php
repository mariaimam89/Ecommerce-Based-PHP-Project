<?php
session_start();

class adminDatabase{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "shoponline";
    public $conn="";
    public $showError="";
   
   

    //construct to initialize db connection
    function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        // echo "successfully connected";
        if (!$this->conn) {
            die("sorry we failed to connect" . mysqli_connect_error());
        }
    }
    //function to fetch all Products from data base
    public function read_products(){
        $products="SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.product_image, products.product_quantity, categories.category_name, brand.brand_name FROM products 
        JOIN categories ON products.product_cat_id = categories.category_id 
        JOIN brand ON products.product_brand_id = brand.brand_id";
        $pro_result=mysqli_query($this->conn, $products);
        return $pro_result;
    }
       //function to fetch all Products from data base
       public function read_brands(){
        $brands="SELECT * FROM `brand`";
        $b_result=mysqli_query($this->conn, $brands);
        return $b_result;
    }
       //function to fetch all Products from data base
       public function read_categories(){
        $categories="SELECT * FROM `categories`";
        $c_result=mysqli_query($this->conn, $categories);
        return $c_result;
    }
//function to delete category
    public function delete_category($id){
        $delSql="DELETE FROM `categories` WHERE category_id =$id ";
        $res=mysqli_query($this->conn, $delSql);
        return $res;
    }
    //function to delete brand
    public function delete_brand($id){
        $delSql="DELETE FROM `brand` WHERE brand_id =$id ";
        $res=mysqli_query($this->conn, $delSql);
        return $res;
    }
    //function to delete products
    public function delete_product($id){
        $delSql="DELETE FROM `products` WHERE product_id =$id ";
        $res=mysqli_query($this->conn, $delSql);
        return $res;
    }
    //function to insert products in DB
    public function insert_prdouct($product_name,
    $category_id,
    $brand_id,
    $product_desc,
    $product_price,
    $file,
    $product_qty
 ){
    if (!empty($product_name) && !empty($product_desc)&& !empty($product_price)&& !empty($file)&& !empty($product_qty)){
        $sql="INSERT INTO `products` (`product_name`, `product_cat_id`, `product_brand_id`, `product_description`, `product_price`, `product_image`, `product_quantity`) VALUES ('$product_name', '$category_id', '$brand_id', '$product_desc', '$product_price', '$file', '$product_qty')";
           $result=mysqli_query($this->conn,$sql);
            return $result;    
                }else{
                    $this->showError="Please fill out all the fileds!";
                }
  }  
            // function to insert category 
            public function insert_category($c_name){
                $insert_cat="INSERT INTO `categories` (`category_name`, `created_at`) VALUES ('$c_name', current_timestamp())";
                $result=mysqli_query($this->conn,$insert_cat);
                if($result){
                    return true;
               }else{
                    return false;
               }   
                
            }
             // function to insert brand
             public function insert_brand($b_name){
                $insert_brd="INSERT INTO `brand` (`brand_name`) VALUES ('$b_name')";
                $result=mysqli_query($this->conn,$insert_brd);
                if($result){
                    return true;
               }else{
                    return false;
               }   
                
            }
           
    // Function to read selected product    
    public function read_sel_pro($id){
        $sel_pro="SELECT products.product_id, products.product_name, products.product_description, products.product_price, products.product_image, products.product_quantity, categories.category_name, brand.brand_name FROM products
        JOIN categories ON products.product_cat_id = categories.category_id 
        JOIN brand ON products.product_brand_id = brand.brand_id WHERE product_id = $id";
          $pro_res=mysqli_query($this->conn, $sel_pro);
          return $pro_res;

          
    }
//Update Product Function
    public function update_prdouct($p_name,
  $p_category,
  $p_brand,
  $p_desc,
  $p_price,
  $file,
  $p_quantity, 
  $id
  ){
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
                $update_pro="UPDATE `products` SET `product_name` = '$p_name', `product_cat_id` = '$p_category', `product_brand_id` = '$p_brand', `product_description` = '$p_desc', `product_price` = '$p_price', `product_image` = '$uniqueimage', `product_quantity` = ' $p_quantity' WHERE `products`.`product_id` = $id";
                $result=mysqli_query($this->conn,$update_pro);
                return $result;
           }

        
        
        
        }

          else{
            $this->showError="Inalid image size. Image must be less than 2MB!";
          }
        }
        else{
            $this->showError="Invalid image format. Allowed format is (png, jpg, jpeg)!";
        }    
 
    }
    //Update product without image

    function update_prdouct_withoutimg($p_name,$p_category,$p_brand,$p_desc,$p_price,$p_quantity, $id){
        $update_pro="UPDATE `products` SET `product_name` = '$p_name', `product_cat_id` = '$p_category', `product_brand_id` = '$p_brand', `product_description` = '$p_desc', `product_price` = '$p_price', `product_quantity` = ' $p_quantity' WHERE `products`.`product_id` = $id";
        $result=mysqli_query($this->conn,$update_pro);
       return $result; 
    }
    
   //function to fetch orders from DB
       public function read_orders()  {
           $query="SELECT userorders.order_id, userorders.item_name, userorders.item_price, userorders.quantity, 
           users.user_firstname, users.user_email, users.user_address 
           FROM userorders JOIN users ON userorders.user_id=users.user_id";
           $orders=mysqli_query($this->conn, $query);
           return $orders;
       }   
         //function to fetch all users from DB
         public function read_users()  {
            $query="SELECT * FROM `users`";
            $orders=mysqli_query($this->conn, $query);
            return $orders;
        }   
        
          //function to fetch all userorders from DB
          public function read_userorders($id)  {
            $query="SELECT * FROM `userorders` where user_id = $id";
            $orders=mysqli_query($this->conn, $query);
            return $orders;
        } 
               
            
            
       
    
  
}//class ends here

//object creation of class
$admin_database=new adminDatabase();
?>