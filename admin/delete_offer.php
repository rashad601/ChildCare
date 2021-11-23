<?php
/*
    in this page, the script will delete the specific offer
*/

session_start();
// include require files
require  '../database/connection.php';
require 'authentication.php';
if(isset($_GET['id'])){
    $offer_id = $_GET['id']; // get id of offer which we are going to delete
    $query  = "DELETE FROM offer WHERE id = $offer_id";
    $execute_query = mysqli_query($connection, $query);
    if($execute_query){ // if id found then delete offer
        $success = "Delete Offer Successfully";
        header("location:offer.php?success=$success");
    }
    else{
        $error = "Connection Error";
        header("location:offer.php?error=$error");
    }
}
?>
