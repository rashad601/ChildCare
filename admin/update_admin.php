<?php

/*
    All the code in this page update admin  data from database and
    before update from database data will check its valid or not
    if data will valid then  update from database otherwise show error message to user
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
    $admin_id = $_GET['id']; // get admin id
    $query ="SELECT * FROM admin WHERE id = $admin_id"; // check if admin exist then fetch record of that admin and diplay into inputs fields
    $execute_query = mysqli_query($connection, $query); 
    if(mysqli_num_rows($execute_query) > 0){
        while($row = mysqli_fetch_assoc($execute_query)){
            $id = $row['id'];
            $name = $row['name'];
            $email= $row['email'];
        }    
    }
    else{
        $error  = "Connection Error!";
    }
}//if
if(isset($_POST['update-admin'])) { // check: if user submit staff
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting staff input data
    $id = htmlentities($_POST['id']);
    $name = htmlentities($_POST['name']);
    $email= htmlentities($_POST['email']);



    //validate staff  first name

    if (!empty($name)) {
        trim($name); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $name)) {
            $name_error = "Only letters are required!";
            array_push($error_array, $name_error); // add error into error_array
        }
    }

    if (!empty($email)) {
        trim($email); // trim extra spaces on left and right side of data
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format!";
            array_push($error_array, $email_error); // add error into error_array
        }
    }





    if(empty($error_array)){
        // Update Admin
        //execute query
        $query = "UPDATE admin SET name = '$name', email = '$email' WHERE id = $id";
        if(mysqli_query($connection, $query)){
            $success = "Admin update successfully";
            header("location:admins.php?success=$success");
        }
        else{
            $error = "Connection error";
            header("location:admins.php?error=$error");
        }
    }


    if(!empty($success)){
        $name = "";
        $password = "";
        $email = "";
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
    <title>Update Admin</title>
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
            <h1 class="text-danger font-weight-bold"> Update Admin</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->

    <div class="row error-row">
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

    </div><!--error-row end-->


    <div class="row add-staff-row">
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 staff-form">
            <form method="post" action="update_admin.php">

                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <input type="text" name="id" class="form-control"value="<?php echo @$id;?>" hidden required>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row -->  

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo @$name; ?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$name_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?php echo @$email;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$email_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <button type="submit" name="update-admin" class="btn btn-md text-light btn-info  ">Update Admin</button>
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