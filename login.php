<?php
    /*
        In this page, Parent anfd admin login their account for thier purposes
        This is the login script which handle login infomation and validation of parend and admin record
    */

    //session start    
    session_start();
    // require database file
    require 'database/connection.php';

    if(isset($_POST['login'])){ // if user want to login then execute if block otherwise go to else block
        // fetching all input data
        $username = htmlentities($_POST['username']);
        $password = htmlentities(($_POST['password']));
        $username = trim($username);
        $password = trim($password);
        $password = md5($password); // encrypt the password
        $stmt = "SELECT * FROM admin WHERE name = '$username' AND password = '$password' "; // check admin exist or not
        $execute_statement = mysqli_query($connection, $stmt);
        if(mysqli_num_rows($execute_statement) > 0){ // if exist then login as an admin go to the dashboad page
            $_SESSION['admin'] = $username; // create session of admin and start session of admin
            header("location:admin/dashboard.php");
        }
        else{
            $query = "SELECT * FROM parent WHERE parent_first_name = '$username' AND parent_pswd = '$password' ";// check parent exist or not
            $execute_query = mysqli_query($connection, $query);
            if(mysqli_num_rows($execute_query) > 0){// if exist then login as anparent go to the index page
                while($row = mysqli_fetch_assoc($execute_query)){
                    $_SESSION['parent_id'] = $row['parent_id'];// create session of child and start session of child
                    $_SESSION['parent'] = $row['parent_first_name'];// create session of parent and start session of parent
                }
                
                header("location:index.php");
            }
            else{
                $error_message = "Wrong username or password!"; // otherwise make error
            }
        }

    }

    // get success message from another page like forgot password or generate password link
    if(isset($_GET['success'])){
        $success = $_GET['success'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Login</title>
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

    <!--dhow success message-->
    <div class="row error-row ">
     <?php if(!empty($success)):?>
            <div class="col-sm-12 col-md-12 col-lg-8  offset-lg-2 mb-4">
                <div class="alert alert-success">
                    <p class="text-success font-weight-bold mb-0"><?php echo  @$success;?></p>
                </div>
            </div>
        <?php endif;?>
    </div><!--error-row-->


    <!--display login-form-->
    <div class="row login-row">
        <div class="col-sm-12 col-md-12 col-lg-4 offset-lg-4 login-box">
            <div class="login-form  ">
                <div class="login-title w-100 bg-info text-center p-2">
                    <h2 class="text-light">Login</h2>
                </div><!--login-title-->
                <!--display error message-->
                <?php if(!empty($error_message)):?>
                    <div class="alert alert-danger m-4">
                        <p class="text-danger font-weight-bold mb-0"><?php echo @$error_message;?></p>
                    </div>
                <?php endif;?>
                <form method="post" action="login.php" class="p-4">
                    <div class="form-group mb-4">
                        <label class="text-info font-weight-bold ml-1">Username:</label>
                        <input type="text" name="username" placeholder="Enter Username " required  class="form-control">
                    </div><!--form-group-->
                    <div class="form-group mb-4">
                        <label class="text-info font-weight-bold ml-1">Password:</label>
                        <input type="password" name="password" placeholder="Enter Password" required  class="form-control">
                    </div><!--form-group-->
                    <div class="form-group mb-2">
                        <button type="submit" name="login" class="btn btn-info form-control font-weight-bold">Login</button>
                    </div><!--form-group-->
                    <div class="forgot-password w-100  text-center">
                        <a href="generate_link.php" class="text-info" style="font-size: 1em;">Forgot Password ?</a>
                    </div><!--forgot-password-->


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