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

	<select class="w3-select w3-border w3-margin-top w3-margin-bottom" style="width: 90%" name="message">
		<option value="" disabled selected>View Reports:</option>
		<?php
			$result = mysqli_query($db, "SELECT nID, Message FROM Notify");
			if (mysqli_num_rows($result) > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
					echo "<option value='".$rows["nID"]."'>".$rows["Message"]."</option>";
				}
			}
			else { 
				//runs
				echo "<option value='12'> less than 0</option>";
			}
			//echo "<option value='41'>TEST :)</option>";
		?>
	</select></br>
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 90%;" type="submit">Display Report 
		<i class="fa-solid fa-file-lines"></i></button>

	<hr class="w3-grey">


    <!-- Print Out Section for Reports -->

</div>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>