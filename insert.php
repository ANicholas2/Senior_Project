<?php
session_start();

include "connectToDB.php";
include "dbfunctions.php";
require "retrieve.php";

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

// After retrieve.php gets lat & lon of user, INSERT info
// into database



/*if($_SERVER['REQUEST_METHOD'] == "POST"){
	$uID = $_POST[
} */


$sql = "INSERT INTO location VALUES ('lID', 'user_ID', 'latitude, longitude')";


// ---- Should we be updating here as well????

/*UPDATE location
SET col_date = DATE_ADD(col_date, INTERVAL 1 DAY)
WHERE DAYOFWEEK(col_date) = 1;*/

if(mysqli_query($error, $sql)){
	echo "Location added successfully.";
}	else{
		echo "ERROR: not able to execute $sql.";
}

?>


