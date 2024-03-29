<?php
include '../includes/config.php';

if(!isset($_SESSION["admin_logged_in"])){ 
  header('location:login.php');
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link href="../assets/packages/datatables.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.css" />
  </head>
  <style>
  /* Existing styles... */

  /* CSS for hover effect on the navigation links */
  .nav li a {
    color: #000; /* Default color for the links */
    transition: color 0.3s; /* Smooth transition */
  }

  .nav li a:hover {
    color: #9B59B6; /* Vivid Purple color on hover */
  }
  .header-area {
    position: relative;
    background-color: #fff !important;
    height: 90px;
    z-index: 100;
    -webkit-transition: all .5s ease 0s;
    -moz-transition: all .5s ease 0s;
    -o-transition: all .5s ease 0s;
    transition: all .5s ease 0s;
}
</style>


<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h5 style="margin-top:25%">EVENTPLANNER</h5>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="request.php">Request</a></li>
                      <li><a href="organizers.php">Organizers</a></li>
                      <li><a href="index.php#addVenue">Add Venue</a></li>
                      <!-- <li><a href="events.php">Events</a></li> -->

                      <?php
                          if(isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] == true){ 
                           
                              // echo '<li><a href="profile.php">Welcome, '.$_SESSION["username"].'</a></li>';
                              echo '<li><a href="#"><i class="fa fa-user"></i> Welcome, '.$_SESSION["adminname"].'</a></li>';
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