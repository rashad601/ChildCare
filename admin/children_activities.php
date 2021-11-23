<?php
/*
    In this page, admin can see all the children activites, update and delete them also   
*/

//session start
session_start();
require '../database/connection.php';
// include authentication file
require 'authentication.php';

//get success and error message
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
    <title>Daily Activities</title>
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
<?php require  'header.php';?>
<!------------------ END  Header SECTION  ------------------>


<!------------------ parent Section Start  ------------------>
<section class="container parent-section admin-section mt-5 mb-5" >
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold"> Children Daily Activities</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->

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
            <div class="content d-flex justify-content-start flex-row w-100">
                <form method="post" action="filter_children_activity.php" class="d-flex justify-content-start flex-row"> 
                    <div class="form-group">
                        <label class="text-success ml-1 font-weight-bold">Filter Activity By Name:</label>
                        <input type="text" name="filter-act" placeholder="Filter Activity By Name" class="form-control rounded-0" style="box-shadow: none !important; ">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="filter" class="btn btn-md btn-info text-light rounded-0" style="margin: 32px 0px; padding:6px 15px;">Filter</button>
                    </div>
                </form>
            </div><!--content-->
        </div><!--filter-record-->
    </div><!--filter-row-->


    <div class="row table-row">
        <div class="col-sm-12 col-md12 col-lg-12 staff-table ">
            <table class="table-striped table-hover table-bordered table table-responsive-md">
                <thead class="bg-warning text-center text-dark">
                <tr>
                    <th class="bg-danger border-danger text-light">Sr.</th>
                    <th class="bg-warning border-warning text-light">Name</th>
                    <th class="bg-info border-info text-light">Temperature</th>
                    <th class="bg-success border-success text-light">BreakFast</th>
                     <th class="bg-warning border-warning text-light">Lunch</th>
                    <th class="bg-dark border-dark text-light">Activity</th>
                    <th class="bg-danger border-danger text-light">Date</th>
                    <th class="bg-success border-success text-light">Operations</th>
                </tr>
                </thead>
                <tbody class="text-center text-dark">
                <?php

                    // fetch all daily activities
                    $query = "SELECT * FROM daily_activity";
                        $execute_query = mysqli_query($connection, $query);
                        if(mysqli_num_rows($execute_query) > 0){
                            while($row = mysqli_fetch_assoc($execute_query)){
                                $id = $row['id'];
                ?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['temperature'];?></td>
                    <td><?php echo $row['breakfast'];?></td>
                    <td><?php echo $row['lunch'];?></td>
                    <td><?php echo $row['activity'];?></td>
                    <td><?php echo $row['activity_date'];?></td>
                    <td>
                        <a href="update_child_activity.php?id=<?php echo $id ;?> " class="btn btn-success bg-success btn-sm ">Update</a>
                        <a href="delete_child_activity.php?id=<?php echo $id ;?> " class="btn btn-danger bg-danger btn-sm ">Delete</a>
                    </td>
                </tr>
                  
                <?php
                    }// while
                    }// second query iff
                ?>
                </tbody>
            </table>
        </div>
    </div><!--table-row-->

</section>
<!------------------ Parent Section End  ------------------>

<?php require  'footer.php';?>

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