<?php
    /*
        In this page, we will display our staffs
        so this purpose we can fetch staff which are stored into database
    */
    // start the session
    session_start();
    // include database file for using database
    require 'database/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Our Staff</title>
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
<?php require  'header.php';?>
<!------------------ END  Header SECTION  ------------------>


<!------------------ Start Staff SECTION  ------------------>
<section class="container-fluid staff-sec public-section mb-5">
    <div class="container staff-container pt-5">
            <div class="row heading-row  mb-5 ">
                <div class="col-sm-12 col-md-12 col-lg-12 staff-heading text-center">
                    <h1 class="text-info font-weight-bold">Meet Our Qualified Teachers</h1>
                    <div class="staff-hed-img mt-4">
                        <img src="assets/images/line-dec-2.png" alt="">
                    </div><!--staff-hed-image-->
                </div><!--staff-heading-->
            </div><!--heading-row end-->
        <div class="row">

            <?php
                // fetch all the staff from database
                    $query = "SELECT * FROM staff ORDER BY id DESC LIMIT 3";
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){// if programs exist then fetch one by one in assosiative array
                         while($row = mysqli_fetch_assoc($execute_query)){
                         
            ?>
            <div class="col-sm-12 col-md-12 col-lg-4 staff-items">
                <div class="staff-item mb-4">
                    <div class="staff-image p-2">
                        <img src="assets/upload/<?php echo $row['image']; ?>" alt="" height="350">
                    </div><!--staff-image-->
                    <div class="staff-title pt-4  text-center">
                        <h4 class="font-weight-bold text-danger"><?php echo $row['fname']. " ". $row['lname']?></h4>
                    </div><!--staff-title-->
                    <div class="teacher-passion text-center">
                        <span class="text-success ">- <?php echo $row['job']?> Teacher -</span>
                    </div><!--teacher-passion-->
                    <div class="offer-des p-3 text-center">
                        <p><?php echo chunk_split(substr($row['about'], 0, 300), strlen($row['about']), ".");?> </p>
                    </div><!--staff-des-->
                    <div class="staff-btn text-center  pb-4 ">
                        <a href="#"><i class=" fab fa-facebook-f"></i></a>
                        <a href="#"><i class=" fab fa-twitter"></i></a>
                        <a href="#"><i class=" fab fa-instagram"></i></a>
                        <a href="#"><i class=" fab fa-youtube"></i></a>
                    </div><!--staff-btn-->
                </div><!--staff-item-->
            </div><!--staff-items-->

            <?php
                     }//while
                    }//if
            ?>

           
        </div><!--row end-->

    </div><!--staff-container-->

</section>
<!------------------ End Staff SECTION  ------------------>



<!------------------ FOOTER Section Start  ------------------>
<?php require  'footer.php';?>
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