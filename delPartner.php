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

$delPartner = $db->prepare("DELETE FROM Partnered_With WHERE walkID=?");
$delPartner->bind_param('i', $walkID);
if($delPartner->execute()) {
} else {
	echo mysqli_error($db);
}

/*$delWalk = $db->prepare("DROP TABLE Walk".$_SESSION['walkID'];
if($delWalk->execute()) {
} else {
	echo mysqli_error($db);
}*/

header("Location: dropWalk.php");
exit();
?>
