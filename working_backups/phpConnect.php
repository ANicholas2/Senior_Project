<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

$uID = $_SESSION['uID'];

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$fID = $_POST['partner'];  //partnerID 
	
	$query = $db->prepare("INSERT INTO Partnered_With (uID, fID) VALUES (?,?)");

    $query->bind_param("ss", $uID, $fID);

    $query->execute();

        header("Location: homeV2.php");
        exit();
    } else {
        header("Location: homeV2.php?error=Error connecting student with faculty");
        exit();
    }
} else {
    echo "Invalid request method?";
}
?>
