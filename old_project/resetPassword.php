<?php

//connecting to DB
include("connectToDB.php");
//include("dbfunctions.php");

?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Reset Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script src="projectV2.js"></script>

<body>
<!-- Page Container -->
<form action="/~runnerpp/project/homeV2.php" method="post" class="w3-container w3-card-4 w3-text-metro-dark-blue w3-margin">
    <h2 class="w3-center"><img src="csub_logoV3.png" style="height:64px"></h2>
    
    <!-- Username -->
    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-at"></i></div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="myUsername" type="text" placeholder="Username">
        </div>
    </div>

    <!-- Password -->
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
                <input class="w3-input w3-border w3-round-large" name="rePassword" type="text" placeholder="Re-Enter Password">
            </div>
        </div>
    </div>
    
    <button class="w3-button w3-round-large w3-block w3-section w3-metro-dark-blue w3-ripple w3-padding" type="submit"><b>Reset Password</b></button>

</form>

<!-- Error Alert -->
<?php if(isset($_GET['error'])) { ?>
    <div class="w3-panel w3-red">
        <h3>Error!</h3>
            <p> <?php echo $_GET['error']; ?> </p>
    </div>  
<?php } ?>
</body>
</html>
