<?php 
    session_start();
include("connect.php");
	if (mysqli_connect_errno())
	{
		printf("Connection failed: %s\n", mysqli_connect_error());
		exit();
	}
?>

<html lang="en"> 
</html>
