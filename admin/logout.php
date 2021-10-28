<?php 
session_start();
session_destroy();
echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/index.php?signedout=true';</script>";
exit;
?>