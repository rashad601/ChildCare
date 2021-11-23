<?php
/*
    In this page, Only register parents can send feedback to the admin about services
*/

// start session
session_start();
// Include databse file

require 'database/connection.php';
require 'parent_auth.php';


// declare error array
$error_array = array();
if(isset($_POST['submit-feedbk'])){ // check: if user submit feedback
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose
    $name = htmlentities($_POST['name']);
    $service = htmlentities($_POST['service']);
    $date = date('Y-m-d', strtotime(htmlentities($_POST['date'])));
    $feedback= htmlentities($_POST['message']);
    $verified = 0; // only those feedback display in public service which will be verified by admin



    function validateName($name){
        // Username validation
        if (!empty($name)) {
            trim($name); // trim extra spaces on left and right side of data/name
            if (!preg_match("/^[a-zA-z-' ]*$/", $name)) {
                return true;
            }
        }
    }// end validateName()




    function validateService($service){
        //  Service validation
        if (!empty($service)) {
            trim($service); // trim extra spaces on left and right side of data/email
            if (!preg_match("/^[a-zA-z-' ]*$/", $service)) {
                return true;
            }
        }
    }    // end validate service

    function validateDate($date, $format = "Y-m-d"){
        //  Date validation
        if (!empty($date)) {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;

        }

    } // end validate date

    function insertFeedBack($name, $service, $date,  $feedback, $verified, $connection){
        // Insert command
        $query = "INSERT INTO feedback(name, service, date, feedback, verified) VALUES ('$name',  '$service', '$date', '$feedback', '$verified')";
        $execute_query = mysqli_query($connection, $query); // execute query
        if($execute_query){ // if query executed then return true otherwise return false
            return true;
        }
        else{
            return false;
        }
    }// end insertFeedBack function

    // call all validation function
    // if validate function return true then raise error
    if(validateName($name)){
        $name_error = "Only letters are required!";
        array_push($error_array, $name_error); // add error into error_array

    }
    elseif (validateService($service)){
        $service_error = "Only letters are required!";
        array_push($error_array, $service_error); // add error into error_array

    }
    elseif (!validateDate($date)){
        $date_error = "Invalid date!";
        array_push($error_array, $date_error); // add error into error_array

    }

    // check: if no error then submit message into database
    if(empty($error_array)){
        if(insertFeedBack($name,  $service, $date, $feedback, $verified,  $connection)){
            $success_message = "Send Feedback Successfully!"; // create success session
        }
        else{
            $error_message = "Connection Error!";
        }
    }

}// main if
if(isset($success_message)){
    // if message submitted then clear all variable
    $name = "";
    $service = "";
    $date = "";
    $feedback = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>FeedBack</title>
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


<!------------------ Start Contact SECTION  ------------------>
<section class="container-fluid contact-sec public-section mt-5 mb-4 ">
    <div class="container feedbk-container ">
        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 heading text-center">
                <h1 class="text-info font-weight-bold">Give Us A FeedBack</h1>
                <div class="hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--hed-image-->
            </div><!--heading-->
        </div><!--heading-row end-->
        <div class="row feedback-row">
            <?php if(!empty($success_message)):?>
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
                <div class="alert alert-success">
                    <p class="text-success font-weight-bold mb-0"><?php echo  @$success_message;?></p>
                </div>
            </div>
            <?php endif;?>

            <?php if(!empty($error_message)):?>
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
                <div class="alert alert-danger">
                    <p class="text-danger font-weight-bold mb-0"><?php echo  @$error_message;?></p>
                </div>
            </div>
            <?php endif;?>
            <div class="col-sm-12 col-md-12 col-lg-8  offset-lg-2 feedbk-form">
                <div class="form-wrapper">
                    <form method="post" action="feedback.php" enctype="multipart/form-data">

                        <div class="row input-row row-first">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label class="text-info ml-1 font-weight-bold">Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo @$name; ?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Service:</label>
                                    <input type="text" name="service" class="form-control" placeholder="Enter Service Name" value="<?php echo @$service; ?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$service_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row/ row-first-->


                        <div class="row input-row row-second">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <div class="form-group">
                                    <label class="text-info ml-1 font-weight-bold">Date:</label>
                                    <input type="date" name="date" class="form-control" required value="<?php echo @$date; ?>">
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$date_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / second-row-->


                        <div class="row input-row row-third">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Message:</label>
                                    <textarea type="text" name="message"  class="form-control w-100" rows="5" placeholder="Enter Message" required><?php echo @$feedback; ?></textarea>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / third-row-->




                        <div class="row input-row row-fourth">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <button type="submit" name="submit-feedbk" class="btn btn-md text-light btn-info ">Send FeedBack</button>
                            </div><!--input-->
                        </div><!--input-row / fourth-row-->

                    </form>
                </div><!--form-wrapper-->
            </div><!--feedback-form-->
        </div><!--feedback-row-->
    </div><!--feedback-container-->
</section>
<!------------------ END Feedback SECTION  ------------------>



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