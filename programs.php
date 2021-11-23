<?php
    /*
        In this page, we will display our programs
        so this purpose we can fetch program which are stored into database
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
    <title>Our Programs</title>
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



<!------------------ Offer Section Start  ------------------>
<section class="container-fluid program-sec public-section">
    
    <div class="container heading-container">
         <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 program-heading text-center">
                <h1 class="text-danger font-weight-bold">Our Programs</h1>
                <div class="program-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--program-hed-image-->
            </div><!--program-heading-->
        </div><!--heading-row end-->
    </div><!--container-->
              
    <div class="container program-container pt-5" id="program-container">

        <div class="row">
        <?php
            // fetch all the program from database
            $query = "SELECT * FROM program";
            $execute_query = mysqli_query($connection, $query);
            if(mysqli_num_rows($execute_query) > 0){ //if programs exist then fetch one by one in assosiative array
                while($row = mysqli_fetch_assoc($execute_query)){
                    $img = "<img src='assets/upload/".$row['image']."' alt='' height='250'>";
         ?>  
            <div class="col-sm-12 col-md-6 col-lg-4 program-items ">
                <div class="program-item mb-4">
                    <div class="program-image p-2">
                        <?php echo $img;?>
                    </div><!--program-image-->
                    <div class="program-title pt-4  text-center">
                        <h4 class="font-weight-bold text-danger"><?php echo $row['title'];?></h4>
                    </div><!--program-title-->
                    <div class="program-des p-3 text-center">
                        <p><?php echo chunk_split(substr($row['about'], 0, 300), strlen($row['about']), ".")?></p>
                    </div><!--program-des-->
                    <div class="program-detail d-flex flex-row pt-2 pl-4 pr-4 pb-4 justify-content-between">
                        <div class="class-size text-center ">
                            <span class="text-danger font-weight-bold"><?php echo $row['class_size'] ?></span><br>
                            <span class="text-success font-weight-bold">Class Size</span>
                        </div><!--class size-->
                        <div class="child-room text-center">
                            <span class="text-danger font-weight-bold"><?php echo $row['child_age']?></span><br>
                            <span class="text-success font-weight-bold">Year Old</span>
                        </div><!--class size-->
                        <div class="time-period text-center">
                            <span class="text-danger font-weight-bold"><?php echo $row['program']?></span><br>
                            <span class="text-success font-weight-bold">Day</span><br>
                        </div><!--class size-->
                    </div><!--program-detail-->
                    <div class="program-btn text-center pt-3 pb-4 ">
                        <a href="programs.html">Learn More</a>
                    </div><!--program-btn-->
                </div><!--program-item-->
            </div><!--program-items-->
            <?php
                }//while
            }//if
            ?>
        </div><!--row-->
       
    </div><!--program-container-->

</section>
<!------------------ Program Section End  ------------------>



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
<!--this is jquery script for adding divider after every three program-->
<script type="text/javascript">
// $(document).ready(function(){
//     var count = 0; // make count variable
//     var length = $(".program-items").length; // get total programs
//     for(var i = 0; i < length; i++){ // iterate the length of programs
//         count++;
//         if(count != 1  && count%3 == 0){
//             $("<div class='w-100 d-none m-2'></div>" ).insertBefore($(".program-items")[count]); // add divder after every three programs
//         }
//     }

// });        
</script>        
</body>
</html>