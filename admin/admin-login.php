
<!-- admin authentication -->
<?php 
session_start();

$msg="";
if(isset($_GET['msg'])){
    $msg= $_GET['msg'];
}
$login= false;
$showError="";
if(isset($_POST["login"])){
    include('assests/databasetest.php');
    $useremail = $_POST["email-phone"];
    $password = $_POST["login-pass"];
    if(!empty($useremail)&&!empty($password)){
    $sql = "SELECT * from `admin` WHERE admin_email='$useremail' AND admin_password='$password'";
    $resultlogin = mysqli_query($conn, $sql);
    // $enc_pass=md5($password);
    $num = mysqli_num_rows($resultlogin);
    if ($num>0){
        
     while($row=mysqli_fetch_assoc($resultlogin)){
                // if($enc_pass==$row['user_password']){
                $login = true;
               
                $_SESSION['adminlogged_in'] = true;
                header('location:admin-panel.php');
                exit();
                // }
                // else{
                //     $showError = "Invalid Credentials!"; 
                // }
            
          
        }
    } 
    
    else{
        $showError = "Invalid Credentials!";
    }
    }
    else{
        $showError = "Please fill out all the fields!"; 
    }

}
?>
<!-- ........................html starts from here....................... -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ShopOnline.com </title>
    <link rel="icon" type="image/x-icon" href="imgs/fb_icon_325x325.png">
    <link rel="stylesheet" href="assests/css/login-style.css">
    <link rel="stylesheet" href="assests/css/errorstyle.css">
<link rel="stylesheet" href="assests/css/header-footer-style.css">

</head>

<body>


    <!-- First section contain content starts from here -->
    <div class="flex-container">
      
        <!-- second section contains form start from here -->
        <div class="flex-child">
           
            <!-- <div class="logo-img">
                <img src="assests/imgs/shoplogo3.png" style="height:200px; width:200px;" alt="fb-logo">
            </div>
            <div class="heading-text">
                <p>Welcome to ShopOnline.com</p>
            </div> -->
           
                <h1>Welcome to Admin Panel of ShopOnline.com</h1>
          
            <div class="fb-form">
            <span id="existmsg"><?php echo $msg;
              ?></span>
                <form  action="admin-login.php" method="post" name="loginForm">
                <span id="existmsg"><?php echo $showError;
              ?></span>
                <!-- <span id="insert"><?php echo  $fbuser1->insertmsg; ?> </span> -->
                    <input type="text" name="email-phone" id="email-phone" placeholder="Admin Email" class="input-field" value="" />
              
                    <!-- <span id="existmsg"><?php echo  $fbuser1->existmsg; ?> </span><br>
                    <span id="existmsg"><?php echo  $emailError; ?> </span>
              -->


                    <input type="password" name="login-pass" id="login-pass" placeholder="Password" class="input-field" value="" />
                  
                    <!-- <span id="existmsg"><?php echo $passError ;?> </span> -->


                    <input type="submit" name="login" value="Login" class="login-btn" id="log-in" />



                  
                    <hr>

                </form>
              
            </div>

           
        </div>


    </div>





    <!-- Footer starts from here -->

   <!-- <?php include('assests/footer.php'); ?> -->


</body>


</html>