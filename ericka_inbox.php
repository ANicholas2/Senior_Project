<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";
require_once "navV2.php";


if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Messages</title>
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
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<style>
    html, body { height: 100%; margin: 0; } .leaflet-container {height: 400px; width: 600px; max-width: 100%; max-height: 100%; }
</style>
<!--<script src="projectV2.js"></script>-->
<body>

<!-- page container - needed for submit -->
<form action="phpMessaging.php" method="POST">
<!--class="w3-container w3-card-4 w3-text-metro-dark-blue w3-margin">-->

    <!-- Output Container -->
    <div class="w3-container w3-center w3-padding-16" style="height: 75%">

        <!-- Connected Username -->
        <p style="color: #2A558C"><b>@FacultyMember</b></p>
        <hr class="w3-grey">

        <!-- Singular Message Container  -->
        <!-- <p class="w3-tiny w3-right-align">@username</p> -->
        <div class="w3-panel w3-rightbar w3-right-align w3-round-xlarge w3-metro-yellow" style="font-style: italic; position: relative; right: 0%; width: 50%;">
            <!-- <p class="w3-tiny w3-right-align">@username</p> -->
            <p>Hello!</p>
        </div>

        <!-- Singular Message Container  -->
        <div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;">
            <p>On my way!</p>
        </div>

    </div>   

    <!-- Predetermined Messages -->
    <div class="w3-container w3-center">
        <hr class="w3-grey">

        <select class="w3-select w3-border w3-margin-bottom" style="width: 100%" name="message">
	<option value="" disabled selected>Choose a message</option>
<?php
	$query="SELECT nID, Message FROM Notify";
	$result=mysqli_query($db, $query);
	if (mysqli_num_rows($result)>0) {
		while ($rows=mysqli_fetch_assoc($result)) {
			echo "<option value='".$rows["nID"]."'>".$rows["Message"]."</option>";
		}
	}
?>
        </select></br>
        <!--a href="inbox.php"--> <button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 100%;" type="submit">Send 
            <i class="fa-solid fa-paper-plane"></i></button><!--</a>-->
<!--</form>-->
<?php
	/*$facName = $db->prepare("SELECT fName, lName FROM Faculty WHERE fID=?");
	$facName->bind_param('i', $_SESSION['fID']);
	if($facName->execute()) {
		mysqli_stmt_bind_result($facName, $first, $last);
		if($facName->fetch()) {
			$fac_fName = $first;
			$fac_lName = $last;
		}
	}
	echo $fac_fName." ".$fac_lName; //works
	//echo $_SESSION['sID'];

	$stuName = $db->prepare("SELECT fName, lName FROM User WHERE uID=?");
	$stuName->bind_param('i', (int)$_SESSION['sID']);
	if($stuName->execute()) {
		mysqli_stmt_bind_result($stuName, $first, $last);
		if($stuName->fetch()) {
			$stu_fName = $first;
			$stu_lName = $last;
		}
	}
	echo $stu_fName." ".$stu_lName; //doesntworks
	 */
	$walkID = $_SESSION['walkID'];
	//$increment = 1;
	$queryn = $db->prepare("SELECT nID FROM Walk".$walkID." WHERE messageID=1");
	//$queryn->bind_param('i', $increment);
	//$increment++;
	if($queryn->execute()) {
		mysqli_stmt_bind_result($queryn, $notif);
		if($queryn->fetch()) {
			$nID = $notif;
		}
	}	

	/*$sent = $db->prepare("SELECT Message FROM Notify WHERE nID=?");
	$sent->bind_param('i', (int)$nID);
	if($sent->execute()) {
		mysqli_stmt_bind_result($sent, $res_mess);
		if($sent->fetch()) {
			$mess = $res_mess;
			if(_SESSION['position'] == "Student") {
				echo $stu_fName." ".$stu_lName." sent to ".$fac_fName." ".$fac_lName.": ".$message." \n";
			}
			if(_SESSION['position'] == "Faculty") {
				echo $fac_fName." ".$fac_lName." sent to ".$stu_fName." ".$stu_lName.": ".$message." \n";
			}
		}
	}*/
	var_dump($nID);
	$querySent = $db->prepare("SELECT Message FROM Notify WHERE nID=?");
	$querySent->bind_param('i', $nID);
	if($querySent->execute()) {
		mysqli_stmt_bind_result($querySent, $res_mess);
		if($querySent->fetch()) {
			$messageSent = $res_mess;
		}
	}
//	echo $_POST['message'];
	echo $messageSent;
?>

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
