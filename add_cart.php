<?php
include 'partials/dbconnect.php' ;
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['sno'];
    $query = "INSERT INTO user_items(`id`,`user_id`, `item_id`, `status`) VALUES(NULL,'$user_id', '$item_id', 'Added to cart')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/cart.php?addedtocart=true';</script>";
    exit;
}
?>   