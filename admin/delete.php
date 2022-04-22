<?php 
include_once('admin-database.php');
$id=$cid=$pid="";
//delete products
if(isset($_GET['pid'])){
   $id=$_GET['pid'];
}

$res=$admin_database->delete_product($id);
if($res){
   
    $delmsg="One product has been deleted successfully!";
  
   header('location:admin-panel.php?msg='.$delmsg);
}
else{
   echo "Data cannot be deleted";
}
//Delete caregories
if(isset($_GET['cid'])){
   $cid=$_GET['cid'];
}
$delc_res=$admin_database->delete_category($cid);
if($delc_res){
   
   $delmsg="One Category has been deleted successfully!";
 
  header('location:admin-panel.php?msg='.$delmsg);
}
else{
  echo "Data cannot be deleted";
}
//Delete Brands
if(isset($_GET['bid'])){
   $bid=$_GET['bid'];
}
$delb_res=$admin_database->delete_brand($bid);
if($delb_res){
   
   $delmsg="One Brand has been deleted successfully!";
 
  header('location:admin-panel.php?msg='.$delmsg);
}
else{
  echo "Data cannot be deleted";
}
?>