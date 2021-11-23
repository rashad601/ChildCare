<?php
/*
    in this page, the script will delete the specific child activity
*/

session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){// if user want to delete child  activity then get id of that activity
    $activity_id = $_GET['id']; // get id of activity which we are going to delete
    $query  = "DELETE FROM daily_activity WHERE id = $activity_id"; // delete activity from daily activity table which are describe in our database
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete activity
        $success = "Delete Activity Successfully";
        header("location:children_activities.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:children_activities.php?error=$error");
    }
}
?>
