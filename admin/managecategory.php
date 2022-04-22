<?php include('admin-database.php'); 
$showError="";
$c_name="";

if($_SERVER['REQUEST_METHOD']=="POST"){

  //insert product in DB
	if(isset($_POST['insertcat'])){
    if(isset($_POST['cname'])){
      $c_name=$_POST['cname'];
    }  
    if (!empty($c_name)){
      
              
  $add_cat=$admin_database->insert_category($c_name);

  if($add_cat){
    $msg= "The Category has been added successfully!";
    header('location:admin-panel.php?msg='.$msg);
  }
  else{
    echo mysqli_error($admin_database->conn);
  }
}
  else{
    $showError="Please fill out the category field!";
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
    <h1>Add a Category</h1>

    <div class="container" style="height:350px;">

        <!-- insert product form -->

        <div class="form-container" >
            <div id="errormsg">
                <?php  echo $showError;
                 echo $admin_database->showError; ?>
            </div>
            <form action="managecategory.php" method="POST">
                <label for="pname">Category Name</label>
                <input type="text"  name="cname" placeholder="Category Name">
                
                <button type="submit" class="submit-btn" name="insertcat">Add Category</button> 
            </form>
            <button  class="submit-btn" name="goback"  onclick="window.location.href='admin-panel.php'"> Go Back</button>
        </div>



    </div>

</body>

</html>