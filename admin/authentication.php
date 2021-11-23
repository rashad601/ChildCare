<?php
	// only admin can view the admin pages
	if(!isset($_SESSION['admin'])){
		header("location:../public/index.php");
	}
?>