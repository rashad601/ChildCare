<?php
/*
    In this page, admin can see all the  activites add, update and delete them also   
*/
    //session start
session_start();
require '../database/connection.php';
require 'authentication.php';


// get success and error message
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
    <title>Activities</title>
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
            <h1 class="text-danger font-weight-bold">Staff's</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->
    <!--error and success message-->
     <div class="row error-row ">
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

    </div><!--error-row-->

    <div class="row filter-row">
        <div class="col-sm-12 col-md-12 col-lg-12 filter-record">
            <div class="content d-flex justify-content-between flex-row w-100">
                <div class="add-btn">
                    <a href="add_activity.php" class=" mr-2 mt-4 bg-warning text-dark " style="margin-bottom: 10px !important;" >Add Activity</a>
                </div>
            </div><!--content-->
        </div><!--filter-record-->
    </div><!--filter-row-->

    <div class="row table-row">
        <div class="col-sm-12 col-md12 col-lg-12 staff-table ">
            <table class="table-striped table-hover table-bordered table table-responsive-md">
                <thead class="bg-warning text-center text-dark">
                <tr>
                    <th>Sr.</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Description</th>
                    <th >Operations</th>
                </tr>
                </thead>
                <tbody class="text-center text-dark">
                <?php
                    // fetch all the activities
                    $query = "SELECT * FROM activity";
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){
                         while($row = mysqli_fetch_assoc($execute_query)){
                            $id = $row['id'];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $row['title'];?></td>
                    <td><?php echo $row['activity_date'];?></td>
                    <td><?php echo $row['start_time'];?></td>
                    <td><?php echo $row['end_time'];?></td>
                    <td><p class="text-dark"><?php echo chunk_split(substr($row['description'], 0, 25), strlen($row['description']), ".........");?></p></td>
                    <td>
                        <a href="update_activity.php?id=<?php echo $id; ?>" class="btn btn-success text-light btn-sm font-weight-bold ">Update</a>
                        <a href="delete_activity.php?id=<?php echo $id; ?>" class="btn btn-danger text-light btn-sm font-weight-bold">Delete</a>
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

<!------------------ FOOTER Section Start  ------------------>
<footer class="container-fluid footer d-flex justify-content-center align-items-center pt-2">
    <p class="text-center mt-1">&copy; Copyright 2021 KidsPlus</p>
</footer>
<!------------------ FOOTER Section End  ------------------>

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