<?php 

require_once "navV2.php";

?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Settings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<body>
<!-- Page Container -->
<form action="" class="w3-container w3-card-4 w3-text-metro-dark-blue w3-margin">
    <h2 class="w3-center">Profile Settings</h2>
     
    <!-- First Name -->
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="myFirstName" type="text" placeholder="First Name">
        </div>
    </div>

    <!-- Last Name -->
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil-square"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="myLastName" type="text" placeholder="Last Name">
        </div>
    </div>

    <!-- Username -->
    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-at"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="myUsername" type="text" placeholder="Username">
            </div>
        </div>
    </div>

    <!-- Email -->
    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="myEmail" type="text" placeholder="Email">
            </div>
        </div>
    </div>

    <!-- Gender/Sex -->
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-users"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="gender" type="text" placeholder="Gender(M/F/N)">
        </div>
    </div>
    
    <!-- Address -->
    <!-- <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-home"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="address" type="text" placeholder="Current Address">
        </div>
    </div> -->

    <!-- Password-->
    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-check-circle"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="myPassword" type="text" placeholder="Password">
            </div>
        </div>
    </div>

    <!-- Re-Enter Password -->
    <div class="w3-row w3-section">
        <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-check-circle-o"></i></div>
            <div class="w3-rest">
                <input class="w3-input w3-border w3-round-large" name="myPassword" type="text" placeholder="Re-Enter Password">
            </div>
        </div>
    </div>
    
    <button class="w3-button w3-round-large w3-block w3-section w3-metro-dark-blue w3-ripple w3-padding">Submit</button>
    
</form>
</body>
</html>