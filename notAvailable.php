<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}
var_dump($_SESSION['position']);
if ($_SESSION['position'] == "Faculty") {
	$notavail = $db->prepare("UPDATE Faculty SET isAvailable=0 WHERE fID=?");
	$notavail->bind_param('i', $_SESSION['uID']);
	if($notavail->execute()) {
		echo $fID." NOT available";
	} else {
		echo mysqli_error($db);
	}
}
header("Location: logout.php");
?>
