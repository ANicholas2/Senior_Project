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
	$uname = $_POST['myUsername'];
	$pass = $_POST['myPassword'];

	$pw = encrypt($pass);

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
		
    $query = $db->prepare("SELECT fName, lName, uName, gender, email, uID, position, imagePath FROM User WHERE uName=? AND pass=?");

    $query->bind_param("ss", $uname, $pw);

    $query->execute();

    mysqli_stmt_bind_result($query, $result_fName, $result_lName, $result_uname, $result_gender, $result_email, $result_uID, $result_position, $result_imagePath);

    if ($query->fetch()) {
        echo "Logged in!";

        $_SESSION['uName'] = $result_uname;
        $_SESSION['uID'] = $result_uID;
        $_SESSION['fName'] = $result_fName;
	    $_SESSION['lName'] = $result_lName;
	    $_SESSION['gender'] = $result_gender;
	    $_SESSION['email'] = $result_email;
	    $_SESSION['position'] = $result_position;
	    $_SESSION['imagePath'] = $result_imagePath;
	    //echo $_SESSION['imagePath'];
	    
	    if ($_SESSION['position'] == "Faculty") {
		    $_SESSION['fID'] = $result_uID;
            header("Location: isAvailable.php");
	    } else {
		    $_SESSION['sID'] = $result_uID;
            header("Location: connect.php");
            exit();
        }

        // if ($_SESSION['position'] == "Faculty") {
		//     $_SESSION['fID'] = $result_uID;
        //     header("Location: connect.php");
        // }
    } else {
        header("Location: indexV2.php?error=Incorrect Username and/or password");
        exit();
    }
} else {
    echo "Invalid request method?";
}
?>
