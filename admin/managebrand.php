<?php include('admin-database.php'); 
$showError="";
$c_name="";

if($_SERVER['REQUEST_METHOD']=="POST"){

  //insert product in DB
	if(isset($_POST['insertbrd'])){
    if(isset($_POST['bname'])){
      $b_name=$_POST['bname'];
    }  
    if (!empty($b_name)){
      
              
  $add_bnd=$admin_database->insert_brand($b_name);

  if($add_bnd){
    $msg= "The brand has been added successfully!";
    header('location:admin-panel.php?msg='.$msg);



  }
  else{
    echo mysqli_error($admin_database->conn);
  }
}
  else{
    $showError="Please fill out the brand field!";
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
    <h1>Add a Brand</h1>

    <div class="container" style="height:350px;">

        <!-- insert product form -->

        <div class="form-container" >
            <div id="errormsg">
                <?php  echo $showError;
                 echo $admin_database->showError; ?>
            </div>
            <form action="managebrand.php" method="POST">
                <label for="pname">Brand Name</label>
                <input type="text"  name="bname" placeholder="Brand Name">
                
                <button type="submit" class="submit-btn" name="insertbrd">Add brand</button> 
            </form>
            <button  class="submit-btn" name="goback"  onclick="window.location.href='admin-panel.php'"> Go Back</button>
        </div>



    </div>

</body>

</html>