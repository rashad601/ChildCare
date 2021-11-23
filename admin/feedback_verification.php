<?php
/*
    In this page, this script is used for feedback vaerification
*/

//session start
session_start();
// verify parent feedback / testimonials
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){
    $feedback_id = $_GET['id']; // get feedback id which we are going to verified
    $query  = "UPDATE feedback SET verified = 1 WHERE id = $feedback_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if found then success message will appear
        $success = "Verified Successfully";
        header("location:feedback.php?success=$success ");
    }
    else{
        $error = "Verified Error";
        header("location:feedback.php?error=$error");
    }
}
?>