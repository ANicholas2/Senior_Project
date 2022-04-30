<?php
session_start();

include "connectToDB.php";
include "dbfunctions.php";

header('Content-type: application/json');

$uID = $_SESSION['uID']; // Get the user ID of the current user
$fID = $_SESSION['fID']; // Get the faculty ID of the current user's partner
$sid = $_SESSION['sID']; // Get the student ID of the current user's partner

//if ($_SESSION['position'] == "Faculty") {
	// Gets Faculty's location
	$getPartnerLoc = $db->prepare("SELECT * FROM Geolocation WHERE user_ID=28 ORDER BY entered_at DESC LIMIT 1");
	
//} else {
	// Gets Student's location
	//$getPartnerLoc = $db->prepare("SELECT * FROM Geolocation WHERE user_ID=" .$sID ." ORDER BY entered_at DESC LIMIT 1");
//}
echo json_encode($getPartnerLoc);

if ($getPartnerLoc->execute()) {
} else {
	echo json_encode(array("error" => mysqli_error($db)));
}

$partnerLocResult = $getPartnerLoc->get_result();

$results = [];

while ($pLoc = $partnerLocResult->fetch_assoc()) {
	$results[] = $pLoc;
}
//mysqli_fetch_row($partnerLocResult);

echo json_encode($results);
die();

?>
