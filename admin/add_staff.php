<?php

/*
    All the code in this page submit staff data into database and
    before stored into database data will check its valid or not
    if data will valid then  store into database otherwise show error message to user
*/

// start session
session_start();
// Include database file
require '../database/connection.php';
// include authentication file
require 'authentication.php';



// declare error array
$error_array = array();
if(isset($_POST['add-staff']) && isset($_FILES['image'])) { // check: if user submit staff
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting staff input data
    $first_name = htmlentities($_POST['staff-fname']);
    $last_name = htmlentities($_POST['staff-lname']);
    $job = htmlentities($_POST['job']);
    $image = $_FILES['image']['name'];
    $message = htmlentities($_POST['message']);



    //validate staff  first name

    if (!empty($first_name)) {
        trim($first_name); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $first_name)) {
            $first_name_error = "Only letters are required!";
            array_push($error_array, $first_name_error); // add error into error_array
        }
    }


    // validate staff last name
    if (!empty($last_name)) {
        trim($last_name); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $last_name)) {
            $last_name_error = "Only letters are required!";
            array_push($error_array, $last_name_error); // add error into error_array

        }
    }

    // validate staff job
    if (!empty($job)) {
        trim($job); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $job)) {
            $job_error = "Only letters are required!";
            array_push($error_array, $job_error); // add error into error_array
        }
    }

    //Image Validation
     if(!empty($image)){
        $ext = array('png', 'jpg', 'jpeg'); // image extensions
        $image_ext = pathinfo($image, PATHINFO_EXTENSION); // get image extensions and check 
        if(!in_array($image_ext, $ext)){// if dose not exist in array then return true
            $image_error = "You can only upload png, jpg or jpeg file!";
            array_push($error_array, $image_error);

        }
    }


    if(empty($error_array)){
        // Insert Staff
        $query = "INSERT INTO staff (fname, lname, job, about, image) VALUES ('$first_name', '$last_name', '$job', '$message', '$image')";
        if(mysqli_query($connection, $query)){
            $upload_dir = "../assets/upload/".$image;
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir);
            $success = "Staff Added successfully";
        }
        else{
            $error = "Connection error";
        }
    }


    if(!empty($success)){
        $first_name = "";
        $last_name = "";
        $job = "";
        $image = "";
        $message = "";
    }


}// main if

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Add Staff</title>
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

<!------------------ Admin Section Start  ------------------>
<section class="container admin-section mt-5 mb-5" >
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold"> Add Staff's</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->
    <div class="row add-staff-row">
        <?php if(!empty($success)):?>
            <div class="col-sm-12 col-md-12 col-lg-8  offset-lg-2 mb-4">
                <div class="alert alert-success">
                    <p class="text-success font-weight-bold mb-0"><?php echo  @$success;?></p>
                </div>
            </div>
        <?php endif;?>

        <?php if(!empty($error)):?>
            <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2  mb-4">
                <div class="alert alert-danger">
                    <p class="text-danger font-weight-bold mb-0"><?php echo  @$error;?></p>
                </div>
            </div>
        <?php endif;?>
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 staff-form">
            <form method="post" action="add_staff.php" enctype="multipart/form-data">

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">First Name:</label>
                            <input type="text" name="staff-fname" class="form-control" placeholder="Enter First Name" value="<?php echo @$first_name; ?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$first_name_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Last Name:</label>
                            <input type="text" name="staff-lname" class="form-control" placeholder="Enter Last Name" value="<?php echo @$last_name;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$last_name_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->


                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Job:</label>
                            <input type="text" name="job" class="form-control" placeholder="Enter Job Title" value="<?php echo @$job;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$job_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Staff Image:</label>
                            <input type="file" name="image" class="form-control"  id="myImage" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$image_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">About Staff:</label>
                            <textarea type="text" name="message"  class="form-control w-100 text-dark" rows="5" placeholder="About Staff"  required><?php echo @$message; ?></textarea>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / third-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <button type="submit" name="add-staff" class="btn btn-md text-light btn-info  ">Add Staff</button>
                    </div><!--input-->
                </div><!--input-row / third-row-->

            </form>

        </div><!--staff-form-->
    </div><!--add-staff-row-->

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