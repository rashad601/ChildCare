<?php
    /*
        In this page, parent get forgot password link on their email which they provide us  at registration time
    */
    //session_start
    session_start();
    // include database connection file
    require 'database/connection.php';
    if(isset($_POST['send-link'])){ //if user want to get link of forgot password then 
        $email = htmlentities($_POST['email']); // fetching user email
        $stmt = "SELECT * FROM admin WHERE email = '$email'"; // check this email exist or not in admin table
        $execute_statement = mysqli_query($connection, $stmt);
        if(mysqli_num_rows($execute_statement) > 0){ // if exist then send reset password link to their email
            $receiver  = $email;
            $sender = "usamaabdul7@gmail.com"; // sender mail
            $subject = "Forgot password link"; // email subject
            $link = "<a href='https://knuth.griffith.ie/~s3011592/SWD/forgot_password.php?email=$email' class='btn btn-sm btn-danger'>Reset</a>";
            $message = '<html>
                            <body>
                                <h3>Click on button for reset password - '.$link.'</h3>
                            </body>
                        </html>'; // email message
            $headers = "From :".$sender."\r\n"; // email header
            $headers .= "MIME-Version: 1.0\r\n"; // email version
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; // email content type text or html
            if(mail($receiver, $subject, $message, $headers)){ // send mail to the user , user can be admin or parent
                $success = "Reset Password link has been sent into your mail";
                header("location:login.php?success=$success");
            }

        } // if record not found on admin then check on parent table 
        else{
            $query = "SELECT * FROM parent WHERE parent_email = '$email'"; // check this email exist or not in admin table
            $execute_query = mysqli_query($connection, $query);
            if(mysqli_num_rows($execute_query) > 0){ // if exist then send reset password link to their email
                $receiver  = $email;
                $sender = "usamaabdul7@gmail.com"; // sender mail
                $subject = "Forgot password link"; // email subject
                $link = "<a href='https://knuth.griffith.ie/~s3011592/SWD/forgot_password.php?email=$email' class='btn btn-sm btn-danger'>Reset</a>";
                $message = '<html>
                            <body>
                                <h3>Click on button for reset password - '.$link.'</h3>
                            </body>
                        </html>'; // email message
                $headers = "From :".$sender."\r\n"; // email header
            	$headers .= "MIME-Version: 1.0\r\n";// email header
            	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";// email content type text or html
                if(mail($receiver, $subject, $message, $headers)){
                    $success = "Reset Password link has been sent into your mail";// send mail to the user , user can be admin or parent
                    header("location:login.php?success=$success");
                }
            }
            else{
                $error_message = "No Account Found!";
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!---- Required  Meta Tags ---->
    <meta charset="UTF-8">
    <meta name="viewport" content = "width=device-width, initial-scale = 1.0" >
    <meta name="author" content="">
    <title>Forgot Password</title>
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
                    <h2 class="text-light">Forgot Password</h2>
                </div><!--login-title-->

                <!--display error message-->
                <?php if(!empty($error_message)):?>
                    <div class="alert alert-danger m-4">
                        <p class="text-danger font-weight-bold mb-0"><?php echo @$error_message;?></p>
                    </div>
                <?php endif;?>

                <!--Forgot Password Form-->
                <form method="post" action="generate_link.php" class="p-4">
                    <div class="form-group mb-4">
                        <label class="text-info font-weight-bold ml-1">Email</label>
                        <input type="email" name="email" placeholder="Enter Email " required  class="form-control">
                    </div><!--form-group-->
                    <div class="form-group mb-2">
                        <button type="submit" name="send-link" class="btn btn-info form-control font-weight-bold">Send</button>
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