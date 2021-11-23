<?php
/*
    In this page, admin can see all the children , update and delete them and also add their activity   
*/

//session start  
session_start();
require '../database/connection.php';
// include authentication file
require 'authentication.php';

// delete children
if (isset($_GET['id'])) {
    $ch_id = $_GET['id']; // get children id which we are going to delete
    $query = "DELETE FROM parent WHERE child_id = $ch_id";
    $execute_query = mysqli_query($connection, $query);
    if ($execute_query) {
        $stmt = "DELETE FROM child WHERE child_id = $ch_id ";
        $execute_stmt = mysqli_query($connection, $stmt);
        if ($execute_stmt) {
            $success = "Delete Children Successfully";
        } else {
            $error = "Connection Error!";
        }
    }
    else{
        $error = "Connection Error!"; 
    }
}

if(isset($_GET['success'])){
    $success = $_GET['success'];
}
elseif(isset($_GET['error'])){
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
    <title>Children</title>
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
            <h1 class="text-info font-weight-bold">Children's</h1>
            <div class="mt-4">
                <img src="../assets/images/line-dec-2.png" alt="">
            </div><!--img-->
        </div><!--heading-->
    </div><!--heading-row end-->

    <!--display success error-mesages-->
    <?php if(!empty($success)){?>
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
            <div class="alert alert-success">
                <p class="text-success font-weight-bold mb-0"><?php echo $success?></p>
            </div>
        </div>
    <?php }elseif(!empty($error)){?>
        <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2 mb-4">
            <div class="alert alert-danger">
                <p class="text-danger font-weight-bold mb-0"><?php echo $error; ?></p>
            </div>
        </div>
    <?php } ?>    


    <div class="row filter-row">
        <div class="col-sm-12 col-md-12 col-lg-12 filter-record">
          <div class="content d-flex justify-content-start flex-row w-100">
                <form method="post" action="filter_children.php" class="d-flex justify-content-start flex-row"> 
                    <div class="form-group">
                        <label class="text-success ml-1 font-weight-bold">Filter Activity By Name:</label>
                        <input type="text" name="filter-act" placeholder="Filter Activity By Name" class="form-control rounded-0" style="box-shadow: none !important; ">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="filter" class="btn btn-md btn-info text-light rounded-0" style="margin: 32px 0px; padding:6px 15px;">Filter</button>
                    </div>
                </form>
            </div><!--content-->
        </div>
    </div><!--filter-row-->

    <div class="row table-row">
        <div class="col-sm-12 col-md12 col-lg-12 children-table ">
            <table class="table table-striped table-hover table-bordered table-responsive-md">
                <thead class="bg-danger text-center text-light">
                    <tr>
                        <th>Sr.</th>
                        <th colspan="2">Name</th>
                        <th colspan="2">Father Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Room</th>
                        <th>Program</th>
                        <th >Operations</th>
                    </tr>
                </thead>
                <tbody class="text-center text-dark">
                <?php
                    //fetching all childrens from database
                    $query = "SELECT * FROM child";
                    $execute_query = mysqli_query($connection, $query);
                    if(mysqli_num_rows($execute_query) > 0){
                        while($row = mysqli_fetch_assoc($execute_query)){
                            $id = $row['child_id'];
                ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td colspan="2"><?php echo $row['child_first_name']. " ". $row['child_last_name'];?></td>
                        <td colspan="2"><?php echo $row['child_father_name'];?></td>
                        <td><?php echo $row['child_age'];?></td>
                        <td><?php echo $row['child_gender'];?></td>
                        <td><?php echo $row['child_room'];?></td>
                        <td><?php echo $row['child_program'];?></td>
                        <td>
                            <a href="activity_children.php?id=<?php echo $id;?>" class="btn btn-warning text-light btn-sm font-weight-bold">Add Acitivity</a>
                            <a href="update_children.php?id=<?php echo $id;?>" class="btn btn-success text-light btn-sm font-weight-bold">Update</a>
                            <a href="children.php?id=<?php echo $id;?>" class="btn btn-danger text-light btn-sm font-weight-bold">Delete</a>
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