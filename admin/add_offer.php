<?php
/*
    All the code in this page submit offer data into database and
    before stored into database data will check its valid or not
    if data will valid then  store into database otherwise show error message to user
*/
// start session
session_start();


// Include database file
require '../database/connection.php';
// include authentication file
require 'authentication.php';



// declare error array
$error_array = array();
if(isset($_POST['add-offer']) && isset($_FILES['image'])) { // check: if user submit offer
    // get input data
    // htmlentities() convert some characters into html entities
    // this is used for security purpose

    //  Getting offer input data
    $title = htmlentities($_POST['title']);
    $price = htmlentities($_POST['price']);
    $image = $_FILES['image']['name'];
    $message = htmlentities($_POST['message']);



    //validate offer title

    if (!empty($title)) {
        trim($title); // trim extra spaces on left and right side of data
        if (!preg_match("/^[a-zA-z-' ]*$/", $title)) {
            $title_error = "Only letters are required!";
            array_push($error_array, $title_error); // add error into error_array
        }
    }


    // validate offer price
    if (!empty($price)) {
        trim($price); // trim extra spaces on left and right side of data
        if (!preg_match("/^[0-9]*$/", $price)) {
            $price_error = "Only numeric digits are required!";
            array_push($error_array, $price_error); // add error into error_array

        }
    }

     //Image Validation
     if(!empty($image)){
        $ext = array('png', 'jpg', 'jpeg'); // image extensions
        $image_ext = pathinfo($image, PATHINFO_EXTENSION); // get image extensions and check 
        if(!in_array($image_ext, $ext)){// if dose not exist in array then return true
            $image_error = "You can only upload png, jpg or jpeg file!";
            array_push($error_array, $image_error);

        }
    }

    


    if(empty($error_array)){
        //Insert Offer
        $query = "INSERT INTO offer (title, price, description,  image) VALUES ('$title', '$price', '$message',  '$image')";
        if(mysqli_query($connection, $query)){
            $upload_dir = "../assets/upload/".$image;
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir);
            $success = "Offer Added successfully";
        }
        else{
            $error = "Connection error";
        }
    }


    if(!empty($success)){
        $title = "";
        $price = "";
        $image = "";
        $message = "";
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
    <title>Add Offer</title>
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
<section class="container admin-section mt-5 mb-5">
    <div class="row heading-row mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <h1 class="text-danger font-weight-bold"> Add Offer's</h1>
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
            <form method="post" action="add_offer.php" enctype="multipart/form-data">

                <div class="row input-row row-first">
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Title:</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo @$title; ?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$title_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                    <div class="col-sm-12 col-md-6 col-lg-6 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Price:</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Price" value="<?php echo @$price;?>" required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$price_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row/ row-first-->


                <div class="row input-row row-second">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Image:</label>
                            <input type="file" name="image" class="form-control" id="myImage"  required>
                            <span class="text-danger mt-3 ml-1 error"><?php echo @$image_error;?></span>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / second-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <div class="form-group">
                            <label  class="text-info ml-1 font-weight-bold">Description:</label>
                            <textarea type="text" name="message"  class="form-control w-100 text-dark" rows="5" placeholder="Description"  required><?php echo @$message; ?></textarea>
                        </div><!--form-group-->
                    </div><!--input-->
                </div><!--input-row / third-row-->

                <div class="row input-row row-third">
                    <div class="col-sm-12 col-md-12 col-lg-12 input">
                        <button type="submit" name="add-offer" class="btn btn-md text-light btn-info  ">Add Offer</button>
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