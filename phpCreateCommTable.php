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
	$create = $db->prepare("CREATE TABLE Walk".$walkID." (
		messageID int NOT NULL AUTO_INCREMENT, 
		fID int,
		sID int,
		nID int,
		sentBy int,
		timeSent varchar(50),
		PRIMARY KEY (messageID),
		FOREIGN KEY (fID) REFERENCES Faculty(fID),
		FOREIGN KEY (sID) REFERENCES User(uID),
		FOREIGN KEY (nID) REFERENCES Notify(nID) )");
//if($db->query($create)) {
//	echo "created!";
	if ($create->execute()) {
	} else {
		echo mysqli_error($db);
	}
	header("Location: connectAvailUpdate.php");
?>
