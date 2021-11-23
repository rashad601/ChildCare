<?php
/*
    In this page , Php script diaplay the feedback of parent which are all stored into database
    and show them to admin, also admin can delete or verified these feedback

*/
//session start
session_start();
// include require files
require '../database/connection.php';
require 'authentication.php';

// if admin want to delete feedback then run this script after clicking on delet button
if(isset($_GET['id'])){
    $feedback_id = $_GET['id']; // get id of feedback which we are going to delete
    $query  = "DELETE FROM feedback WHERE id = $feedback_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete feedback
        $success = "Delete Feedback Successfully";
    }
    else{
        $error = "Connection Error";
    }
}

// for get messages
if(isset($_GET['success'])){
    $success = $_GET['success'];
}
if(isset($_GET['error'])){
    $error = $_GET['error'];
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

<!------------------ Admin  Section Start  ------------------>
<section class="container admin-section mt-5 mb-5" >
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold">FeedBack</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->

    <!--display success  messages-->
    <?php if(!empty($success)):?>
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
            <div class="alert alert-success">
                <p class="text-success font-weight-bold mb-0"><?php echo  @$success;?></p>
            </div>
        </div>
    <?php endif;?>

    <!--display error message-->
    <?php if(!empty($error)):?>
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
            <div class="alert alert-danger">
                <p class="text-danger font-weight-bold mb-0"><?php echo  @$error;?></p>
            </div>
        </div>
    <?php endif;?>


    <div class="row table-row">
        <div class="col-sm-12 col-md12 col-lg-12 program-table ">
            <table class="table table-striped table-hover table-bordered table-responsive-md">
                <thead class="bg-info text-center text-light">
                <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Service Name</th>
                    <th>Comment</th>
                    <th >Operations</th>
                </tr>
                </thead>
                <tbody class="text-center ">
                <?php
                    // fetch all the feedback from database and display them to admin
                    $query = "SELECT * FROM feedback";
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){
                         while($row = mysqli_fetch_assoc($execute_query)){
                            $id = $row['id'];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['date'];?></td>
                    <td><?php echo $row['service'];?></td>
                    <td><p class="text-dark"><?php echo chunk_split(substr($row['feedback'], 0, 25), strlen($row['feedback']), ".........");?></p></td>
                    <td>
                        <?php if($row['verified'] == 0){?> <!--if cerified will 0 then disply this button otherwise display else block button -->
                        <a href="feedback_verification.php?id=<?php echo $id;?>" class="btn btn-success text-light btn-sm font-weight-bold">Verify</a>
                        <?php }else{?>
                            <a href="#" class="btn btn-success text-light btn-sm font-weight-bold disabled " >Verified</a>
                        <?php
                        }?>
                        <a href="feedback.php?id=<?php echo $id;?>" class="btn btn-danger text-light btn-sm font-weight-bold">Delete</a>
                    </td>
                </tr>
                <?php
                     }//while
                    }//if
                ?>
                </tbody>
            </table>
        </div>
    </div><!--table-row-->


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