<?php
    /*
        In this page, Parent and admin can change their password if they are forgot their password
    */

    // session start
    session_start();
    // require database file
    require 'database/connection.php';   

    // fetch record by email so we can find easily who want to forgot password admin or parent    
    if(isset($_GET['email'])){
        $email = $_GET['email'];
        $check_parent_mail = "SELECT * FROM parent WHERE parent_email = '$email'"; // select email from parent if exist
        $execute_parent_query = mysqli_query($connection, $check_parent_mail);
        if(mysqli_num_rows($execute_parent_query) > 0){// if exist then save fetch into email variable
            while($row = mysqli_fetch_assoc($execute_parent_query)){ 
                $email = $row['parent_email'];
            }//while
        }//if
        else{
            $check_admin_mail = "SELECT * FROM admin WHERE email = '$email'";// select email from admin table if exist
            $execute_admin_query = mysqli_query($connection, $check_admin_mail);
            if(mysqli_num_rows($execute_admin_query) > 0){// if exist then save fetch into email variable
                while($row = mysqli_fetch_assoc($execute_admin_query)){
                    $email = $row['email'];
                }//while
            }//if

        }//else
    }//if


    if(isset($_POST['forgot-password'])){ // if user want to forgot his/her password then fetching all information from inputs field
        $email = htmlentities(($_POST['email'])); 
        $password = htmlentities(($_POST['password']));
        $confirm_password = htmlentities(($_POST['cf-password']));
        $password  = trim($password);
        $confirm_password = trim($confirm_password);

        // password validation process
        if($password != $confirm_password){
             $error_message = "Password didn't match!"; 
        }//if
        elseif(strlen($password) < 8){
            $error_message = "Your Password length should atleast or more then  8 character!";
        }//else if
        else{
            $check_admin_mail = "SELECT * FROM admin WHERE email = '$email'"; // select email from admin table if exist
            $execute_admin_query = mysqli_query($connection, $check_admin_mail);
            if(mysqli_num_rows($execute_admin_query) > 0){ // if exist then fetch id and store into id vvarible for update password
                while($row = mysqli_fetch_assoc($execute_admin_query)){
                    $id = $row['id'];
                }
                $password = md5($password);
                $update_admin_pass = "UPDATE admin SET password = '$password'  WHERE id = $id"; // update password of that admin which  id will found
                $execute_admin_query = mysqli_query($connection, $update_admin_pass);
                if($execute_admin_query){
                    $success = "Your password has been changed!";
                    header("location:login.php?success=$success");
                }//if
                else{
                    $error_message = "Something went wrong! Please try again!";
                }//else
            }//if
            else{
                $check_parent_mail = "SELECT * FROM parent WHERE parent_email = '$email'";// select email from admin table if exist
                $execute_parent_query = mysqli_query($connection, $check_parent_mail);
                if(mysqli_num_rows($execute_parent_query) > 0){// if exist then fetch id and store into id vvarible for update password
                    while($row = mysqli_fetch_assoc($execute_parent_query)){
                        $id = $row['id'];
                    }
                    $password = md5($password);
                    $update_parent_pass = "UPDATE parent SET parent_pswd = '$password'  WHERE parent_id = $id"; // update password of that parent which  id will found
                    $execute_parent_update_query = mysqli_query($connection, $update_parent_pass);
                    if($execute_parent_update_query){
                        $success = "Your password has been changed!";
                        header("location:login.php?success=$success");
                    }//if
                    else{
                        $error_message = "Something went wrong! Please try again!";
                    }//else
                }//if 
            }// else
            
        }// else
        

    }//if
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Reset Password</title>
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

<!------------------ Start Login SECTION  ------------------>
<section class="container login-sec public-section mt-5 mb-5">
    <div class="row login-row">
        <div class="col-sm-12 col-md-12 col-lg-4 offset-lg-4 login-box">
            <div class="login-form  ">
                <div class="login-title w-100 bg-info text-center p-2">
                    <h2 class="text-light">Reset Password</h2>
                </div><!--login-title-->
                <!--display error message-->
                <?php if(!empty($error_message)):?>
                    <div class="alert alert-danger m-4">
                        <p class="text-danger font-weight-bold mb-0"><?php echo @$error_message;?></p>
                    </div>
                <?php endif;?>

                <!--forgot password form-->
                <form method="post" action="forgot_password.php" class="p-4">
                    <div class="form-group mb-4">
                        <input type="email" name="email"  value="<?php echo $email;?>" class="form-control" hidden required>
                    </div><!--form-group-->
                    <div class="form-group mb-4">
                        <label class="text-info font-weight-bold ml-1">New Password:</label>
                        <input type="password" name="password" placeholder="Enter Password" required  class="form-control">
                    </div><!--form-group-->
                    <div class="form-group mb-4">
                        <label class="text-info font-weight-bold ml-1">Confirm Password:</label>
                        <input type="password" name="cf-password" placeholder="Confirm Password" required  class="form-control">
                    </div><!--form-group-->
                    <div class="form-group mb-2">
                        <button type="submit" name="forgot-password" class="btn btn-info form-control font-weight-bold">Reset</button>
                    </div><!--form-group-->



                </form>
            </div><!--login-form-->
        </div><!--login-box-->
    </div><!--login-row-->
</section><!--login-sec-->
<!------------------ END  HLogin SECTION  ------------------>


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