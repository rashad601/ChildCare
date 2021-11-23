<?php

//create required database attribute

define("HOSTNAME", "127.0.0.1");
define("USERNAME", "s2961519");
define("PASSWORD", "ollyrais");
define("DB_NAME", "s2961519");

// create connection with database or die give an error
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DB_NAME) or die("Couldn't connect to database". mysqli_connect_error());
mysqli_set_charset($connection, "utf8"); // for character set


?>