<?php

session_start();

include "connectToDB.php";
include "dbfunctions.php";

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if (isset($_POST['updateMyLocation'])) {
    header('Content-type: application/json');

    $uID = $_SESSION['uID'];
    $lat = $_POST['lat'];
    $lon = $_POST['lon'];

    // Prepare an insert statement into Geolocation table
    $getLocation = $db->prepare("INSERT INTO Geolocation (user_ID, latitude, longitude) VALUES (?, ?, ?)");

    // Bind the variables to the parameter as integers and doubles.
    $getLocation->bind_param("idd", $uID, $lat, $lon);

    // Execute the statement
    if ($getLocation->execute()) {
        echo "Location updated successfully";
    } else {
		echo mysqli_error($db);
	}
    die();
}

if (isset($_POST["getLocationForPartner"])) {
	header('Content-type: application/json');

	$uID = $_SESSION['uID']; // Get the user ID of the current user
	$fID = $_SESSION['fID']; // Get the faculty ID of the current user's partner
	$sID = $_SESSION['sID']; // Get the student ID of the current user's partner

	if ($_SESSION['position'] == "Faculty") {
		//Gets student's location
		$getPartnerLoc = $db->prepare("SELECT * FROM Geolocation INNER JOIN Partnered_With WHERE user_ID=" .$sID ." ORDER BY entered_at DESC LIMIT 1");
	} else { 
		//Gets Faculty location
		$getPartnerLoc = $db->prepare("SELECT * FROM Geolocation INNER JOIN Partnered_With WHERE user_ID=" .$fID ." ORDER BY entered_at DESC LIMIT 1");
	}

	if ($getPartnerLoc->execute()) {
	} else {
		echo json_encode(array("error" => mysqli_error($db)));
	}

	$partnerLocResult = $getPartnerLoc->get_result();

	$results = [];

	while ($pLoc = $partnerLocResult->fetch_assoc()) {
		$results[] = $pLoc;
	}

	echo json_encode($results);
	die();
}

?>
