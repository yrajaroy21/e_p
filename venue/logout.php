<?php
session_start();
unset($_SESSION["logged_in"]); 
unset($_SESSION["uid"]); 
unset($_SESSION["username"]); 
unset($_SESSION["useremail"]); 
unset($_SESSION["usertype"]); 


// session_unset();
// session_destroy();
header('location:index.php');
?>