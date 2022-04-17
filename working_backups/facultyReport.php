<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";
require_once "navV2.php";

$fID = (int)$_SESSION['fID'];

if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Report History</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
<link rel="manifest" href="favicon_package_v0/site.webmanifest">
<link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<body>
<div class="w3-container w3-center">

	<!-- Connected Username -->
	<p><b>Walk Report History</b></p>
<form action="" method="POST">
	<select class="w3-select w3-border w3-margin-top w3-margin-bottom" style="width: 90%" name="report" type="submit">
		<option value="" disabled selected>View Reports: </option>
<?php
	$count=1;
	$query1 = "SELECT repID, sID, pickUp, dropOff, startTime, endTime FROM Reports WHERE fID=".$fID;
	$result1=mysqli_query($db, $query1);
	if (mysqli_num_rows($result1)>0) {
		while ($rows1=mysqli_fetch_assoc($result1)) {
				$query4 = "SELECT fName FROM User WHERE uID=".$rows1["sID"];
				$result4=mysqli_query($db, $query4);
				if (mysqli_num_rows($result4)>0) {
					while ($rows4=mysqli_fetch_assoc($result4)) {
						$sName = $rows4["fName"];
					}
				}
			echo "<option value='".$count."'>Report #: ".$rows1["repID"]." Student: ".$sName." </option>";
			//echo "<option value='".$count."'>Report #: ".$rows1["repID"]." Student: ".$sName.", Pick-Up: ".$rows1["pickUp"].", Drop-Off: ".$rows1["dropOff"].", Start time: ".$rows1["startTime"].", End time: ".$rows1["endTime"]." </option>";
			$count++;
		}
	}
?>
	</select></br>
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 90%;" type="submit">Display Report 
		<i class="fa-solid fa-file-lines"></i></button>
</form>
	<hr class="w3-grey">

    <!-- Print Out Section for Reports -->
<?php
if(isset($_POST['report'])){
	$rID = $_POST['report'];
	$count2=1;
	$query2 = "SELECT repID, sID, pickUp, dropOff, startTime, endTime FROM Reports WHERE fID=".$fID;
	$result2=mysqli_query($db, $query2);
	if (mysqli_num_rows($result2)>0) {
		while ($rows2=mysqli_fetch_assoc($result2)) {
			if($rID == $count2) {
				$query3 = "SELECT fName FROM User WHERE uID=".$rows2["sID"];
				$result3=mysqli_query($db, $query3);
				if (mysqli_num_rows($result3)>0) {
					while ($rows3=mysqli_fetch_assoc($result3)) {
						$sName = $rows3["fName"];
					}
				}
				echo '<div class="w3-container w3-center w3-margin-top">';    
				echo '<div class="w3-card w3-margin w3-margin-bottom">'; 
				echo '<div class="w3-container w3-metro-dark-blue">';
				echo '<h4>Report #: '.$rows2["repID"].'</h4>';
				echo '</div>';
 
				echo '<p>Student: '.$sName.'</p>'; 
                echo '<p>Pick-Up: '.$rows2["pickUp"].'</p>';
                echo '<p>Drop-Off: '.$rows2["dropOff"].'</p>';
                echo '<p>Start Time: '.$rows2["startTime"].'</p>';
                echo '<p>End Time: '.$rows2["endTime"].'</p>';
				echo '</div>';
				echo '</div>';

			}	
			$count2++;
		}
	}
}
	?>
</div>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
