<?php
/*
    All the script in this page update children activity data into database and
    before update from database the data will check it's valid or not
    if data will valid then  update from database otherwise show error message to user 
*/
//session start
session_start();
require '../database/connection.php';
// include authentication file
require 'authentication.php';

$error_array = array();
if(isset($_GET['id'])){
    $activity_id = $_GET['id']; // get activity id
    $today_date = date("Y-m-d"); // create today date
    $query = "SELECT * FROM daily_activity WHERE id = $activity_id"; // select activity from daily activity table from datbase
    $execute_query = mysqli_query($connection, $query);
    if(mysqli_num_rows($execute_query) > 0){
        while($row = mysqli_fetch_array($execute_query)){
            // fetch child daily activity record
            $id = $row['id'];
            $fname = $row['name'];
            $temp = $row['temperature'];
            $breakfast = $row['breakfast'];
            $lunch = $row['lunch'];
            $activity = $row['activity'];
            $today_date = $row['activity_date'];
        }
    }
}
elseif(isset($_POST['update-activity'])){ // update child daily activity

    // gettimg all inout fields value and stored into variables
    $activity_id = htmlentities($_POST['id']);
    $fname = htmlentities($_POST['fname']);
    $temp = htmlentities($_POST['temp']);
    $breakfast = htmlentities($_POST['breakfast']);
    $lunch = htmlentities($_POST['lunch']);
    $activity = htmlentities($_POST['activity']);
    $today_date = date('Y-m-d', strtotime(htmlentities($_POST['date'])));


    if (!empty($fname)) {
        trim($fname); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $fname)) {
            $fname_error = "Only letters are required!";
            array_push($error_array, $fname_error); // add error into error_array
        }
    }




    if (!empty($temp)) {
        trim($temp); // trim extra spaces on left and right side of data
        if (!preg_match("/^[0-9.]*$/", $temp)) {
            $temp_error = "Only numeric digits are required!";
            array_push($error_array, $temp_error); // add error into error_array
        }
    }


    if (!empty($breakfast)) {
        trim($breakfast); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $breakfast)) {
            $breakfast_error = "Only letters are required!";
            array_push($error_array, $breakfast_error); // add error into error_array
        }
    }


    if (!empty($lunch)) {
        trim($lunch); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $lunch)) {
            $lunch_error = "Only letters are required!";
            array_push($error_array, $lunch_error); // add error into error_array
        }
    }


    if (!empty($activity)) {
        trim($activity); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $activity)) {
            $activity_error = "Only letters are required!";
            array_push($error_array, $activity_error); // add error into error_array
        }
    }


    if(empty($error_array)){
        // Update child daily activity
        $name = $fname." ".$lname; // concat child first and last name
        $query = "UPDATE daily_activity SET name='$fname', temperature='$temp', breakfast='$breakfast', lunch='$lunch', activity='$activity', activity_date='$today_date' WHERE id = $activity_id";
        $execute_query = mysqli_query($connection, $query);
        if($execute_query){
            $success = "Activity Update Successfully";
            header("location:children_activities.php?success=$success");

        }
        else{
            $error = "Connection Error";
            header("location:children_activities.php?error=$error");
        }

    }

    if(!empty($success)){
        $child_id = "";
        $fname = "";
        $temp = "";
        $breakfast = "";
        $lunch = "";
        $activity = "";
        $today_date = "";
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
    <title>Children Activity</title>
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
            <h1 class="text-danger font-weight-bold"> Add Children Activity</h1>
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
            <form method="post" action="update_child_activity.php" >

                 <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <input type="text" name="id" class="form-control"  value="<?php echo @$id;?>" required hidden>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Name:</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo @$fname;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$fname_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->


                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Temperature:</label>
                            <input type="text" name="temp" class="form-control" placeholder="Enter Temprature" value="<?php echo @$temp;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$temp_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Breakfast:</label>
                            <input type="text" name="breakfast" class="form-control" placeholder="Enter Breakfast"  value="<?php echo @$breakfast;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$breakfast_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->


                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Lunch:</label>
                            <input type="text" name="lunch" class="form-control" placeholder="Enter Lunch" value="<?php echo @$lunch;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$lunch_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Enter Activity:</label>
                            <input type="text" name="activity" class="form-control" placeholder="Enter Activity"  value="<?php echo @$activity?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$activity_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Date:</label>
                            <input type="date" name="date" class="form-control"  value="<?php echo @$today_date;?>" required>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <button type="submit" name="update-activity" class="btn btn-md text-light btn-info  ">Update Activity</button>
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