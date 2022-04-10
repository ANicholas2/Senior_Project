<?php

function salt($pass) {
	$arr = str_split($pass);
	for($i=0; $i<8; $i++)
		$salt .= ($arr[$i]+3);
	return $salt;
}

function encrypt($pass) {
	$temp = salt($pass);
	$password = hash('sha256', $pass.$temp);
	return $password;
}


?>
