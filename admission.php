<?php

/*
    In this page, Parents can register thier child and themself too
*/

// start session
session_start();
// Include databse file
require 'database/connection.php';



// declare error array
// store all error into array
$error_array = array();

if(isset($_POST['register-child'])){ // check: if user submit child
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting child input fields data data
    $first_name = htmlentities($_POST['ch-fname']);
    $last_name = htmlentities($_POST['ch-lname']);
    $father_name = htmlentities($_POST['ch-father-name']);
    $age = htmlentities($_POST['ch-age']);
    $dob = date('Y-m-d', strtotime(htmlentities($_POST['ch-dob'])));
    $gender = htmlentities($_POST['gender']);
    $room = htmlentities($_POST['room']);
    $program = htmlentities($_POST['programs']);
    @$confirm_age = (int)date("Y-m-d") - $dob; // calculate child age with date of birth


    //  Getting parent input fields data
    $parent_first_name = htmlentities($_POST['pt-fname']);
    $parent_last_name = htmlentities($_POST['pt-lname']);
    $parent_email = htmlentities($_POST['pt-email']);
    $parent_phone_number = htmlentities($_POST['pt-phone']);
    $parent_password = htmlentities($_POST['pt-password']);
    $parent_confirm_password = htmlentities($_POST['pt-cf-password']);




    // Satrt Validation of Child Inputs Fields 

    function childFnameValidation($first_name){
        // validate child  first name
        if (!empty($first_name)) {
            trim($first_name); // trim whitespaces from left and right side of data
            if (!preg_match("/^[a-zA-z-' ]*$/", $first_name)) { // check data only contains letter and whitespaces if it does not match return true
               return true;
            }
        }
    }


    function childLnameValidation($last_name){
      // validate child last name
        if (!empty($last_name)) {
            trim($last_name); // trim whitespaces from left and right side of data
            if (!preg_match("/^[a-zA-z-' ]*$/", $last_name)) {// check data only contains letter and whitespaces if it does not match return true
                return true;
            }
        }
    }

    function childFatherNameValidation($father_name){

        // validate child father name
        if (!empty($father_name)) {
            trim($father_name); // trim whitespaces from left and right side of data
            if (!preg_match("/^[a-zA-z-' ]*$/", $father_name)) { // check data only contains letter and whitespaces if it does not match return true
                return true;
            }
        }

    }
    
    function childAgeValidation($age){    

        // validate child age
        if (!empty($age)) {
            trim($age); // trim whitespaces from left and right side of data
            if (!is_numeric($age)) { // check data only contains numeric digits if it does not match return true
                return true;
            }
            elseif ((int)$age > 6 || (int)$age<=0){ // else if age doses not match valid condition then return true otherwise false
                return true;
            }
        }
    }

 
    
    function childGenderValidation($gender){    
        // validate child gender
        if(!empty($gender)){
            if($gender === "Gender"){ // validate gender
                return true;
            }
        }

    }
    
    function childRoomValidation($room){    

        // validate child room
        if(!empty($room)){
            if($room === "Select Room"){ // validate room
                return true;
            }
        }

    }
    
    function childProgramValidation($program){    
        // validate child program
        if(!empty($program)){
            if($program === "Select Program"){ // validate program
                return true;
            }
        }

    }





    // Start Parent input  fields validation 

    function parentFnameValidtion($parent_first_name){

        // validate parent  first name
        if (!empty($parent_first_name)) {
            trim($parent_first_name); // trim whitespaces on left and right side of data
            if (!preg_match("/^[a-zA-z-' ]*$/", $parent_first_name)) { // check data only contains letter and whitespaces if it does not match return true
                return true;
            }
        }
    }

    function parentLnameValidtion($parent_last_name){
        // validate parent last name
        if (!empty($parent_last_name)) {
            trim($parent_last_name); // trim whitepaces on left and right side of data
            if (!preg_match("/^[a-zA-z-' ]*$/", $parent_last_name)) { // check data only contains letter and whitespaces if it does not match return true
                return true;

            }
        }
    }

    function parentEmailValidtion($parent_email){    

        // Email Validation
        if (!empty($parent_email)) {
            trim($parent_email); // trim whitespaces on left and right side of data
            if (!filter_var($parent_email, FILTER_VALIDATE_EMAIL)) { // validate email format
                return true;
            }
        }
    }
    
    function parentPhoneNumberValidtion($parent_phone){    

        //  Parent Number validation
        if (!empty($parent_phone)) {
            trim($parent_phone); // trim whitespaces on left and right side of data
            if (!is_numeric($parent_phone) || strlen($parent_phone) < 9 || strlen($parent_phone) > 13) { // validate phone number
                return true;
            }
        }

    }    

    function parentPasswordValidtion($parent_password){ 
        //parent password validation
        if(!empty($parent_password)){
            if(strlen($parent_password) < 8){ // password validation
                return true;
                
            }
        }
    }
 


    // Insert child record into database

    function insertChild($first_name, $last_name, $father_name, $age, $dob, $gender, $room, $program, $parent_email, $connection, $error_array){
        // Insert command
        if(empty($error_array)){ // if no error then insert record
            $query = "INSERT INTO child (child_first_name, child_last_name, child_father_name, child_age, child_dob, child_gender, child_room, child_program, parent_email) VALUES ('$first_name', '$last_name', '$father_name', '$age', '$dob', '$gender', '$room', '$program', '$parent_email')";
            $execute_query = mysqli_query($connection, $query); // execute query
            if($execute_query){ // if query executed then return true otherwise return false
               return true; 
            }
        }
    }// end insertMessage function


    // Insert parent record into database
    function insertParent($parent_first_name, $parent_last_name, $parent_email, $parent_phone, $parent_password,$first_name, $last_name, $father_name, $age, $dob, $gender, $room, $program,  $connection, $error_array){
        // Insert command
        $parent_password = md5($parent_password); // for encrypted password
        if(empty($error_array)){ // if no error and child record inserted success into database then insert parent
            if(insertChild($first_name, $last_name, $father_name, $age, $dob, $gender, $room, $program, $parent_email, $connection, $error_array)){
                // select parent email for child table to make relation of parent and child
                $stmt = "SELECT * FROM child WHERE parent_email = '$parent_email' LIMIT 1" ;
                $execute_stmt = mysqli_query($connection, $stmt);
                if(mysqli_num_rows($execute_stmt) > 0 ){ // if record found then fetch child id
                    while($row = mysqli_fetch_assoc($execute_stmt)){
                        $child_id = $row['child_id'];
                    }
                    $query = "INSERT INTO parent(`parent_first_name`, `parent_last_name`, `parent_email`, `parent_phone_num`, `parent_pswd`, `child_id`) VALUES ('$parent_first_name', '$parent_last_name', '$parent_email', '$parent_phone', '$parent_password', '$child_id')";
                     $execute_query = mysqli_query($connection, $query); // execute query
                    if($execute_query){ // if query executed then return true otherwise return false and send verification email to parent
                        $receiver  = $parent_email; // parent mail
                        $sender = "usamaabdul7@gmail.com"; // sender mail
                        $subject = "Verification Message"; // email subject
                        $message = "Your Child " . $first_name. " ". $last_name. " has been register suucessfully at KidsPlus ChildCare"; // email message
                        $header = "From : $sender"; // email header
                        @mail($receiver, $subject, $message, $header); // send email to parent and return true
                        return true;
                    }
                    else{
                        return false;
                    } 
                }
                  
            }
            else{
                return false;
            }
        }//if

    }// end insertMessage function

    

    // call each child and parent input validation function and  store error into error variables and error array

    if(childFnameValidation($first_name)){
        $first_name_error = "Only letters are required!";
        array_push($error_array, $first_name_error); // add error into error_array
    }
    elseif(childLnameValidation($last_name)){
        $last_name_error = "Only letters are required!";
        array_push($error_array, $last_name_error); // add error into error_array
    }
    elseif(childFatherNameValidation($father_name)){
        $father_name_error = "Only letters are required!";
        array_push($error_array, $father_name_error ); // add error into error_array
    }
    elseif(childAgeValidation($age)){
        $age_error = "Only numeric digit are required!";
        array_push($error_array, $age_error); // add error into error_array
    }
    elseif(childGenderValidation($gender)){
        $gender_error = "Gender is required!";
         array_push($error_array,$gender_error); // add error into error_array
    }
    elseif(childRoomValidation($room)){
        $room_error = "Room is required!";
        array_push($error_array, $room_error); // add error into error_array
    }
    elseif(childProgramValidation($program)){
        $program_error = "Program is required!";
        array_push($error_array, $program_error); // add error into error_array
    }
    elseif($confirm_age !=  (int)$age){
        $date_error = "Invalid Date!";
        array_push($error_array, $date_error); // add error into error_array
    }
    elseif(parentFnameValidtion($parent_first_name)){ // Call parent validation functions
        $parent_first_name_error = "Only letters are required!";
        array_push($error_array, $parent_first_name_error); // add error into error_array
    }
    elseif(parentLnameValidtion($parent_last_name)){ 
        $parent_last_name_error = "Only letters are required!";
        array_push($error_array,  $parent_last_name_error); // add error into error_array
    }
    elseif(parentEmailValidtion($parent_email)){
        $parent_email_error = "Invalid email format!";
        array_push($error_array, $parent_email_error); // add error into error_array
    }
    elseif(parentPhoneNumberValidtion($parent_phone_number)){
        $parent_number_error = "Invalid phone number!";
        array_push($error_array, $parent_number_error); // add error into error_array
    }
    elseif(parentPasswordValidtion($parent_password)){
        $parent_password_error = "Your Password length should atleast or more then  8 character!";
        array_push($error_array, $parent_password_error); // add error into error_array
    }
    elseif($parent_confirm_password != $parent_password){
        $confirm_password_error = "Confirm Password didn't match";
        array_push($error_array, $confirm_password_error); // add error into error_array
    }
 


    if(empty($error_array)){ // if empty error no error in error array then
        // call InsertParent function and save both parent and child record into database     
        if(insertParent($parent_first_name, $parent_last_name, $parent_email, $parent_phone_number, $parent_password, $first_name, $last_name, $father_name, $age, $dob, $gender, $room, $program, $connection, $error_array)){ 
            // if the condition will true then  make success message otherwise error message
            $success_message = "Child Registration successfully";
        }
        else{
            $error_message = "Connection Error";
        }
    }
    



}// main if

// if paren and child will register then clear all inputs variable
if(!empty($success_message)){ 
    // clear child variables
    $first_name = "";
    $last_name = "";
    $father_name = "";
    $age = "";
    $dob = "";
    $gender = "";
    $room = "";
    $program = "";


    //  clear parent variable
    $parent_first_name = "";
    $parent_last_name = "";
    $parent_email = "";
    $parent_phone_number = "";
    $parent_password = "";
    $parent_confirm_password = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Admission</title>
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
<!-- include header file-->
<header class="header-section">
    <?php require  'header.php';?>
</header>
<!------------------ END  Header SECTION  ------------------>


<!------------------ Start Contact SECTION  ------------------>
<section class="container-fluid admission-sec public-section mt-5 mb-5">
    <div class="container contact-container ">
        <div class="row heading-row  mb-5 ">
            <div class="col-sm-12 col-md-12 col-lg-12 admission-heading text-center">
                <h1 class="text-info font-weight-bold">Enroll Your Child</h1>
                <div class="admission-hed-img mt-4">
                    <img src="assets/images/line-dec-2.png" alt="">
                </div><!--admission-hed-image-->
            </div><!--admission-heading-->
        </div><!--heading-row end-->
        <div class="row note-row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 note-item  p-4  alert alert-info">
                <h2 class="text-danger font-weight-bold">Important Note:</h2>
                <p class="text-danger mt-3 " style="font-size: 1.2em; font-weight: bold;">
                    KidsPlus ChildCare requires this form to be completed and all documentation
                    attached prior to your child’s first day of childcare with us. This information must be
                    completed by one of the child’s parents, who have lawful authority in relation to the child.
                </p>

            </div><!--note-item-->
        </div><!--note-row-->
        <div class="row admission-row">

            <!-- display error messages-->
            <?php if(!empty($success_message)):?>
                <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
                    <div class="alert alert-success">
                        <p class="text-success font-weight-bold mb-0"><?php echo  @$success_message; ?></p>
                    </div>
                </div>
           <?php endif;?>

           <?php if(!empty($error_message)):?>
                <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
                    <div class="alert alert-danger">
                        <p class="text-danger font-weight-bold mb-0"><?php echo  @$error_message ;?></p>
                    </div>
                </div>
           <?php endif;?>

           <!--admission form start-->

            <div class="col-sm-12 col-md-12 col-lg-8  offset-lg-2 admission-form">
                <div class=" child-details w-100 mb-4 ml-2"><h1 class="text-info font-weight-bold">Child Details</h1></div>
                <div class="form-wrapper w-100">
                    <form method="post" action="admission.php">

                        <div class="row input-row row-first">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">First Name:</label>
                                    <input type="text" name="ch-fname" class="form-control" placeholder="Enter First Name" value="<?php echo @$first_name; ?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$first_name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Last Name:</label>
                                    <input type="text" name="ch-lname" class="form-control" placeholder="Enter Last Name" value="<?php echo @$last_name;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$last_name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row/ row-first-->


                        <div class="row input-row row-second">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Father Name:</label>
                                    <input type="text" name="ch-father-name" class="form-control" placeholder="Enter Father Name" value="<?php echo @$father_name;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$father_name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Age:</label>
                                    <input type="text" name="ch-age" class="form-control" placeholder="Enter Child Age" value="<?php echo @$age;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$age_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / second-row-->

                        <div class="row input-row row-second">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Date of Birth:</label>
                                    <input type="date" name="ch-dob" class="form-control" value="<?php echo @$dob;?>" required >
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$date_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Gender:</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <?php if(!empty($gender)){?>
                                        <option value="<?php echo @$gender;?>" selected ><?php echo @$gender;?></option>
                                        <?php } else{?>
                                        <option value="Gender" selected >Select Gender</option>
                                        <?php } // else block?>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$gender_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / second-row-->

                        <div class="row input-row row-third">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label for="room" class="text-info ml-1 font-weight-bold">Select Room:</label>
                                    <select name="room" class="form-control" id="room">
                                        <?php if(!empty($room)){?>
                                            <option value="<?php echo @$room;?>"  selected><?php echo @$room;?></option>
                                        <?php } else{?>
                                            <option value="Select Room"  selected >Select Room</option>
                                        <?php } // else block?>
                                        <option value="Babies">Babies</option>
                                        <option value="Toddler">Toddler</option>
                                        <option value="Wobbler">Wobbler</option>
                                        <option value="Pre-School">Pre-School</option>
                                    </select>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$room_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->

                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label for="programs" class="text-info ml-1 font-weight-bold">Select Programs:</label>
                                    <select name="programs"  class="form-control" id="programs">
                                        <?php if(!empty($program)){?>
                                            <option value="<?php echo @$program;?>"  selected><?php echo @$program;?></option>
                                        <?php } else{?>
                                            <option value="Select Program" selected >Select Programs</option>
                                        <?php } // else block?>
                                        <option value="Half Day">Half Day</option>
                                        <option value="Full Day">Full Day</option>
                                        <option value="1 Day">1 Day</option>
                                        <option value="3 Day">3 Day</option>
                                        <option value="5 Day">5 Day</option>
                                    </select>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$program_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / third-row-->


                        <div class="parent-details w-100 mt-4 mb-4 ml-2"><h1 class="text-info font-weight-bold">Parent  Details</h1></div>

                        <div class="row input-row row-fourth">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">First Name / Username</label>
                                    <input type="text" name="pt-fname" class="form-control" placeholder="Enter First Name" value="<?php echo @$parent_first_name;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$parent_first_name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Last Name:</label>
                                    <input type="text" name="pt-lname" class="form-control" placeholder="Enter Last Name" value="<?php echo @$parent_last_name;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$parent_last_name_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row/ row-fourth-->


                        <div class="row input-row row-fifth">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Email:</label>
                                    <input type="email" name="pt-email" class="form-control" placeholder="Enter Email" value="<?php echo @$parent_email;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$parent_email_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Phone Number:</label>
                                    <input type="text" name="pt-phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo @$parent_phone_number;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$parent_number_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->

                        </div><!--input-row / row fifth-->

                        <div class="row input-row row-six">
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Password:</label>
                                    <input type="password" name="pt-password" class="form-control" placeholder="Enter Password" value="<?php echo @$parent_password;?>" required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$parent_password_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                            <div class="col-sm-12 col-md-6 col-lg-6 input">
                                <div class="form-group">
                                    <label  class="text-info ml-1 font-weight-bold">Confirm Password:</label>
                                    <input type="password" name="pt-cf-password" class="form-control" placeholder="Confirm Password"  required>
                                    <span class="text-danger mt-3 ml-1 error"><?php echo @$confirm_password_error;?></span>
                                </div><!--form-group-->
                            </div><!--input-->
                        </div><!--input-row / row six-->







                        <div class="row input-row row-third">
                            <div class="col-sm-12 col-md-12 col-lg-12 input">
                                <button type="submit" name="register-child" class="btn btn-md text-light btn-info ">Register Child</button>
                            </div><!--input-->
                        </div><!--input-row / third-row-->

                    </form>
                </div><!--form-wrapper-->
            </div><!--admission-form-->
        </div><!--admission-row-->
    </div><!--admission-container-->
</section>
<!------------------ END Contact SECTION  ------------------>


<!------------------ FOOTER Section Start  ------------------>
<!--include footer file-->
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