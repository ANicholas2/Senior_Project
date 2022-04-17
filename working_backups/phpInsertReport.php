<?php

session_start();

//connecting to DB
include("connectToDB.php");
include("dbfunctions.php");

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

$sID = $_SESSION['sID'];
$fID = (int)$_SESSION['fID'];
$repID = $_SESSION['walkID'];
$pickUp = $_SESSION['pickUp'];
$dropOff = $_SESSION['dropOff'];
$startTime = $_SESSION['startTime'];
$time=date('Y-m-d H:i:s');
$endTime = $time;

$rep = $db->prepare("INSERT INTO Reports (repID, fID, sID, pickUp, dropOff, startTime, endTime) VALUES (?, ?, ?, ?, ?, ?, ?)");
$rep->bind_param('iiissss', $repID, $fID, $sID, $pickUp, $dropOff, $startTime, $endTime);
if($rep->execute()) {
} else {
	echo mysqli_error($db);
}
header("Location: connectFaculty.php");
exit();

if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
sleep(5);
?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Ending Walk...</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
<link rel="manifest" href="favicon_package_v0/site.webmanifest">
<link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
<script src="https://kit.fontawesome.com/a6d0ff8634.js" crossorigin="anonymous"></script>
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<meta http-equiv="refresh" content="10">
<body>
<div class="w3-container w3-center">
	<div class="w3-container w3-center w3-padding-16">    
		<div class="w3-card w3-margin"> 
			<div class="w3-container w3-metro-dark-blue">
			<h4>Ending Walk...</h4>
			</div>

			<div class="w3-container w3-center">
				<p>Rerouting to Connect Page</p>
				<p><i class="w3-jumbo fa-solid fa-route"></i></p>
			</div>
		</div>
	</div>
</div>
</form>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
