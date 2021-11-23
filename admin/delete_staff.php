<?php
/*
    in this page, the script will delete the specific staff
*/
session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){
    $staff_id = $_GET['id']; // get id of staff which we are going to delete
    $query  = "DELETE FROM staff WHERE id = $staff_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete satff
        $success = "Delete Staff Successfully";
        header("location:staff.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:staff.php?error=$error");
    }
}
?>
