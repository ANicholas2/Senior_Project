<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if(isset($_SESSION['uName']) && isset($_SESSION['pass'])) { 
/*
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$uname = $_POST['myUsername'];
	$pass = $_POST['myPassword'];

	$pw = encrypt($password);

    if(empty($uname)) {
        header("Location: /~runnerpp/project/indexV2.php?error=Username is required!");
        echo "Username is required!";
        exit();
    }
    else if(empty($pw)) {
        header("Location: indexV2.php?error=Password is required!");
        echo "Password is required!";
        exit();
    }
 */		
	//$query = mysqli_query($db, "SELECT uName FROM User WHERE uName='".$uname."' AND pass='".$pw"'");
    $query = $db->prepare("SELECT fName, lName, uName, gender, email FROM User WHERE uName=? AND pass=?");

    $query->bind_param("ss", $uname, $pass);

    $query->execute();

    mysqli_stmt_bind_result($query, $result_fName, $result_lName, $result_uName, $result_gender, $result_email);

    //$result = mysqli_query($db, $query);
    if ($query->fetch()) {
    //if (mysqli_num_rows($result) === 1) {
        //$row = mysqli_fetch_assoc($result);

        //if ($row['uName'] === $uname && $row['pass'] === $pw) {
        //echo "Logged in!";

	    $_SESSION['fName'] = $result_fName;
	    $_SESSION['lName'] = $result_lName;
        $_SESSION['uName'] = $result_uname;
	    $_SESSION['gender'] = $result_gender;
        //$_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $result_email;

        header("Location: myProfile.php");
        exit();
    } else {
        header("Location: myProfile.php?error=Not able to pull up profile");
        //echo "Incorrect Username and/or Password!";
        exit();
    }
} else {
    echo "Invalid request method?";
}
?>
