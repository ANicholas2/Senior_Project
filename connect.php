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
    <title>Connect</title>
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
    <!--<style>
		html, body { height: 100%; width: 100%; margin: 0; } 
		.leaflet-container { max-width: 100%; max-height: 100%; }
		.leaflet-control-layers { text-align: left; }
    </style>-->
    <!--<script src="projectV2.js"></script>-->
    <body>
<form action="phpConnect.php" method="POST" class="w3-container w3-text-metro-dark-blue">
    <div class="w3-container w3-center w3-padding-16">    
	<div class="w3-card w3-margin"> 
		<div class="w3-container w3-metro-dark-blue">
		<h4>Welcome @<?php echo $_SESSION['uName']; ?>!</h4>
		</div>

    <div class="w3-container w3-center">
	<select class="w3-select w3-border w3-margin-bottom w3-margin-top" style="width: 90%" name="faculty">
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
	</select><!--</br>-->
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" type="submit">Connect 
        <i class="fa-solid fa-handshake"></i></button><!--</a>--></br>
		<?php
			//echo "prequery1";
			//var_dump($_SESSION['uID']);
			$fID = $_SESSION['fID'];
			//var_dump($fID);
			//var_dump($_SESSION['walkID']);
			
			$query2 = $db->prepare("SELECT fName, lName, gender FROM Faculty WHERE fID=?");
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
			} else { echo mysqli_error($db); }
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
