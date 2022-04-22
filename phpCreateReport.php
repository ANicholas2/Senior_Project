<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}
$walkID = $_SESSION['walkID'];
//var_dump($walkID);
	$report = $db->prepare("CREATE TABLE Report".$walkID." (
		fID int,
		sID int,
		pickUp varchar(50),
		dropOff varchar(50),
		startTime varchar(50), 
		endTime	varchar(50),
		PRIMARY KEY (startTime, endTime),
		FOREIGN KEY (fID) REFERENCES Faculty(fID),
		FOREIGN KEY (sID) REFERENCES User(uID) )");
if($report->execute()) {
//	echo "created!";
	} else {
		echo mysqli_error($db);
	}
	header("Location: phpInsertReport.php");
?>
