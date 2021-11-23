<?php
	/*
		In this page, this script execute for parent authentication.
		this script purpopse only parent can access parent modules.
		like daily activities only see parent not memebers but admin can see in the admin panel
	*/
	if(!isset($_SESSION['parent_id'])){
		header("location:index.php");
	}
?>