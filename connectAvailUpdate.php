<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}
//echo "pre var";
$notavail = $db->prepare("UPDATE Faculty SET isAvailable=0 WHERE fID=?");
$notavail->bind_param('i', $_SESSION['fID']);
//echo "post bind";
if($notavail->execute()) {
} else {
	echo mysqli_error($db);
}
header("Location: homeV2.php");
?>
