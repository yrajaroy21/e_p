<?php
session_start();
unset($_SESSION["admin_logged_in"]); 
unset($_SESSION["aid"]); 
unset($_SESSION["adminname"]); 
unset($_SESSION["adminemail"]); 
unset($_SESSION["usertype"]); 



// session_unset();
// session_destroy();
header('location:index.php');
?>