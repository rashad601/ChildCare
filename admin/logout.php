<?php
    session_start();
    require 'authentication.php';
    if(isset($_SESSION['admin'])){
        session_unset();
        session_destroy();
        $success = "You have been logout from KidsPlus";
        header("location:../index.php?success=$success");
    }
    else{
        header("location:../index.php");
    }
?>