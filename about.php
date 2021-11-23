<?php
    /*
        In this page, Kidsplus tell about their services their values and their background to users
    */
	// session start here
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>About</title>
    <!-- Required Links &  Resources -->

    <!-- Bootstrap Css Framework -->
    <!-- For Design  All Bootstrap Components & Utilities-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Custom Css -->
    <!-- For Design  All Our App Components & Utilities -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive Media Css -->
    <!-- Build For Make Our App Responsive -->
    <link type="text/css" rel="stylesheet" href="assets/css/media.css">
    <!-- FontAwesome Css -->
    <!-- For Design All Icons -->
    <link type="text/css" rel="stylesheet" href="assets/css/fontawesome.css">
</head>
<body>
<!------------------ START  Header  ------------------>
<header class="header-section">
	<!--include header file -->
    <?php require  'header.php';?>
</header>
<!------------------ END  Header SECTION  ------------------>



<!------------------ Start About SECTION  ------------------>
<section class="container-fluid about-section public-section mt-5">
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 staff-heading text-center">
            <h1 class="text-info font-weight-bold">About Us</h1>
            <div class="staff-hed-img mt-4">
                <img src="assets/images/line-dec-2.png" alt="">
            </div><!--staff-hed-image-->
        </div><!--staff-heading-->
    </div><!--heading-row end-->

    <!--About First Item-->
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 about-img p-0 text-center">
            <div class="about-image">
                <img src="assets/images/home-1-1025x664.jpg" alt="">
            </div>
        </div><!--about-img-->
        <div class="col-sm-12 col-md-6 col-lg-6 about-content ">
            <div class="about-info">
                <div class="about-info-head">
                    <h1>WHO WE ARE</h1>
                    <div class="divider mt-4"></div>
                </div><!--about-info-head-->
                <div class="about-info-des mt-4 text-center">
                    WE ARE A NETWORK OF NURSERY CENTERS PROVIDING LEARNING AND CHILDCARE TO 100+ CHILDREN AND SUPPORT FOR THEIR FAMILIES.
                </div><!--about-info-des-->

            </div><!--about-info-->
        </div><!--about-content-->
    </div><!--row-->

     <!--About Second Item-->
    <div class="row ">
        <div class="col-sm-12 col-md-6 col-lg-6 about-content ">
            <div class="about-info">
                <div class="about-info-head">
                    <h1>Our Values</h1>
                    <div class="divider mt-4"></div>
                </div><!--about-info-head-->
                <div class="about-info-des mt-4 text-center">
                    BEAUTY, GROWTH, DEVELOPMENT, AND HAPPINESS ARE THE FOUNDATION WE USE TO GUIDE OUR DAILY INTERACTIONS AND DECISION-MAKING.
                </div><!--about-info-des-->

            </div><!--about-info-->
        </div><!--about-content-->
        <div class="col-sm-12 col-md-6 col-lg-6 about-img p-0 text-center ">
            <div class="about-image">
                <img src="assets/images/home-2-1025x664.jpg" alt="">
            </div>
        </div><!--about-img-->
    </div><!--row-->




</section>
<!------------------ End About SECTION  ------------------>






<!------------------ FOOTER Section Start  ------------------>
<!--include footer file-->
<?php require 'footer.php';?>
<!------------------ FOOTER Section End  ------------------>


<!-- Bootstrap Js Package -->
<!-- For Design  Handling All Bootstrap Components & Utilities Operations-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- FontAwesome Js Package -->
<!-- For Design  Handling  All Icons Animations, Transitions -->
<script type="text/javascript" src="assets/js/fontawesome.js"></script>
<!-- Our App Js -->
<!-- For Design  Handling  All App Components and Operations -->
<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>