<?php

echo '<header>
<nav id="navbar">
 <div id="logo">
     <img src="assests/imgs/shoplogo3.png" width="100px" height="80px" alt="MyOnlineShop.com">
     <a href="#">ShopOnline.com</a>
 </div>
 <ul>';
 if(isset($_SESSION['admin_loggedin']) || ($_SESSION['adminlogged_in']==true)){
    echo '<li class="item"><a href="admin-logout.php">Log Out</a></li>
    <li class="item"><a href="admin-panel.php">Welcome Admin</a></li>
    
    ';
 }
echo' </ul></nav> 
</header>';
?>