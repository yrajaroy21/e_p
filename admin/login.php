<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>EVENT PLANNER</title>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #E0FFFF;
            /* Light Blue background color */
            color: #333333;
        }

        .orange-button {
            background-color: #FFA500;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .orange-button:hover {
            background-color: #FF8C00;
        }

        /* Add more styles as needed */
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

        footer p {
            text-align: right;
            line-height: 100px;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
        }

    </style>
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
                            <h1>EVENT PLANNER</h1>
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
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>| Admin Login</h6>
                    </div>
                    <form class="contact-form" id="adminlogin" style="margin-left:0px !important;" action=""
                        method="post">
                        <input type="hidden" name="action" value="admin">
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="email">Email Address</label>
                                    <input type="text" name="adminemail" id="adminemail"
                                        pattern="[^ @]*@[^ @]*" placeholder="Your E-mail..." required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="subject">Password</label>
                                    <input type="password" name="adminpassword" id="adminpassword"
                                        placeholder="password">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="button" id="bt_adminlogin" class="orange-button">Login</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="col-lg-8">
                <p>Copyright © 2023-2024 All rights reserved.
                    <!-- Design:<a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    Distribution: <a href="https://themewagon.com">ThemeWagon</a></p> -->
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
    <script>
    document.getElementById("bt_adminlogin").addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default form submission

        var adminEmail = document.getElementById("adminemail").value.trim(); // Trim to remove white spaces
        var adminPassword = document.getElementById("adminpassword").value.trim();

        // Perform basic validation
        if (adminEmail === '' || adminPassword === '') {
            alert('Please fill in all fields.');
            return;
        }

        
    });
</script>


    
</body>

</html>