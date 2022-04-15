<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

$sID = $_SESSION['sID'];
$fID = $_SESSION['fID'];
$walkID = $_SESSION['walkID'];

//table for every communication is 'Walk#' --> #=walkID

if($_SERVER["REQUEST_METHOD"]=="POST") {
	$_SESSION['nID'] = $_POST['message'];
	$nID = $_SESSION['nID'];

	$insert_mess = $db->prepare("INSERT INTO Walk".$walkID." (fID, sID, nID) VALUES (?, ?, ?)");
	$insert_mess->bind_param('iii', $fID, $sID, $nID);
	if($insert_mess->execute()) {
	} else {
		echo mysqli_error($db);
	}
	header("Location: inbox.php");
	exit();
} else {
	echo "Invalid requestion method";
}
?>
