<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

$uID = $_SESSION['uID'];
$fID = $_SESSION['fID'];
$walkID = $_SESSION['walkID'];

//table for every communication is 'Walk#' --> #=walkID
if($_SERVER["REQUEST_METHOD"]=="POST") {
	$nID = $_POST['message'];
	
	$current = date('Y-m-d H:i:s', time());

	$insert_mess = $db->prepare("INSERT INTO Walk".$walkID." (fID, uID, timeSent, nID) VALUES (?, ?, ?, ?)");
	$insert_mess->bind_param('iisi', $fID, $uID, $current, $nID);
	if($insert_mess->execute()) {
	} else {
		echo mysqli_error($db);
	}
	//NEED TO ACTUALLY SEND MESSAGE --> IT SHOULD BE LOADED BUT NO OUTPUT ON INBOX.PHP SIDE :)
	header("Location: ericka_inbox.php");
	exit();
} else {
	echo "Invalid requestion method";
}
?>
