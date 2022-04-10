<script src="https://kit.fontawesome.com/a6d0ff8634.js" crossorigin="anonymous"></script>
<div class="w3-bar w3-metro-dark-blue w3-large">
  <!--<a href="#" class="w3-bar-item w3-button">Home</a>-->
  <!--<a href="homeV2.php" class="w3-bar-item w3-button w3-metro-dark-blue"><i class="fa fa-home w3-margin-right"></i>Runner++</a>-->
  <a href="homeV2.php" class="w3-bar-item w3-button w3-metro-dark-blue"><img src="csub_logoV2.png" style="height:26px;">
  <!--<a href="" class="w3-bar-item w3-button w3-button-left w3-leftbar w3-border-white"></i>@tanderson</a>-->
  <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right">Log Out</a>  
  <a href="messages.php" class="w3-bar-item w3-button w3-hide-small w3-right">Inbox</a>
  <!-- <a href="profileSettings.php" class="w3-bar-item w3-button w3-hide-small w3-right">Settings</a> -->
  <a href="myProfile.php" class="w3-bar-item w3-button w3-hide-small w3-right">My Profile</a>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-large w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
</div>

<div id="demo" class="w3-bar-block w3-metro-light-blue w3-hide w3-hide-large w3-hide-medium">
  <!--<a href="" class="w3-bar-item w3-button">User: @tanderson</a>-->
  <a href="myProfile.php" class="w3-bar-item w3-button">My Profile</a>
  <a href="inbox.php" class="w3-bar-item w3-button">Inbox</a>
  <!-- <a href="profileSettings.php" class="w3-bar-item w3-button">Settings</a> -->
  <a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
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