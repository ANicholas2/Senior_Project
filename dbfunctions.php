<?php

//include("connectToDB.php");

if(mysqli_connect_errno()) {
	printf("connection failed");
	exit();
}

function salt($pw) {
	$arr = str_split($pw);
	for($i=0;$i<8; $i++)
		$salt .= ($arr[$i]+3);
	return $salt;
}

function encrypt($pw) {
	$temp = salt($pw);
	$password = hash('sha256', $pw.$temp);
	return $password;
}

/*function createUser($first, $last, $user, $email, $pos, $pw) {
	$password=encrypt($pw);
	$query="INSERT INTO User (fName, lName, uName, email, position, pass) VALUES ('$first', '$last', '$user', '$email', '$pos', '$password');";
}
return $*/

?>
