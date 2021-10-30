<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
?>
<nav style="background: black;top:0px;">       
        <div style="background-color: black;height:70px;font-size: 30px;padding: 5px;top:0px;" class="topnav" id="myTopnav">
            <a href="index.php" style="padding: 10px 16px;float:left;font-weight: 900;font-family: 'Raleway', sans-serif;">
                <!-- <img style="width:50px;height:auto;" src="img/faw.png"> --> <h5 style="font-family: 'Prompt', sans-serif;font-size:30px;padding:5px;color:white;">SPACE STORE</h5>
            </a>
            <a style="height: 60px;"></a>  
            <a  href="admin/logout.php">Logout</a>          
            <a  href="cart.php">Cart</a>
            <a  href="product.php">Products</a>       
                     
            <a href="javascript:void(0);" style="padding:22px;" class="icon"  onclick="dk_open()">
            <div class="hamburger-menu">
                <div style="background: white;" class="line line1"></div>
                <div style="background: white;" class="line line2"></div>
                <div style="background: white;" class="line line3"></div>
            </div> 
            </a>
        
        </div>
    </nav>
    <!-- Sidebar on small screens when clicking the menu icon -->
    <nav class="sidebar animate-left" style="display:none" id="mySidebar">
        <a href="javascript:void(0)" onclick="dk_close()" style="padding-top: 30px;font-size: 20px;">Close x</a>
        <a  href="index.php" onclick="dk_close()">Home</a>      
        <a  href="admin/logout.php " onclick="dk_close()">Logout</a>
        <a  href="cart.php" onclick="dk_close()">Cart</a>
        <a  href="product.php" onclick="dk_close()">Products</a>
       
    </nav>
<?php
}
else{?>
    
<nav style="background: black;top:0px;">       
<div style="background-color: black;height:70px;font-size: 30px;padding: 5px;top:0px;" class="topnav" id="myTopnav">
    <a href="index.php" style="padding: 10px 16px;float:left;font-weight: 900;font-family: 'Raleway', sans-serif;">
        <!-- <img style="width:50px;height:auto;" src="img/faw.png"> --> <h5 style="font-family: 'Prompt', sans-serif;font-size:30px;padding:5px;color:white;">SPACE STORE</h5>
    </a>
    <a style="height: 60px;"></a>                                 
    <a  href="admin/login.php">login</a>   
    <a  href="admin/signup.php">signup</a>           
    <a  href="product.php">Products</a>                         
    <a href="javascript:void(0);" style="padding:22px;" class="icon"  onclick="dk_open()">
    <div class="hamburger-menu">
        <div style="background: white;" class="line line1"></div>
        <div style="background: white;" class="line line2"></div>
        <div style="background: white;" class="line line3"></div>
    </div> 
    </a>

</div>
</nav>
<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="sidebar animate-left" style="display:none" id="mySidebar">
<a href="javascript:void(0)" onclick="dk_close()" style="padding-top: 30px;font-size: 20px;">Close x</a>
<a  href="index.php" onclick="dk_close()">Home</a>      
<a  href="admin/login.php " onclick="dk_close()">Login</a>
<a  href="admin/signup.php" onclick="dk_close()">Signup</a>
<a  href="product.php" onclick="dk_close()">Products</a>

</nav>
<?php }
?>
