<?php
/*
    this is the logout script for both parent and admin 
    if parent or admin want to login then destroy their sessions
*/
//start session    
session_start();
if(isset($_SESSION['parent']) || isset($_SESSION['parent_id'])){ //if parent session set then destroy child and parent session
	if(isset($_SESSION['child_id'])){
		unset($_SESSION['child_id']);
	}
    session_unset();
    session_destroy();
    $success = "you have been logout from KidsPlus";
    header("location:index.php?success=$success");
}
elseif (isset($_SESSION['admin'])){//if admin session set then destroy admin session
		session_unset();
    	session_destroy();
    	$success = "you have been logout from KidsPlus";
    	header("location:index.php?success=$success");
}
else{
	header("location:index.php");
}
?>