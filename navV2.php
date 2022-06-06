<?php 
session_start();

$pos = $_SESSION["position"];
$pos2 = $_SESSION["position"];

?>

<script src="https://kit.fontawesome.com/a6d0ff8634.js" crossorigin="anonymous"></script>

<!-- Desktop -->
<div class="w3-bar w3-metro-dark-blue w3-large">
  <?php
  if ($pos == "Faculty") {
    echo '<a href="homeFaculty.php" class="w3-bar-item w3-button w3-metro-dark-blue"><img src="res/csub_logoV2.png" style="height:26px;">';
  } else {
    echo '<a href="homeV2.php" class="w3-bar-item w3-button w3-metro-dark-blue"><img src="res/csub_logoV2.png" style="height:26px;">';
  }
  ?>
  <a href="notAvailable.php" class="w3-bar-item w3-button w3-hide-small w3-right">Log Out</a>  
  <a href="inbox.php" class="w3-bar-item w3-button w3-hide-small w3-right">Inbox</a>
  <a href="myProfile.php" class="w3-bar-item w3-button w3-hide-small w3-right">My Profile</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-large w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
</div>

<!-- Mobile Menu -->
<div id="demo" class="w3-bar-block w3-metro-light-blue w3-hide w3-hide-large w3-hide-medium">
  <a href="myProfile.php" class="w3-bar-item w3-button">My Profile</a>
  <a href="inbox.php" class="w3-bar-item w3-button">Inbox</a>
  <a href="notAvailable.php" class="w3-bar-item w3-button">Log Out</a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("demo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
