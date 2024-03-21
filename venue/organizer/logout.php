<?php
session_start();
unset($_SESSION["organizer_logged_in"]); 
unset($_SESSION["qid"]); 
unset($_SESSION["organizername"]); 
unset($_SESSION["organizeremail"]); 
unset($_SESSION["usertype"]); 


// session_unset();
// session_destroy();
header('location:index.php');
?>