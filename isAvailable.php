<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}
$fID = $_SESSION['fID'];
$avail = $db->prepare("UPDATE Faculty SET isAvailable=1 WHERE fID=?");
$avail->bind_param('i', $fID);
if($avail->execute()) {
	//echo "available";
	} else {
		echo mysqli_error($db);
	}
	header("Location: connectFaculty.php");
?>
