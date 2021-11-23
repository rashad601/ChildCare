<?php
/*
    In this page, all the members send message to admin aboyt company or anything else    
*/


// start session
session_start();
// Include databse file
require 'database/connection.php';



// declare error array
$error_array = array();

if(isset($_POST['submit-message'])){ // check: if user submit message
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose
    $name = htmlentities($_POST['username']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['subject']);
    $number = htmlentities($_POST['number']);
    $message = htmlentities($_POST['message']);


    function validateName($name){
        // Username validation
        if (!empty($name)) {
            trim($name); // trim whitespaces on left and right side of data/name
            if (!preg_match("/^[a-zA-z-' ]*$/", $name)) {  // check data only contains letter and whitespaces if it does 
                return true;
            }
        }
    }// end validateName()

    function validateEmail($email){
        // Email Validation
        if (!empty($email)) {
            trim($email); // trim white spaces on left and right side of data/email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  // check email format 
                return true;
            }
        }
    }// end validate Email


    function validateSubject($subject){
        //  Subject validation
        if (!empty($subject)) {
            trim($subject); // trim whitespaces on left and right side of data/subject
            if (!preg_match("/^[a-zA-z-' ]*$/", $subject)) { // check data only contains letter and whitespaces if it does 
                return true;
            }
        }
    }    // end validate subject()

    function validateNumber($number){
        //  Number validation
        if (!empty($number)) {
            trim($number); // trim white spaces on left and right side of data/number
            if (!is_numeric($number) || strlen($number) < 9 || strlen($number) > 13) { // validate phone number
                return true;
            }
        }

    } // end validate number

    // Function of insert message into databse

    function insertMessage($name, $email, $subject, $number, $message, $connection){
        // Insert command
        $query = "INSERT INTO message(`name`, `email`, `subject`, `phone`, `message`) VALUES ('$name', '$email', '$subject', '$number', '$message')";
        $execute_query = mysqli_query($connection, $query); // execute query
        if($execute_query){ // if query executed tyhen return true otherwise return false
            return true;
        }
        else{
            return false;
        }
    }// end insertMessage function

    // call all validation function
    // if validate function return true then raise error
    if(validateName($name)){
        $name_error = "Only letters are required!";
        array_push($error_array, $name_error); // add error into error_array
    }
    elseif (validateEmail($email)){
        $email_error = "Invalid email format!";
        array_push($error_array, $email_error); // add error into error_array
    }
    elseif (validateSubject($subject)){
        $subject_error = "Only letters are required!";
        array_push($error_array, $subject_error); // add error into error_array
    }
    elseif (validateNumber($number)){
        $number_error = "Invalid number!";
        array_push($error_array, $number_error); // add error into error_array
    }

    // check: if no error then submit message into database
    if(empty($error_array)){
        if(insertMessage($name, $email, $subject, $number, $message, $connection)){
            $success_message = "Send Message Successfully!"; // create success message
        }
        else{
           $error_message = "Connection Error!"; // create error mesage
        }
    }

}// main if

// if no error recor inserted then empty all input fields / variables
if(!empty($success_message)){
    $name = "";
    $email = "";
    $subject = "";
    $number = "";
    $message = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Contact Us</title>
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
    <?php require  'header.php';?>
</header>
<!------------------ END  Header SECTION  ------------------>


<!------------------ Start Contact SECTION  ------------------>
<section class="container-fluid contact-sec public-section mt-5 mb-4 ">
    <div class="container contact-container ">
        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 contact-heading text-center">
                <h1 class="text-info font-weight-bold">Send Us  A Message</h1>
                <div class="contact-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--contact-hed-image-->
            </div><!--contact-heading-->
        </div><!--heading-row end-->
        <div class="row contact-row">
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
            <div class="col-sm-12 col-md-12 col-lg-8  offset-lg-2 contact-form">
                <div class="form-wrapper">
                    <form method="post" action="contact.php">

                        <div class="row input-row row-first">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label class="text-info ml-1 font-weight-bold">Name:</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter Name" value="<?php echo @$name; ?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$name_error ;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Email:</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo @$email; ?>" required>
                                     <span class="text-danger mt-3 ml-1 error"><?php echo @$email_error ;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row/ row-first-->


                        <div class="row input-row row-second">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label class="text-info ml-1 font-weight-bold">Subject:</label>
                                    <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo @$subject; ?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$subject_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                    <div class="form-group">
                                        <label  class="text-info ml-1 font-weight-bold">Phone Number:</label>
                                        <input type="text" name="number" class="form-control" placeholder="Enter Phone Number" value="<?php echo @$number; ?>" required>
                                        <span class="text-danger mt-3 ml-1 error"><?php echo @$number_error;?></span>
                                    </div><!--form-group-->
                                </div><!--input-->
                        </div><!--input-row / second-row-->


                        <div class="row input-row row-third">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Message:</label>
                                    <textarea type="text" name="message"  class="form-control w-100" rows="5" placeholder="Enter Message"  required><?php echo @$message; ?></textarea>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / third-row-->


                        <div class="row input-row row-fourth">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <button type="submit" name="submit-message" class="btn btn-md text-light btn-info ">Send Message</button>
                            </div><!--input-->
                        </div><!--input-row / fourth-row-->

                    </form>
                </div><!--form-wrapper-->
            </div><!--contact-form-->
        </div><!--contact-row-->
    </div><!--contact-container-->
</section>
<!------------------ END Contact SECTION  ------------------>


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