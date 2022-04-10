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
	
	$insert_mess = $db->prepare("INSERT INTO Walk".$walkID." (fID, uID, nID) VALUES (?, ?, ?)");
	$insert_mess->bind_param('iii', $fID, $uID, $nID);
	if($insert_mess->execute()) {
	} else {
		echo mysqli_error($db);
	}
	header("Location: ericka_inbox.php");
	exit();
} else {
	echo "Invalid requestion method";
}
?>
