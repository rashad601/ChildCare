<?php
/*
    in this page, the script will delete the specific activity
*/

//session start
session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';

if(isset($_GET['id'])){ // if user want to delete activity then get id of that activity
    $activity_id = $_GET['id']; // get id of activity which we are going to delete
    $query  = "DELETE FROM activity WHERE id = $activity_id"; // delete activity from activity table which are describe in our database
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete activity
        $success = "Delete Activity Successfully";
        header("location:activities.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:activities.php?error=$error");
    }
}
?>
