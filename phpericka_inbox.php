<?php
//TODO: refer to apea home line 164 ... need to do something with connected to table? from there we can connect the users and send the messages accordingly ... no need for 2 inbox pages ONLY 2 home pages :)
session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");


if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

//echo "pre request method post";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$mess = $_POST['message'];

	$query = $db->prepare("INSERT INTO User (fName, lName, uName, gender, email, position, pass, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
	$query->bind_param('ssssssss', $fname, $lname, $uname, $gender, $email, $pos, $pw, $imagePath);
	
	if ($query->execute()){
		printf("%d row inserted with uId: %d.\n", $query->affected_rows, mysqli_insert_id($db));
	} else {
		echo mysqli_error($db);
	}

	if ($pos == "Faculty") {
		$fID = mysqli_insert_id($db);
		$query2 = $db->prepare("INSERT INTO Faculty (fID, fName, lName, gender) VALUES (?, ?, ?, ?)");
		$query2->bind_param('isss', $fID, $fname, $lname, $gender);
		if($query2->execute()) {
			printf("FACULTY INSERTED -- yay");
		}
		else {
			echo mysqli_error($db);
		}
	}
	header("Location: homeV2.php");
	exit();
} else {
	echo "Invalid request method?";
}
?>
