<?php

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
	$fname = $_POST['first'];
	$lname = $_POST['last'];
	$uname = $_POST['myUsername'];
	$email = $_POST['myEmail'];
	$gender = $_POST['myGender'];
	$pass = $_POST['myPassword'];
	$reenter = $_POST['myReenter'];
	$pos = $_POST['myPosition'];

	$pw = encrypt($pass);
	$re = encrypt($reenter);

	echo $uname;
	if(empty($uname)) {
		header("Location: createAccount.php?error=Username is required!");
		echo "Username is required!";
		exit();
	}
	else if(empty($pw)) {
		header("Location: createAccount.php?error=Password is required!");
		echo "Password is required!";
		exit();
	}
	else if(empty($email)) {
		header("Location: createAccount.php?error=Email is required!");
		echo "Email is required!";
		exit();
	}
	else if(empty($re)) {
		header("Location: createAccount.php?error=Please re-enter password!");
		echo "Please re-enter password!";
		exit();
	}
	else if(strcasecmp($pw, $re) != 0) {
		header("Location: createAccount.php?error=Passwords don't match!");
		echo "Passwords don't match!";
		exit();
	}
	else if(empty($fname)) {
		header("Location: createAccount.php?error=Please enter first name!");
		echo "Please enter first name!";
		exit();
	}
	else if(empty($lname)) {
		header("Location: createAccount.php?error=Please enter last name!");
		echo "Please enter last name!";
		exit();
	}
	else if(empty($gender)) {
		header("Location: createAccount.php?error=Please include your gender");
		echo "Please include your gender";
		exit();
	}
	else if(empty($pos)) {
		header("Location: createAccount.php?error=Please choose your position!");
		echo "Please choose your position!";
		exit();
	}

	if ($pos == "Faculty") {
		$imagePath = "profile_pics/imgFaculty.png";
	} else {
		$imagePath = "profile_pics/imgStudent.png";
	}
	
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
	header("Location: indexV2.php");
	exit();
} else {
	echo "Invalid request method?";
}
?>
