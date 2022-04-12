<?php

session_start();
session_destroy();
header("Location: indexV2.php");

?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Logout</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<body>
<!-- Page Container -->
<div class="w3-container w3-card-4 w3-margin">
    <h2 class="w3-center"><img src="csub_logoV3.png" style="height:64px;"></h2>
    <h4 class="w3-center w3-monospace">Logged Out!</h4>
</div>

</body>
</html>
