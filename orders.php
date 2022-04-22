<?php 
include('database.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['confirmorder'])){
        if(isset($_SESSION['user_id'])){
            $userid=$_SESSION['user_id'];
        }
        if(isset($_SESSION['shopping_cart'])){
            foreach ($_SESSION["shopping_cart"] as $key=>$value){
                $itemname=$value['name'];
                $itemprice=$value['price'];
                $itemquantity=$value['quantity'];
                $insertorder=$database->insert_order($itemname,$itemprice,$itemquantity,$userid);
            
            }
            unset($_SESSION['shopping_cart']);
            $msg= "Your Order have been placed successfully.It will be delivered to you shortly!";
            header('location:index.php?msg='.$msg);
        }
 
    }
}

?>