<?php
session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno() {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$uName = $_POST['username'];
	$pass = $_POST['myPassword'];

	$pw = encrypt($password);
		
	$query = mysqli_query($db, "SELECT email FROM User WHERE uName='".$uName."' AND pass='".$pw"'");
	if(mysqli_num_rows($query) <= 0)
	{
		echo "Username or password are incorrect";
	}
}
?>
