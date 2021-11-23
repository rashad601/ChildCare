<?php
/*
    in this page, the script will delete the specific event
*/

session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){// if user want to delete child  event then get id of that event
    $event_id = $_GET['id']; // get id of event which we are going to delete
    $query  = "DELETE FROM child_event WHERE id = $event_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete event
        $success = "Delete event Successfully";
        header("location:event.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:event.php?error=$error");
    }
}
?>
