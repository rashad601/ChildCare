<?php
/*
    All the script in this page update staff data from database and
    before update from database the data will check it's valid or not
    if data will valid then  store from database otherwise show error message to user 
*/

// start session
session_start();


// Include database file
require '../database/connection.php';
// include authentication file
require 'authentication.php';

// declare error array
$error_array = array();
if(isset($_GET['id'])){
    $staff_id = $_GET['id']; //get staff id
    $query ="SELECT * FROM staff WHERE id = $staff_id"; // get staff record if exist
    $execute_query = mysqli_query($connection, $query); 
    if(mysqli_num_rows($execute_query) > 0){
        while($row = mysqli_fetch_assoc($execute_query)){
            $id = $row['id'];
            $first_name = $row['fname'];
            $last_name = $row['lname'];
            $job = $row['job'];
            $message = $row['about'];
            $image = $row['image'];
        }
    }
    else{
        $error  = "Connection Error!";
    }
}//if

if(isset($_POST['update-staff']) && isset($_FILES['image'])) { // check: if user submit update staff
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting staff input data
    $id =  htmlentities($_POST['id']);
    $first_name = htmlentities($_POST['staff-fname']);
    $last_name = htmlentities($_POST['staff-lname']);
    $job = htmlentities($_POST['job']);
    $image = $_FILES['image']['name'];
    $image_name = htmlentities($_POST['image-name']);
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

    // image validation    
     if(!empty($image)){
        $ext = array('png', 'jpg', 'jpeg'); // image extensions array
        $image_ext = pathinfo($image, PATHINFO_EXTENSION); // get image extension
        if(!in_array($image_ext, $ext)){ // check if  image extension does not found in array then rais error 
            $image_error = "You can only upload png, jpg or jpeg file!";
            $image = $image_name;
            array_push($error_array, $image_error);

        }
    }

    // if image empty then set default image
    if(empty($image)){
        $image = $image_name;
    }

    if(empty($error_array)){
        //Update staff 
        // execute query
        $query = "UPDATE staff SET fname = '$first_name', lname = '$last_name', job = '$job', about = '$message', image = '$image' WHERE id = '$id'";
        if(mysqli_query($connection, $query)){
            $upload_dir = "../assets/upload/".$image; // set path of store image
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir); // upload image on upload directory
            $success = "Staff Update successfully";
            header("location:staff.php?success=$success");
        }
        else{
            $error = "Connection error";
            header("location:staff.php?error=$error");
        }
    }


}//  if


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Update Staff</title>
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
            <h1 class="text-danger font-weight-bold"> Update Staff's</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->
    <div class="row add-staff-row">
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 staff-form">
            <form method="post" action="update_staff.php" enctype="multipart/form-data">

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <input type="text" name="id" class="form-control"  value="<?php echo @$id;?>" hidden >
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->


                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <input type="text" name="image-name" class="form-control"  value="<?php echo @$image;?>" hidden >
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->




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
                            <input type="file" name="image" class="form-control"  id="myImage">
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
                        <button type="submit" name="update-staff" class="btn btn-md text-light btn-info  ">Update Staff</button>
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