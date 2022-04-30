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

if($_SESSION['position'] == "Faculty") {
	$sent = $fID;
	echo $sent;
} else {
	$sent = $sID;
	echo $sent;
}

//table for every communication is 'Walk#' --> #=walkID

if($_SERVER["REQUEST_METHOD"]=="POST") {
	//$_SESSION['nID'] = $_POST['message'];
	$nID = $_POST['message'];

	$insert_mess = $db->prepare("INSERT INTO Walk".$walkID." (fID, sID, nID, sentBy) VALUES (?, ?, ?, ?)");
	$insert_mess->bind_param('iiii', $fID, $sID, $nID, $sent);
	if($insert_mess->execute()) {
	} else {
		echo mysqli_error($db);
	}
	//header("Location: inbox.php");
	exit();
} else {
	echo "Invalid requestion method";
}
?>
