<?php 

session_start();

require_once "navV2.php";

if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
?>

    <body>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <body>
    <!-- Page Container -->
    <div class="w3-container w3-content" style="max-width:1400px;margin-top:16px">    
        <!-- The Grid -->
        <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                <h4 class="w3-center">My Profile</h4>
		        <p class="w3-center"><img src="<?php echo $_SESSION['imagePath']; ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                <!--<p class="w3-center"><img src="profile_pics/profilePicV3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>-->
                <hr>
                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['fName']; echo " "; echo $_SESSION['lName']; ?> </p>
                <p><i class="fa fa-at fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['uName']; ?> </p>
                <p><i class="fa fa-users fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['gender']; ?> </p>
                <!-- <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> 1400 F St, Apt 12</p> -->
                <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['email']; ?> </p>
                <hr>

                <!-- Reset Password Button -->
                <div class="w3-container w3-center">
                    <button class="w3-button w3-center w3-round-large w3-metro-dark-blue w3-ripple w3-margin-bottom w3-hover-green" type="" 
                        onclick="window.location.href='https://artemis.cs.csub.edu/~runnerpp/project/pwReset.php';"><i>New Password?</i></button>
                </div>

                </div>
            </div>
            <br>
        </div>
        </div>   
    </div>
    </body>
    </html>

<?php
} else {
    header("Location: indexV2.php?error=You must be logged in to view this page");
    exit();
}
?>
