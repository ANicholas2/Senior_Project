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

	$query = $db->prepare("INSERT INTO Partnered_With (sID, fID) VALUES (?,?)");
	$query->bind_param('ii', $sID, $fID);
	if($query->execute()) {
	} else {
		echo mysqli_error($db);
	}
	$_SESSION['walkID'] = mysqli_insert_id($db);

/*	$create = $db->prepare("CREATE TABLE Walk? (
		messageID int NOT NULL AUTO-INCREMENT, 
		fID int,
		uID int,
		timeSent datetime NOT NULL,
		nID int,
		PRIMARY KEY (messageID),
		FOREIGN KEY (fID) REFERENCES Faculty(fID),
		FOREIGN KEY (uID) REFERENCES User(uID),
		FOREIGN KEY (nID) REFERENCES Notify(nID) )");
	$create->bind_param('i', $_SESSION['walkID']);
	if($create->execute()) {
	} else {
		echo mysqli_error($db);
	}
 */
	header("Location: phpCreateCommTable.php");
	exit();
} else {
	echo "Invalid request method?";
}
?>
