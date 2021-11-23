<?php

/*
    in this page, the script will delete the specific program
*/

session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){
    $program_id = $_GET['id']; // get id of program which we are going to delete
    $query  = "DELETE FROM program WHERE id = $program_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete program
        $success = "Delete Program Successfully";
        header("location:programs.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:programs.php?error=$error");
    }
}
?>
