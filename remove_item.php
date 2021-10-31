<?php
require("partials/dbconnect.php");
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET["id"]; 
    $user_id = $_SESSION['sno'];
    
    // Delete the rows from user_items table where item_id and user_id equal to the item_id and user_id we got from the cart page and session
    $query = "DELETE FROM `user_items` WHERE `item_id`='$item_id' AND `user_id`='$user_id' AND `status`='Added to cart' ";
    $res = mysqli_query($conn, $query);
    header("location:cart.php");
}
?>