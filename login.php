
<!-- user authentication -->
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
    $sql = "SELECT * from `users` WHERE user_email='$useremail'";
    $resultlogin = mysqli_query($conn, $sql);
    $enc_pass=md5($password);
    $num = mysqli_num_rows($resultlogin);
    if ($num>0){
        
     while($row=mysqli_fetch_assoc($resultlogin)){
                if($enc_pass==$row['user_password']){
                $login = true;
               
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id']=$row['user_id'];
                $_SESSION['user_name'] = $row['user_firstname'];
                $_SESSION['user_lname'] = $row['user_lastname'];
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_address'] = $row['user_address'];
                header('location:index.php');
                exit();
                }
                else{
                    $showError = "Invalid Credentials!"; 
                }
            
          
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
    <link rel="stylesheet" href="assests/css/newlogin-style.css">
    <link rel="stylesheet" href="assests/css/errorstyle.css">
    <link rel="stylesheet" href="assests/css/indexstyle.css">
    <link rel="stylesheet" href="assests/css/header-footer-style.css">

    <script src="login.js"></script>

</head>

<body>

<?php include('assests/header.php'); ?>
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
           
                <h1>Welcome to ShopOnline.com</h1>
          
            <div class="fb-form">
            <span id="existmsg"><?php echo $msg;
              ?></span>
                <form  action="login.php" method="post" name="loginForm">
                <span id="existmsg"><?php echo $showError;
              ?></span>
                <!-- <span id="insert"><?php echo  $fbuser1->insertmsg; ?> </span> -->
                    <input type="text" name="email-phone" id="email-phone" placeholder="Email adress or phone number" class="input-field" value="" />
              
                    <!-- <span id="existmsg"><?php echo  $fbuser1->existmsg; ?> </span><br>
                    <span id="existmsg"><?php echo  $emailError; ?> </span>
              -->


                    <input type="password" name="login-pass" id="login-pass" placeholder="Password" class="input-field" value="" />
                  
                    <!-- <span id="existmsg"><?php echo $passError ;?> </span> -->


                    <input type="submit" name="login" value="Login" class="login-btn" id="log-in" />



                    <a href="" id="password-anchor">Forgotten password?</a>
                    <hr>

                </form>
                <button type="submit"  class="signup-btn"  onclick="window.location.href='signup.php'">Create New Account</button>
            </div>

           
        </div>


    </div>





    <!-- Footer starts from here -->
    <div class="container">
   
    </div>

</body>


</html>