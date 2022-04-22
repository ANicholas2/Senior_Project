<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";
require_once "navV2.php";


if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
?>

<body>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Messages</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="apple-touch-icon" sizes="180x180" href="favicon_package_v0/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon_package_v0/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon_package_v0/favicon-16x16.png">
<link rel="manifest" href="favicon_package_v0/site.webmanifest">
<link rel="mask-icon" href="favicon_package_v0/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<!--<meta http-equiv="refresh" content="10">-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yEx1q6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous">
</script>

<body>

<?php
	if(isset($_POST["getMessages"]) {
		$all = $db->prepare("SELECT Message FROM Walk".$_SESSION['walkID']." NATURAL JOIN Notify ORDER BY id DESC");
		$all->execute();
		$resMess = $all->get_result();

		$results = [];

		while ($mess = $resMess->fetch_assoc()) {
			$results [] = $mess;
		}

		echo json_encode($results);
		die();
		/*$count = 0;
		while ($count < sizeof($results) {
		//if($_SESSION["position"] == "Faculty") {
		echo '<div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;">';
		echo '<p>'.$results[$count].'</p>';
		echo '</div>';
		} else {
			echo $rows1["Message"];
		}
		}
		$count= $count + 1;*/
	}

?>

<!-- page container - needed for submit -->

    <!-- Output Container -->
    <div class="w3-container w3-center w3-padding-16" style="height: 75%">

	<!-- Connected Username -->
	<p style="color: #2A558C"><b>@FacultyMember</b></p>
	<hr class="w3-grey">

	<!-- Singular Message Container  -->
	<!-- <p class="w3-tiny w3-right-align">@username</p> -->
	<!-- <div class="w3-panel w3-rightbar w3-right-align w3-round-xlarge w3-metro-yellow" style="font-style: italic; position: relative; right: 0%; width: 50%;"> -->
	    <!-- <p class="w3-tiny w3-right-align">@username</p> -->
	    <!-- <p>Hello</p> -->
	<!-- </div> -->

	<!-- Singular Message Container  -->
	<!-- <div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;"> -->
	    <!-- <p>On my way</p> -->
	<!-- </div> -->
	<script>
	function getMessages() {
		let args = {
		getMessages: true
	};
		$.post("ericka_inbox.php", args)
			.done(function (result, status, xhr) {
				if (status == "success") {
					console.log(result);
					let messages = document.getElementById("messages");
					messages.innerHTML = "";

					for (let m of result) {
						messages.innerHTML += m.Message + "<br>";
					} 
				}
				else {
					$("#messages").html("Error retrieving message!");
				}
			} )
			.fail(function (xhr, status, error) {
				$("#messages").html("Error sending message!");
			});
	}

	setInterval(getMessages, 500);
	</script>

<?php
	if(isset($_POST['message'])) {
		$messID = $_POST['message'];

		$insert_mess = $db->prepare("INSERT INTO Walk".$_SESSION['walkID']."(fID, sID, nID) VALUES (?, ?, ?)");
		$insert_mess->bind_param('iii', $_SESSION['fID'], $_SESSION['sID'], $messID);
		if($insert_mess->execute()) {
		} else {
			echo mysqli_error($db);
		}
	}
?>

    </div>   

    <!-- Predetermined Messages -->
    <div class="w3-container w3-center">
	<hr class="w3-grey">
<form action="" method="POST">
	<select class="w3-select w3-border w3-margin-bottom" style="width: 100%" name="message">
		<option value="" disabled selected>Choose a message:</option>
<?php
	$result = mysqli_query($db, "SELECT nID, Message FROM Notify");
	if (mysqli_num_rows($result) > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {
			echo "<option value='".$rows["nID"]."'>".$rows["Message"]."</option>";
		}
	}
	else { 
		echo "Error: Messaging";
	}
?>
	</select></br>
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green" style="width: 100%;" type="submit">Send 
		<i class="fa-solid fa-paper-plane"></i></button>
</form>

<hr class="w3-grey">

</div>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
