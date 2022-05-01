<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

$u_ID = $_SESSION['uID'];

// Delete the user's geolocation
$delGeoLocation = $db->prepare("DELETE FROM GeoLocation WHERE uID=?");
$delGeoLocation->bind_param('i', $u_ID);

if($delGeoLocation->execute()) {
} else {
	echo mysqli_error($db);
}

// Delete the partner's geolocation
$delGeoLocation = $db->prepare("DELETE FROM GeoLocation WHERE uID=?");
$delGeoLocation->bind_param('i', $u_ID);

if($delGeoLocation->execute()) {
} else {
	echo mysqli_error($db);
}

header("Location: connectFaculty.php");
?>