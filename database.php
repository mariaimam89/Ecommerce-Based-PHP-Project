
<?php
session_start();
class database{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "shoponline";
    private $conn="";
   
   

    //construct to initialize db connection
    function __construct()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        // echo "successfully connected";
        if (!$this->conn) {
            die("sorry we failed to connect" . mysqli_connect_error());
        }
    }
    //function to fetch all categories from data base
    public function read_categories(){
        $cat="SELECT * FROM categories";
        $cat_result=mysqli_query($this->conn, $cat);
        return $cat_result;
    }
      //function to fetch all brands from data base
      public function read_brands(){
        $brand="SELECT * FROM brand";
        $brand_result=mysqli_query($this->conn, $brand);
        return $brand_result;
    }
     //function to fetch all products from data base
     public function read_products(){ 
   
    
      $sql= "SELECT * FROM products";
        $product_result=mysqli_query($this->conn, $sql);
        return $product_result;
    }
    //function to fetch total records
    public function total_products(){
        $products="SELECT * FROM products";
        $product_result=mysqli_query($this->conn, $products);
       $total=mysqli_num_rows($product_result);
       return $total;
    }

     //function to fetch selected categories from data base
    public function read_selected_products($catid){
        $productSel="SELECT * FROM products where product_cat_id= '$catid'";
        $pro_result=mysqli_query($this->conn, $productSel);
        return $pro_result;
    }
     //function to fetch selected brands from data base
    public function read_selected_brands($bid){
        $productSel="SELECT * FROM products where product_brand_id= '$bid'";
        $pro_result=mysqli_query($this->conn, $productSel);
        return $pro_result;
    }
    //function to fetch selected products
    public function fetch_selected_pro($pid){
        $selected_pro="SELECT * FROM products where product_id= '$pid'";
        $fetch_result=mysqli_query($this->conn, $selected_pro);
        return $fetch_result;
    }
    //function to INSERT orders in database
    public function insert_order($itemname,$itemprice,$itemquantity,$userid){
       $insertsql="INSERT INTO `userorders` (`item_name`, `item_price`, `quantity`, `user_id`) VALUES ( '$itemname', '$itemprice', '$itemquantity', '$userid')";
       $insert_result=mysqli_query($this->conn, $insertsql);
       return $insert_result;
    }
    //function to check useremail alreday exists or not
    function email_exist($email){
        $existSql = "SELECT * FROM `users` WHERE user_email = '$email'";
        $result = mysqli_query($this->conn, $existSql);
        $num=mysqli_num_rows($result);
        if($num>0){
            return true;
        }
        else{
            return false;
        }

    }
    //Function to insert user
    function insert_user($f_name,$l_name,$email,$password,$address){
        $sql="INSERT INTO `users` (`user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_address`) VALUES ('$f_name', '$l_name', '$email', '$password', '$address')";
        $insert_user=mysqli_query($this->conn, $sql);
        return $insert_user;
    }
    //function for search
    function search_products($keyword){
        $serach_sql="SELECT * FROM products where product_name LIKE '%$keyword%'";
        $res=mysqli_query($this->conn, $serach_sql);
        return $res;
    }
  
}//class ends here

//object creation of class
$database=new database();
?>