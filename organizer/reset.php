
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

  </head>

<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <h1>Venue</h1>
                    </a>
                    <!-- ***** Logo End ***** -->
                   
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->



  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
          <div class="section-heading" style="width:100%;">
            <h6>| Reset Password</h6>
          </div>
          <form class="contact-form" id="resetpassword" style="margin-left:0px !important;" action="" method="post">
          <input type="hidden" name="action" value="resetpassword">
          <input type="hidden" name="qid" value="<?php echo $_GET["qid"]; ?>">

            <div class="row">
              
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Password</label>
                  <input type="password" name="password" id="password" placeholder="Password" >
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <label for="subject">Confirm Password</label>
                  <input type="password" id="confirmpassword" placeholder="Confirm Password" >
                </fieldset>
              </div>
              
              <div class="col-lg-12">
                <fieldset>
                  <button type="button" id="bt_reset" class="orange-button">Reset Password</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4">
        </div>
        
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a> Distribution: <a href="https://themewagon.com">ThemeWagon</a></p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/js/isotope.min.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/counter.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/script.js"></script>

  </body>
</html>