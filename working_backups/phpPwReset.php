<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");


if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

//echo "pre request method post";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$email = $_POST['myEmail'];
	$pass = $_POST['myPassword'];
	$reenter = $_POST['myReEnter'];

	$pw = encrypt($pass);
	$re = encrypt($reenter);

	if(empty($email)) {
		header("Location: pwReset.php?error=Email is required!");
		echo "Email is required!";
		exit();
	}
	else if(empty($pw)) {
		header("Location: pwReset.php?error=Password is required!");
		echo "Password is required!";
		exit();
	}
	else if(empty($re)) {
		header("Location: pwReset.php?error=Please re-enter password!");
		echo "Please re-enter password!";
		exit();
	}
	else if(strcasecmp($pw, $re) != 0) {
		header("Location: pwReset.php?error=Passwords don't match!");
		echo "Passwords don't match!";
		exit();
	}

	$query = $db->prepare("UPDATE User SET pass=? WHERE email= ?");
	$query->bind_param('ss', $pw, $email);
	
	if($query->execute()){
	} else {
		echo mysqli_error($db);
	}
	$query1 = $db->prepare("SELECT uID, uName FROM User WHERE pass=? AND email= ?");
	$query1->bind_param('ss', $pw, $email);
	
	if($query->execute()){
		mysqli_stmt_bind_result($query1, $res_uID, $res_uName);
		if($query1->fetch()) {
			$_SESSION['uName'] = $res_uName;
			$_SESSION['uID'] = $res_uID;
		}
	} else {
		echo mysqli_error($db);
	}
	
	header("Location: homeV2.php");
	exit();
} else {
	echo "Invalid request method?";
}
?>
