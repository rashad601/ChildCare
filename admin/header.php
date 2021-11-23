<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title></title>
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
<header class="header-section">

    <!------------------ START TOP Header / Quick  Contact & Social Info  ------------------>
    <div class="container-fluid header">
        <div class="container top-bar d-flex justify-content-between flex-row p-2">
            <div class="welcome-user">
                <span class="">Welcome, <?php echo @$_SESSION['admin'];?></span>
            </div><!--welcome-user-->
            <div class="logout-btn ml-5 ">
                <a href="logout.php">Logout</a>
            </div><!--logout-btn-->
        </div><!--top-bar end-->
    </div><!-- header end-->

    <!------------------ END  TOP Header / Quick  Contact & Social Info  ------------------>


    <!------------------ START NAVBAR SECTION  ------------------>

    <section class="container  nav-bar d-flex justify-content-between flex-row p-2">
        <!------------------ NAVBAR   ------------------>
        <nav class="navbar navbar-expand-lg navbar-light  w-100 ">

            <!------------------ LOGO ------------------>
            <a class="navbar-brand mr-auto" href="../index.php"><h2 class="text-warning"><strong><i class="fas fa-plus-circle text-danger"></i> Child<b class="text-danger">Care</b></strong></h2></a>
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
                        <a class="nav-link active" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="../staff.php">Our Staff</a>
                            <a class="dropdown-item" href="../programs.php">Our Programs</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">For Admin</a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                            <a class="dropdown-item" href="children.php">Children</a>
                            <a class="dropdown-item" href="staff.php">Staff</a>
                            <a class="dropdown-item" href="programs.php">Program</a>
                            <a class="dropdown-item" href="feedback.php">FeedBack</a>
                            <a class="dropdown-item" href="offer.php">Offer</a>
                            <a class="dropdown-item" href="event.php">Event</a>
                            <a class="dropdown-item" href="activities.php">Activities</a>
                            <a class="dropdown-item" href="message.php">Message</a>
                            <a class="dropdown-item" href="children_activities.php">Children Activities</a>
                            <a class="dropdown-item" href="admins.php">Admins</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admission.php">Admission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">Contact Us</a>
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

<!-- Bootstrap Js Package -->
<!-- For Design  Handling All Bootstrap Components & Utilities Operations-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>