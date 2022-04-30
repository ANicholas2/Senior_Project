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

    // $uID = 28;
    // $lat = "40.730610";
    // $lon = "-73.935242";

    // Prepare an insert statement into Geolocation table
    $getLocation = $db->prepare("INSERT INTO Geolocation (user_ID, latitude, longitude) VALUES (?, ?, ?)");

    // Bind the variables to the parameter as integers and floats.
    //$query->bind_param("iff", $uID, $lat, $lon);

    // Uses doubles instead of floats
    $getLocation->bind_param("idd", $uID, $lat, $lon);

    // Execute the statement
    if ($getLocation->execute()) {
        echo "success";
    } else {
        echo "failure";
    }

    die();
}

?>

