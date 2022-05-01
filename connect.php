<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";

if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
?>

    <body>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <title>Connect: Student</title>
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
    <body>

	<form action="phpConnect.php" method="POST" class="w3-container w3-text-metro-dark-blue">
    <div class="w3-container w3-center w3-padding-16">    
	<div class="w3-card w3-margin"> 
		<div class="w3-container w3-metro-dark-blue">
		<h4>Welcome @<?php echo $_SESSION['uName']; ?>!</h4>
		</div>

    <div class="w3-container w3-center">
	<select class="w3-select w3-border w3-margin-bottom w3-margin-top" style="width: 90%; font-size: 16px" name="faculty">
	<option value="" disabled selected>Choose Walker:</option>
	
	<?php
	$query="SELECT fID, fName, lName, gender from Faculty WHERE isAvailable=1";
	$result=mysqli_query($db, $query);
	if (mysqli_num_rows($result)>0) {
		while ($rows=mysqli_fetch_assoc($result)) {
			echo "<option value=".$rows["fID"].">".$rows["fName"]." ".$rows["lName"]." (".$rows["gender"].") </option>";
		}
	}
	?>
	
	</select>

	<select class="w3-select w3-border w3-margin-bottom" style="width: 90%; font-size: 16px" name="pickUp">
	<option value="" disabled selected>Choose Pick-Up:</option>

	<?php
	$query2="SELECT locName from Locations";
	$result2=mysqli_query($db, $query2);
	if (mysqli_num_rows($result2)>0) {
		while ($rows2=mysqli_fetch_assoc($result2)) {
			echo "<option value='".$rows2["locName"]."'>".$rows2["locName"]." </option>";
		}
	}
	?>
	
	</select>

	<select class="w3-select w3-border w3-margin-bottom" style="width: 90%; font-size: 16px" name="dropOff">
	<option value="" disabled selected>Choose Drop-Off:</option>

	<?php
	$query3="SELECT locID, locName from Locations";
	$result3=mysqli_query($db, $query3);
	if (mysqli_num_rows($result3)>0) {
		while ($rows3=mysqli_fetch_assoc($result3)) {
			echo "<option value='".$rows3["locName"]."'>".$rows3["locName"]." </option>";
		}
	}
	?>
	
	</select>


<!--	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" type="submit">Connect -->
<!--        <i class="fa-solid fa-handshake"></i></button><!--  -->
		<?php
			$uID = $_SESSION['uID'];
			$fID = $_SESSION['fID'];
			
			/*$query2 = $db->prepare("SELECT fName, lName, gender FROM Faculty WHERE fID=?");
			$query2->bind_param('i', $fID);
			if($query2->execute()) {
				mysqli_stmt_bind_result($query2, $res_first, $res_last, $res_gen);
				if($query2->fetch()) {
					$fname=$res_first;
					$lname=$res_last;
					$gender=$res_gen;
					// echo "Connected with: ".$fname." ".$lname." (".$gender.")"; ?>
					<div class="w3-panel w3-green w3-round-large">
						<p> <?php echo "Connected: ".$fname." ".$lname." (".$gender.")"; ?> </p>
					</div>  <?php
				}
			} else { echo mysqli_error($db); }*/


			if($isA == 0) {

				echo '<p>Connected!</p>';
				echo '<a href="homeV2.php"
					<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" type="submit" onclick="">Connect 
        <i class="fa-solid fa-handshake"></i></button><!--</a>--></br>';
			} else {
				echo '<p>Connecting...</p>';
			}
		?>	
    </div>
	</form>
<?php
if(isset($_GET['error'])) { ?>
<div class="w3-panel w3-red">
<h3>Error!</h3>
<p> <?php echo $_GET['error']; ?> </p>
</div>
<?php } ?>
	</body>
	</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
