<?php

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno() {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$fName = $_POST['fname'];
	$lName = $_POST['lname'];
	$uName = $_POST['uname'];
	$email = $_POST['email'];
	$pos = $_POST['position'];
	$pass = $_POST['myPassword'];
	$repass = $_POST['rePassword'];

	//$pw = encrypt($password);
		
	$query = mysqli_query($db, "SELECT email FROM User WHERE email='".$email."'");
	if(mysqli_num_rows($query) != 0)
		echo '<span style="color:red;text-align:center;">Email already used</span>';
	elseif($pass != $repass)
		echo '<span style="color:red;text-align:center;">Passwords do not match</span>';
	else {
		//$epass=encrypt($pass);
		$query = "INSERT INTO User (fName, lName, uName, email, position, pass) VALUES ('$fName', '$lName', '$uName', '$email', '$pos', '$pass');";
		if(mysqli_query($db, $query)) {
		//	header("location: login.php");
			echo '<span style="color:green;text-align:center;">Success!</span>';
		}
		else
			echo '<span style="color:red;text-align:center;">Error: insertion into database</span>';
	}
}
?>
