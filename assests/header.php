<?php
echo '<header>
<nav id="navbar">
 <div id="logo">
     <img src="assests/imgs/shoplogo3.png" width="100px" height="80px" alt="MyOnlineShop.com">
     <a href="#">ShopOnline.com</a>
 </div>
 <ul>
 
     <li class="item topnav"><input  id="searchbar" type="text" name="search-query" id="search"  placeholder="Search...">
     <button id="search-btn">Search</button>
     <script src="assests/js/main.js"></script>
     </li>
     <li class="item" class="active"><a href="index.php">Home</a></li>
     

 
     <li class="item"><a href="cart.php">Cart<span>('; if(!empty($_SESSION["shopping_cart"])) {
         $cart_count = count(array_keys($_SESSION["shopping_cart"])); echo $cart_count; 
        }   
         echo ')</span></a>
         </li>';


if(isset($_SESSION['user_name'])){
  $username= $_SESSION['user_name'];
  echo '<li class="item"><a href="logout.php">Logout</a></li>';
   echo '<li class="item"><a href="#">Welcome '.$username.'</a></li>';
  
}else{
  echo'<li class="item"><a href="login.php">Login</a></li>';
  echo'<li class="item"><a href="signup.php">Signup</a></li>';
}

     
     
 echo '</ul></nav> 
</header>';
?>