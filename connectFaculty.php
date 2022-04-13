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
    <title>Connect: Faculty</title>
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
    <!--<form action="phpConnect.php" method="POST" class="w3-container w3-text-metro-dark-blue">-->
    <div class="w3-container w3-center w3-padding-16">    
	<div class="w3-card w3-margin"> 
		<div class="w3-container w3-metro-dark-blue">
		<h4>Welcome @<?php echo $_SESSION['uName']; ?>!</h4>
		</div>

    <div class="w3-container w3-center">

    <?php
	$query = $db->prepare("SELECT walkID, sID From Partnered_With WHERE fID=?");
	$query->bind_param('i', $_SESSION['fID']);
	if($query->execute()) {
		mysqli_stmt_bind_result($query, $wID, $stuID);
		if($query->fetch()) {
			$_SESSION['walkID'] = $wID;
			$_SESSION['sID'] = $stuID;
		}
	}

	if($_SESSION['sID'] > 0) {
        // if connected
        echo '<p>Connected!</p>';
	    echo '<a href="homeFaculty.php"<button class="w3-button w3-round-large w3-metro-dark-blue w3-hover-green w3-margin-bottom" style="width: 90%" onclick="">Home
            <i class="fa-solid fa-house-user"></i></button></a>';
	} else { 
        // if not connected
        //include(meta.php);
        echo '<p>Wait for Connection...</p>';
        echo '<p><i class="w3-jumbo fa-solid fa-wifi"></i></p>';
    }
    ?>



    </div>
<!--</form>-->
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
