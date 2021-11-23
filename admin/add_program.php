<?php

/*
    All the code in this page submit program data into database and
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
if(isset($_POST['add-program']) && isset($_FILES['image'])) { // check: if user submit program
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting program input data
    $title = htmlentities($_POST['title']);
    $class_size = htmlentities($_POST['class-size']);
    $age = htmlentities($_POST['age']);
    $program = htmlentities($_POST['programs']);
    $image = $_FILES['image']['name'];
    $message = htmlentities($_POST['message']);



    //validate offer title

    if (!empty($title)) {
        trim($title); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $title)) {
            $title_error = "Only letters are required!";
            array_push($error_array, $title_error); // add error into error_array
        }
    }


    // validate class size
    if (!empty($class_size)) {
        trim($class_size); // trim extra spaces on left and right side of data
        if (!preg_match("/^[0-9]*$/", $class_size)) {
            $class_size_error = "Only numeric digits are required!";
            array_push($error_array, $class_size_error); // add error into error_array

        }
    }

    // validate class age 
    if(!empty($age)){
        if($age === "Select Age"){
            $age_error = "Age is required!";
            array_push($error_array, $age_error); // add error into error_array
        }
    }

    // validate class program 
    if(!empty($program)){
        if($program === "Select Program"){
            $program_error = "Program is required!";
            array_push($error_array, $program_error); // add error into error_array
        }
    }

    // Image validation
    if(!empty($image)){
        $ext = array('png', 'jpg', 'jpeg'); // image extensions
        $image_ext = pathinfo($image, PATHINFO_EXTENSION); // get image extensions and check 
        if(!in_array($image_ext, $ext)){// if dose not exist in array then return true
            $image_error = "You can only upload png, jpg or jpeg file!";
            array_push($error_array, $image_error);

        }
    }
    


    if(empty($error_array)){
        //Insert Program
        $query = "INSERT INTO program (title, about, class_size, child_age, program, image) VALUES ('$title', '$message', '$class_size', '$age', '$program', '$image')";
        if(mysqli_query($connection, $query)){
            $upload_dir = "../assets/upload/".$image;
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir);
            $success = "Program Added successfully";
        }
        else{
            $error = "Connection error";
        }
    }


    if(!empty($success)){
        $title = "";
        $class_size = "";
        $age = "";
        $program = "";
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
    <title>Add Program</title>
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
<section class="container admin-section mt-5 mb-5">
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold"> Add Programs</h1>
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
            <form method="post" action="add_program.php" enctype="multipart/form-data">

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Title:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo @$title; ?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$title_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Class Size:</label>
                            <input type="text" name="class-size" class="form-control" placeholder="Enter Class Size" value="<?php echo @$class_size;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$class_size_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label for="age" class="text-info ml-1 font-weight-bold">Select Age:</label>
                            <select name="age"  class="form-control" id="age">
                                <?php if(!empty($age)){?>
                                    <option value="<?php echo @$age;?>"  selected><?php echo @$age;?></option>
                                <?php } else{?>
                                    <option value="Select Age" selected >Select Age</option>
                                <?php } // else block?>
                                    <option value="1-2">1-2</option>
                                    <option value="2-4">2-4</option>
                                    <option value="4-6">4-6</option>
                            </select>
                                <span class="text-danger mt-3 ml-1 error"><?php echo @$age_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label for="programs" class="text-info ml-1 font-weight-bold">Select Programs:</label>
                            <select name="programs"  class="form-control" id="programs">
                                <?php if(!empty($program)){?>
                                    <option value="<?php echo @$program;?>"  selected><?php echo @$program;?> Day</option>
                                <?php } else{?>
                                    <option value="Select Program" selected >Select Programs</option>
                                <?php } // else block?>
                                    <option value="Half">Half Day</option>
                                    <option value="Full">Full Day</option>
                                    <option value="1">1 Day</option>
                                    <option value="3">3 Day</option>
                                    <option value="5">5 Day</option>
                            </select>
                                <span class="text-danger mt-3 ml-1 error"><?php echo @$program_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->


                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Image:</label>
                            <input type="file" name="image" class="form-control"  id="myImage" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$image_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Description:</label>
                            <textarea type="text" name="message"  class="form-control w-100 text-dark" rows="5" placeholder="Description"  required><?php echo @$message; ?></textarea>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / third-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <button type="submit" name="add-program" class="btn btn-md text-light btn-info ">Add Program</button>
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