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
	<!-- <button class="w3-button w3-ripple w3-round-large w3-green w3-margin-bottom" style="width: 90%" type="submit">Wait for Connection</button> -->
    <p>Wait for Connection...</p>
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-margin-bottom w3-hover-green" style="width: 90%" type="submit">Home 
        <i class="fa-solid fa-house-user"></i></button><!--</a>--></br>
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
