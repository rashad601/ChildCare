<?php
    /*
        this is our kidplus landing page with dynamic three feature boxes
         offer , events and activities, and also include parents feedback
    */

    //session start
    session_start();
    // include database file
    require 'database/connection.php';

    //check if exist message then create message variable of logout
    if(isset($_GET['success'])){
        $success = $_GET['success'];
        echo "<script>alert('$success');</script>"; // create alert of logout message
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Home</title>
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
<?php
    require 'header.php';
?>
<!------------------ END  Header SECTION  ------------------>

<!------------------ START BANNER SECTION  ------------------>
<?php
    require 'banner.php';
?>
<!------------------ END BANNER SECTION  ------------------>

<!------------------ ROOM  SECTION START  ------------------>
<section class="container-fluid room-section mt-3">
    <div class="room-items">
        <!------Rooms First Item--------->
        <div class="room-item">
            <h1>Babies</h1>
            <p>Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing
                your child’s safety, security, and happiness</p>
            <a href="programs.html">Learn More</a>
        </div><!--room-item-->

        <!------Rooms Second Item--------->
        <div class="room-item">
            <h1>Toddler's</h1>
            <p>Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing
                your child’s safety, security, and happiness</p>
            <a href="programs.html">Learn More</a>
        </div><!--room-item-->

        <!------Rooms Third Item--------->
        <div class="room-item">
            <h1>Wobbler's</h1>
            <p>Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing
                your child’s safety, security, and happiness</p>
            <a href="programs.html">Learn More</a>
        </div><!--room-item-->

        <!------Rooms Fourth Item--------->
        <div class="room-item">
            <h1>Pre-School</h1>
            <p>Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing
                your child’s safety, security, and happiness</p>
            <a href="programs.html">Learn More</a>
        </div><!--room-item-->
    </div><!--room-items end-->
</section>
<!------------------ ROOM SECTION END  ------------------>

<!------------------ Welcome SECTION Start  ------------------>
<section class="container-fluid welcome-section pt-5">
    <div class="container welcome-container mt-5">
        <div class="row welcome-row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-8 welcome-item offset-lg-2">
                <div class="welcome-title text-center  w-100">
                    <h1 class="font-weight-bold">Welcome to KidsPlus ChildCare</h1>
                </div><!--welcome-title-->
                <div class="welcome-divider text-center w-100 mt-4 mb-4">
                    <img src="../assets/images/line-dec-2.png" alt="">
                </div><!--welcome-divider-->
                <div class="welcome-message w-100 text-center mb-5">
                    <p class="text-dark">Our kidsPlus ChildCare has been in operation since 1996, for children from newborn to 6 years old. Close to the forest,
                        the environment motivates the children to explore nature,
                        find different forest animals and plants, go hiking, and play creative games.</p>
                </div><!--welcome-message-->
            </div><!--welcome-item-->
        </div><!--Welcome-row-->
    </div><!--welcome-container-->
</section>
<!------------------ Welcome SECTION End  ------------------>


<!------------------ Offer Section Start  ------------------>
<section class="container-fluid offer-sec">
    <div class="container offer-container pt-5 pb-5">
        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 offer-heading text-center">
                <h1 class="text-danger font-weight-bold text-center">Our Special Offers</h1>
                <div class="offer-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--offer-hed-image-->
            </div><!--offer-heading-->
        </div><!--heading-row end-->
        <div class="row offer-row">

            <!--fetch three offer from database-->
            <!-- diplay offers-->
             <?php
                    $query = "SELECT * FROM offer ORDER BY id DESC LIMIT 3"; // select thrree offers in descending order
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){// if exist then fetch and display
                         while($row = mysqli_fetch_assoc($execute_query)){
                         
            ?>

            <!--Offer First Item-->
            <div class="col-sm-12 col-md-12 col-lg-4 offer-items mb-5">
                <div class="offer-item">
                    <div class="offer-image">
                        <img src="assets/upload/<?php echo $row['image']; ?>" alt="">
                    </div><!--offer-image-->
                    <div class="offer-title p-4 mt-2 d-flex justify-content-between flex-row">
                        <h4 class="font-weight-bold"><?php echo $row['title']; ?></h4>
                        <span class="mr-2 mt-1 font-weight-bold ">$<?php echo $row['price']; ?></span>
                    </div><!--offer-title-->
                    <div class="offer-des p-2 pl-4">
                        <p><?php echo chunk_split(substr($row['description'], 0, 300), strlen($row['description']), ".");?></p>
                    </div><!--offer-des-->
                    <div class="offer-btn text-center pt-2 ">
                        <a href="programs.html">Learn More</a>
                    </div><!--offer-bnt-->
                </div><!--offer-item-->
            </div><!--offer-items end-->

            <?php
                     }//while
                    }//if
            ?>

        
        </div><!--offer-row end-->
    </div><!--offer-container-->
</section>
<!------------------ Offer Section End  ------------------>




<!------------------ Event Section Start  ------------------>
<section class="container-fluid event-section pt-5 pb-5 ">
    <div class="container pt-5 pb-5 event-container">

        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 event-heading text-center">
                <h1 class="text-danger font-weight-bold">Don't Miss Our Event</h1>
                <div class="event-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--event-hed-image-->
            </div><!--event-heading-->
        </div><!--heading-row end-->

        <div class="row event-row">

            <!--fetch three events from database-->
            <!-- diplay events-->

              <?php
                    $query = "SELECT * FROM child_event ORDER BY id DESC LIMIT 3"; // select thrree events in descending order
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){
                         while($row = mysqli_fetch_assoc($execute_query)){ // if exist then fetch and display
                            $date = strtotime($row['event_date']);
                            $month = date("F", $date); // slicing month from date
                            $day = date("j", $date); // slicing day from date
                            $year = date("Y", $date); // slicing year from date


            ?>
            <!--Event First Item-->
            <div class="col-sm-12 col-md-12 col-lg-4 mb-5 event-items">
                <div class="event-item">
                    <div class="event-image">
                        <img src="assets/upload/<?php echo $row['image']; ?>" alt="">
                    </div><!--event-image-->
                    <div class="event-title  p-4 mt-2">
                        <h4 class="font-weight-bold"><?php echo $row['title']; ?></h4>
                        <span class="event-date-time"><?php echo $month." ".$day.", ".$year; ?> / <?php echo substr($row['start_time'], 0, 5); ?> am - <?php echo substr($row['end_time'], 0, 5); ?> am</span>
                    </div><!--event-title-->
                    <div class="event-des p-4 ">
                        <p><?php echo chunk_split(substr($row['description'], 0, 300), strlen($row['description']), ".");?></p>
                    </div><!--event-des-->
                    <div class="event-btn text-center pt-2">
                        <a href="programs.html">Learn More</a>
                    </div><!--event-bnt-->
                </div><!--event-item-->
            </div><!--event-items-->
            <?php
                     }//while
                    }//if
            ?>

           
        </div><!--row end-->

    </div><!--Event container-->
</section>
<!------------------ Event Section END  ------------------>

<!------------------ Activities Section Start  ------------------>
<section class="container-fluid activity-sec">
    <div class="container activity-container pt-5 pb-5">

        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 activity-heading text-center">
                <h1 class="text-danger font-weight-bold text-center">New Activities</h1>
                <div class="activity-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--activity-hed-image-->
            </div><!--activity-heading-->
        </div><!--heading-row end-->

        <div class="row activity-row">
             <!--fetch three activities from database-->
             <!-- diplay activities-->
             <?php
                    $query = "SELECT * FROM activity ORDER BY id DESC LIMIT 3"; // select thrree activities in descending order
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){// if exist then fetch and display
                         while($row = mysqli_fetch_assoc($execute_query)){
                            $date = strtotime($row['activity_date']);
                            $month = date("F", $date);// slicing month from date
                            $day = date("j", $date);// slicing day from date
                            $year = date("Y", $date);// slicing year from date


            ?>
            <!--Activity First Item-->
            <div class="col-sm-12 col-md-12 col-lg-4 activity-items mb-5">
                <div class="activity-item">
                    <div class="activity-image">
                        <img src="assets/upload/<?php echo $row['image']; ?>" alt="">
                    </div><!--activity-image-->
                    <div class="activity-title p-4 mt-2 d-flex justify-content-between flex-row">
                        <h4 class="font-weight-bold"><?php echo $row['title']; ?></h4>
                    </div><!--activity-title-->
                    <div class="activity-time pl-4 pr-4">
                        <span><?php echo $month." ".$day.", ".$year; ?> / <?php echo substr($row['start_time'], 0, 5); ?> am - <?php echo substr($row['end_time'], 0, 5); ?> am</span>
                    </div><!--activity-time-->
                    <div class="activity-des p-2 pl-4 pr-4">
                        <p><?php echo chunk_split(substr($row['description'], 0, 300), strlen($row['description']), ".");?></p>
                    </div><!--activity-des-->
                    <div class="activity-btn text-center pt-2 ">
                        <a href="programs.html">Learn More</a>
                    </div><!--activity-btn-->
                </div><!--activity-item-->
            </div><!--activity-items end-->

            <?php
                     }//while
                    }//if
            ?>

        </div><!--activity-row end-->
    </div><!--activity-container-->
</section>
<!------------------ Activities Section End  ------------------>




<!------------------ Testimonials Section Start  ------------------>
<section class="container-fluid testimonials-section pt-5 pb-5 mb-5">
    <div class="container test-container pt-5">


        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 testimonials-heading text-center">
                <h1 class="text-danger font-weight-bold">Happy Parents</h1>
                <div class="event-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--event-hed-image-->
            </div><!--event-heading-->
        </div><!--heading-row end-->

        <div class="row pt-5 test-row">
            <!--fetching feedback from database-->
            <?php
                $query = "SELECT * FROM feedback Where verified = 1"; // select verified feedback from database
                $execute_query = mysqli_query($connection, $query);
                if(mysqli_num_rows($execute_query) > 0){ //if exist then fetch and display
                    while($row = mysqli_fetch_assoc($execute_query)){
                        $id = $row['id']; 
            ?>
            <!--Testimonials First Item-->
            <div class="col-sm-12 col-md-12 col-lg-8 testimonial-items text-center offset-lg-2 ">
                <div class="testimonial-item">
                    <div class="test-img text-center">
                        <img src="assets/images/flower.jpg" alt="">
                    </div><!--test=img-->
                    <div class="test-info mt-4 ">
                        <span class="text-danger font-weight-bold" style="font-size: 1.2em;"><?php echo  $row['name'];?></span>
                    </div><!--test-info-->
                    <div class="test-date">
                        <small><?php echo $row['date'];?></small>
                    </div><!--test-date-->
                    <div class="test-text text-center ">
                        <p class="text-dark"><i class="fas fa-quote-left m-2 text-danger"></i><?php echo $row['feedback']; ?> <i class="fas fa-quote-right m-2 text-danger"></i></p>
                    </div><!--test-text-->
                    <div class="test-slider-btn">
                        <button type="button" class="btn btn-default text-primary btn-sm" onclick="plusTestimonials(-1)">&#10094;</button>
                        <button type="button" class="btn btn-default text-primary btn-sm" onclick="plusTestimonials(+1)">&#10095;</button>
                    </div><!--test-slider-btn-->
                </div><!--testimonial-item-->
            </div><!--testimonial-items-->
                <?php
                    }//while
                }//if
                ?>


        </div><!--test-row-->
    </div><!--test-container-->

</section>
<!------------------ Testimonials Section End  ------------------>


<!------------------ FOOTER Section Start  ------------------>
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