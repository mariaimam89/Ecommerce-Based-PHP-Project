<?php include_once('database.php');
$errorMsg=$successMsg="";
    if($_SERVER['REQUEST_METHOD']=="POST"){
         if(isset($_POST['signup']))
         {
            $f_name = $_POST["fname"];
            $l_name = $_POST["lname"];
            $email = $_POST['uemail'];
            $password = $_POST['upassword'];
            $address = $_POST['uaddress'];
            $number = preg_match('@[0-9]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
        
            $name = "/^[a-zA-Z ]+$/";
            $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
            if(empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($address)){
                $errorMsg="Please fill out all the fields!";

            }else
                if(!preg_match($name,$f_name)){
                    $errorMsg="Please Enter a valid First Name!";
                  
                }
                else if(!preg_match($name,$l_name)){
                    $errorMsg= "Please Enter a valid Last Name!";
                
                }
               else if(!preg_match($emailValidation,$email)){
                    $errorMsg= "Please Enter a valid email Address ";
                   
                }
                else if( $existres=$database->email_exist($email)){
                    $errorMsg="Email Already Exists!";
                }
              else  if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase) {
                    $errorMsg= "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, and one lower case letter.";
                } 
                //checking for existing email address in our database
                
                else{
                    $password=md5($password);
                    $insertuser=$database->insert_user($f_name,$l_name,$email,$password,$address);
                    if($insertuser){
                        $successMsg= "Your account has been created successfully! Now you can login into our system!";
                    }
                }
              
             
              
                 

            

        }
        }
 ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign up for Facebook | Facebook</title>
    <link rel="stylesheet" href="assests/css/new-signup-style.css">
    <link rel="stylesheet" href="assests/css/indexstyle.css">
    <link rel="stylesheet" href="assests/css/header-footer-style.css">
   
</head>

<body>

    <?php include('assests/header.php'); ?>
    <h1>Sign Up</h1>


        <!-- sign up form -->
        <div class="container">
        <div class="form-container">
            <div id="errormsg">
                <?php echo $errorMsg; ?>
            </div>
            <div id="successmsg">
                <?php echo $successMsg; ?>
            </div>
            <form action="" method="POST">
                <label for="fname">First Name</label>
                <input type="text" name="fname" placeholder="First Name">
                <label for="lname">Last Name</label>
                <input type="text" name="lname" placeholder="Last Name">
                <label for="fname">Email</label>
                <input type="text" name="uemail" placeholder="Email">
                <label for="upassword">Password</label>
                <input type="text" name="upassword" placeholder="Password">
                <label for="uaddress">Address</label>
                <input type="text" name="uaddress" placeholder="Address">

                <button type="submit" class="submit-btn" name="signup">Sign Up</button>
            </form>

        </div>

        </div>


</body>

</html>