<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title></title>

</head>
<body>
<!------------------ START  Header  ------------------>
<header class="header-section">

    <!------------------ START TOP Header / Quick  Contact & Social Info  ------------------>
    <div class="container-fluid header">
        <div class="container top-bar d-flex justify-content-between flex-row p-2">
            <div class="contact-info d-flex  pt-1">
                <div class="info-item mt-">
                    <i class="fa fa-phone"></i>
                    <span class="phone"> +353 89 460 1687</span>
                </div><!--info-item-->
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <span class="email">kidsplus@gmail.com </span>
                </div><!--info-item-->
            </div><!--contact-info end-->
            <div class="top-right d-flex justify-content-between flex-row">
                <div class="social-links d-flex flex-row">
                    <a href="#"><i class=" fab fa-facebook-f"></i></a>
                    <a href="#"><i class=" fab fa-twitter"></i></a>
                    <a href="#"><i class=" fab fa-instagram"></i></a>
                    <a href="#"><i class=" fab fa-youtube"></i></a>
                </div><!--social-links-->
                <?php if(!isset($_SESSION['admin']) && !isset($_SESSION['parent'])):?>
                <div class="login-btn ml-5 ">
                    <a href="login.php">Login</a>
                </div><!--login-btn-->
                <?php endif;?>
                <?php if(isset($_SESSION['parent']) || isset($_SESSION['admin'])):?>
                    <div class="login-btn ml-5 ">
                        <a href="logout.php">Logout</a>
                    </div><!--login-btn-->
                <?php endif;?>
            </div><!--top-right-->
        </div><!--top-bar end-->
    </div><!-- header end-->

    <!------------------ END  TOP Header / Quick  Contact & Social Info  ------------------>


    <!------------------ START NAVBAR SECTION  ------------------>

    <section class="container  nav-bar d-flex justify-content-between flex-row p-2">
        <!------------------ NAVBAR   ------------------>
        <nav class="navbar navbar-expand-lg navbar-light  w-100 ">

            <!------------------ LOGO ------------------>
            <a class="navbar-brand mr-auto" href="index.php"><h2 class="text-warning"><strong><i class="fas fa-plus-circle text-danger"></i> Child<b class="text-danger">Care</b></strong></h2></a>
            <!------------------ LOGO END  ------------------>

            <!------------------ Toggle Button ------------------>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="icon-bar">
                    <i class="fas fa-bars" style="color:#ff0004; font-size: 1.5em; margin-top: -5px;"></i>
                </span>
            </button>
            <!------------------ Toggle Button END ------------------>

            <!------------------ NAVBAR LIST------------------>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav  ml-auto mr-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="staff.php">Our Staff</a>
                            <a class="dropdown-item" href="programs.php">Our Programs</a>
                        </div>
                    </li>
                    <?php if(isset($_SESSION['parent'])):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="parentDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">For Parent</a>
                        <div class="dropdown-menu" aria-labelledby="parentDropdown">
                            <a class="dropdown-item" href="daily_activities.php">Daily Activities</a>
                            <a class="dropdown-item" href="feedback.php">FeedBack</a>

                        </div>
                    </li>
                    <?php endif;?>

                    <?php if(isset($_SESSION['admin'])):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">For Admin</a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="admin/dashboard.php">Dashboard</a>
                        </div>
                    </li>
                    <?php endif;?>

                    <li class="nav-item">
                        <a class="nav-link" href="admission.php">Admission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>

                </ul>
            </div>
            <!------------------END  NAVBAR LIST------------------>
        </nav>
        <!------------------ END NAVBAR   ------------------>


    </section><!--nav-bar end-->

    <!------------------ END NAVBAR SECTION  ------------------>


</header>
<!------------------ END  Header SECTION  ------------------>


</body>
</html>