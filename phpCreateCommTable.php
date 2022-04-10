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
var_dump($walkID);
	$create = "CREATE TABLE Walk".$walkID." (
		messageID int NOT NULL AUTO_INCREMENT, 
		fID int,
		uID int,
		nID int,
		dropOff datetime,
		status varchar(20) DEFAULT 'Incomplete',
		report varchar(1024),
		PRIMARY KEY (messageID),
		FOREIGN KEY (fID) REFERENCES Faculty(fID),
		FOREIGN KEY (uID) REFERENCES User(uID),
		FOREIGN KEY (nID) REFERENCES Notify(nID) )";
//echo "create statement ^^";
if($db->query($create)) {
//	echo "created!";
	} else {
		echo mysqli_error($db);
	}
	header("Location: homeV2.php");
?>
