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
	//var_dump($sID);
	$fID = $_POST['faculty'];  //partnerID 
	//var_dump($fID);
	$pickUp = $_POST['pickUp'];
	$dropOff = $_POST['dropOff'];
	
	$_SESSION['fID'] = $fID;  //partnerID 
	$_SESSION['pickUp'] = $pickUp;
	$_SESSION['dropOff'] = $dropOff;
	$time=date('Y-m-d H:i:s');
	$_SESSION['startTime'] = $time;
	
	if(empty($fID)) {
		header("Location: connect.php?error=Faculty selection is required!");
		echo "Faculty selection is required!";
		exit();
	}
	if(empty($pickUp)) {
		header("Location: connect.php?error=Pick up location is required!");
		echo "Pick up location is required!";
		exit();
	}
	if(empty($dropOff)) {
		header("Location: connect.php?error=Drop off location is required!");
		echo "Drop off location is required!";
		exit();
	}

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
