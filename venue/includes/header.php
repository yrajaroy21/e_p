<?php
include 'config.php';
$GLOBALS['UserID']  = "";

if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){ 
    $GLOBALS['UserID'] = $_SESSION["uid"];
}

?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>EVENT PLANNER</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  </head>
  <style>
  .header-area {
    position: relative;
    background-color: #2e92c5 !important;
    height: 100px;
    z-index: 100;
    -webkit-transition: all .5s ease 0s;
    -moz-transition: all .5s ease 0s;
    -o-transition: all .5s ease 0s;
    transition: all .5s ease 0s;
}
</style>
<body>

<div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          
        </div>
        <div class="col-lg-4 col-md-4">
          <ul class="social-links">
            <li><a href="https://www.facebook.com/SIMATSSAVEETHA/"><i class="fab fa-facebook"></i></a></li>
            <li><a href="https://twitter.com/simats_univ?lang=en" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://in.linkedin.com/in/saveetha-institute-of-medical-and-technical-sciences-879287184"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="https://www.instagram.com/simatsengineering/"><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
</div>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>EVENTPLANNER</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="login.php">Home</a></li>
                      <li><a href="your_events.php">Your Events</a></li>
                    
                      <?php
                          if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){ 
                           
                              // echo '<li><a href="profile.php">Welcome, '.$_SESSION["username"].'</a></li>';
                              echo '<li><a href="profile.php"><i class="fa fa-user"></i> Welcome, '.$_SESSION["username"].'</a></li>';
                              // echo '<li><a href="logout.php">Logout</a></li>';
                              echo '<li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>';


                          }else{
                            echo '<li><a href="login.php"><i class="fa fa-user"></i> Login </a></li>';
                          } 
                      ?>
                       
                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->