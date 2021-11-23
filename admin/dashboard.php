<?php
    
    /*
        this is admin dashb oard page where admin can see all the operation which work on our web app
    */
    session_start();
    // include authentication file
    require 'authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>DashBoard</title>
    <!-- Required Links &  Resources -->

    <!-- Bootstrap Css Framework -->
    <!-- For Design  All Bootstrap Components & Utilities-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Custom Css -->
    <!-- For Design  All Our App Components & Utilities -->
    <link type="text/css" rel="stylesheet" href="../assets/css/style.css">
    <!-- Responsive Media Css -->
    <!-- Build For Make Our App Responsive -->
    <link type="text/css" rel="stylesheet" href="../assets/css/media.css">
    <!-- FontAwesome Css -->
    <!-- For Design All Icons -->
    <link type="text/css" rel="stylesheet" href="../assets/css/fontawesome.css">
</head>
<body>
<!------------------ START  Header  ------------------>
<?php
require 'header.php';
?>
<!------------------ END  Header SECTION  ------------------>

<!------------------ Admin  Section Start  ------------------>
<section class=" container admin-section mt-5 mb-5">
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 dashboard-heading text-center">
            <h1 class="text-info font-weight-bold">Dashboard</h1>
            <div class="dashboard-hed-img mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--dashboard-hed-image-->
        </div><!--dashboard-heading-->
    </div><!--heading-row end-->

    <div class="row dashboard-row">
        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="children.php" class="dashboard-item text-center bg-danger d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Children's</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="staff.php" class="dashboard-item text-center bg-warning d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Staff's</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="programs.php" class="dashboard-item text-center bg-success d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Programs</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a  href="feedback.php" class="dashboard-item text-center bg-info d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">FeedBack's</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->


    </div><!--dashboard-row-->


    <div class="row dashboard-row">
        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="offer.php" class="dashboard-item text-center bg-success d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Offers</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="event.php" class="dashboard-item text-center bg-info d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Events</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="activities.php" class="dashboard-item text-center bg-warning d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Activities</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->

        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="message.php" class="dashboard-item text-center bg-danger d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Messages</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->


    </div><!--dashboard-row-->

    <div class="row dashboard-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="children_activities.php" class="dashboard-item text-center bg-info d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">Children Activites</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->
        <div class="col-sm-12 col-md-12 col-lg-3 dashboard-items mb-5">
            <a href="admins.php" class="dashboard-item text-center bg-warning d-flex justify-content-center p-4 flex-column align-item-center ">
                <span class="text-light">For Admin</span>
            </a><!--dashboard-item-->
        </div><!--dashboard-items-->
    </div><!--dashboard-row-->

</section>
<!------------------ Admin  Section End  ------------------>

<!------------------ Footer Section Start  ------------------>
<?php
require 'footer.php';
?>
<!------------------ Footer Section End  ------------------>

<!-- Bootstrap Js Package -->
<!-- For Design  Handling All Bootstrap Components & Utilities Operations-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- FontAwesome Js Package -->
<!-- For Design  Handling  All Icons Animations, Transitions -->
<script type="text/javascript" src="../assets/js/fontawesome.js"></script>
<!-- Our App Js -->
<!-- For Design  Handling  All App Components and Operations -->
<script type="text/javascript" src="../assets/js/app.js"></script>
</body>
</html>