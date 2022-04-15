<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$sID = $_SESSION['sID'];
	var_dump($sID);
	$fID = $_POST['faculty'];  //partnerID 
	var_dump($fID);
	
	$_SESSION['fID'] = $fID;  //partnerID 

	$_SESSION['pickUp'] = $_POST['pickUp'];
	$_SESSION['dropOff'] = $_POST['dropOff'];
	$time=date('Y-m-d H:i:s');
	$_SESSION['startTime'] = $time;

	$query = $db->prepare("INSERT INTO Partnered_With (sID, fID, pickUp, dropOff) VALUES (?,?,?,?)");
	$query->bind_param('iiss', $sID, $fID, $_SESSION['pickUp'], $_SESSION['dropOff']);
	if($query->execute()) {
	} else {
		echo mysqli_error($db);
	}
	$_SESSION['walkID'] = mysqli_insert_id($db);

	header("Location: phpCreateCommTable.php");
	exit();
} else {
	echo "Invalid request method?";
}
?>
