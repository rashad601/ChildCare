<?php
    /*
        In this page, Parent can see their child activity which they are filterd by date
    */
    // session start
    session_start();
    // include authntication and databse file
    require  'database/connection.php';
    require 'parent_auth.php';
    if(isset($_POST['filter'])){ // if parent filter their child by date
        $date = date('Y-m-d', strtotime(htmlentities($_POST['filter-act']))); // get input date by parent and stroe into date variable
        if(isset($_SESSION['child_id'])){ //  fetch child id
            $child_id = $_SESSION['child_id'];
            $query = "SELECT * FROM daily_activity WHERE child_id = $child_id AND activity_date = '$date'"; // fetch activity from datbase by child id 
            $execute_query = mysqli_query($connection, $query);
            if(mysqli_num_rows($execute_query) > 0){ // if record found then fetch all information about child
                while($row = mysqli_fetch_assoc($execute_query)){ // fetching record into assosative array
                    $id = $row['id'];
                    $name = $row['name'];
                    $temp = $row['temperature'];
                    $breakfast = $row['breakfast'];
                    $lunch = $row['lunch'];
                    $activity = $row['activity'];
                    $activity_date = $row['activity_date'];
                }
            }
            else{
                $error = "Record Not Found";
                header("location:daily_activities.php?message=$error");
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
    <title>Activities</title>
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


<!------------------ parent Section Start  ------------------>
<section class="container parent-section public-section mt-5 " >
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold">Daily Activities</h1>
            <div class="mt-4">
                <img src="assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->

   <!--filterize row--> 
   <div class="row filter-row">
        <div class="col-sm-12 col-md-12 col-lg-12 filter-record">
            <div class="content d-flex justify-content-start flex-row w-100">
                <form method="post" action="filter_activity.php" class="d-flex justify-content-start flex-row"> 
                    <div class="form-group">
                        <label class="text-success ml-1 font-weight-bold">Filter Activity By Date:</label>
                        <input type="date" name="filter-act" placeholder="Filter Activity" class="form-control rounded-0" style="box-shadow: none !important; ">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="filter" class="btn btn-md btn-info text-light rounded-0" style="margin: 32px 0px; padding: 7px 15px;">Filter</button>
                    </div>
                </form>
            </div><!--content-->
        </div><!--filter-record-->
    </div><!--filter-row-->

    

    <!-- show filter  activity-->
    <div class="row table-row">
        <div class="col-sm-12 col-md12 col-lg-12 staff-table ">
            <table class="table-striped table-hover table-bordered table">
                <thead class="bg-warning text-center text-dark">
                <tr>
                    <th class="bg-danger border-danger text-light">Sr.</th>
                    <th class="bg-warning border-warning text-light">Name</th>
                    <th class="bg-info border-info text-light">Temperature</th>
                    <th class="bg-success border-success text-light">BreakFast</th>
                     <th class="bg-warning border-warning text-light">Lunch</th>
                    <th class="bg-dark border-dark text-light">Activity</th>
                    <th class="bg-danger border-danger text-light">Date</th>
                </tr>
                </thead>
                <tbody class="text-center text-dark">
                    <!--dusplay record into row-->
                <tr>
                    <td><?php echo @$id;?></td>
                    <td><?php echo @$name;?></td>
                    <td><?php echo @$temp;?></td>
                    <td><?php echo @$breakfast;?></td>
                    <td><?php echo @$lunch;?></td>
                    <td><?php echo @$activity;?></td>
                    <td><?php echo @$activity_date;?></td>
                </tr>
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
<script type="text/javascript" src="assets/js/fontawesome.js"></script>
<!-- Our App Js -->
<!-- For Design  Handling  All App Components and Operations -->
<script type="text/javascript" src="assets/js/app.js"></script>
</body>
</html>