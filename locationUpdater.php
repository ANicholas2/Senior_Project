<?php

session_start();

include "connectToDB.php";
include "dbfunctions.php";

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}


?>
