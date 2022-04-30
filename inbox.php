<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";


if(isset($_SESSION['uID']) && isset($_SESSION['uName'])) {
	if (isset($_POST['message'])) {
		$messID = $_POST['message'];
		if($_SESSION['position'] == "Faculty") {
			$sent = $_SESSION['fID'];
		} else {
			$sent = $_SESSION['sID'];
		}
		$time = date('h:i');
		$insert_mess = $db->prepare("INSERT INTO Walk".$_SESSION['walkID']."(fID, sID, nID, sentBy, timeSent) VALUES (?, ?, ?, ?, ?)");
		$insert_mess->bind_param('iiiis', $_SESSION['fID'], $_SESSION['sID'], $messID, $sent, $time);
		if($insert_mess->execute()) {
		} else {
			echo mysqli_error($db);
		}
		die();
	}
	else if (isset($_POST['getMessages'])){
		header("Content-type:application/json");

		$getMessages = $db->prepare("SELECT Message, sentBy, timeSent FROM (SELECT Message, sentBy, timeSent, messageID FROM Walk".$_SESSION['walkID']." NATURAL JOIN Notify ORDER BY messageID DESC LIMIT 5)recents ORDER BY messageID ASC");
		if($getMessages->execute()) {
		} else {
			echo json_encode(array("error" => mysqli_error($db)));
		}	
		$resMess = $getMessages->get_result();
		$rows1 = [];
		while($mess = $resMess->fetch_assoc()) {
			$messElem = "";
			if($_SESSION['position'] == "Faculty") {
				if($_SESSION['fID'] == $mess['sentBy']) {
					$messElem .= '<div style="display: flex; flex-direction: row-reverse">';
					$messElem .= '<div class="w3-panel w3-rightbar w3-right-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;">';
					$messElem .= '<p style="color: #C0C0C0; display: inline-block" align="right">'.$mess['timeSent'].'</p> <p style="display: inline-block" align="right">'.$mess['Message'].'</p>';
					$messElem .= '</div>';
					$messElem .= '</div>';
				} else {
					$messElem .= '<div style="display: flex; flex-direction: row">';
					$messElem .= '<div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-yellow" style="font-style: italic;">';
					$messElem .= '<p style="display: inline-block" align="right">'.$mess['Message'].'</p> <p style="color: #A9A9A9; display: inline-block" align="right">'.$mess['timeSent'].'</p>';
					$messElem .= '</div>';
					$messElem .= '</div>';
				}
			} else {
				if($_SESSION['fID'] == $mess['sentBy']) {
					$messElem .= '<div style="display: flex; flex-direction: row">';
					$messElem .= '<div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;">';
					$messElem .= '<p style="display: inline-block" align="right">'.$mess['Message'].'</p> <p style="color: #C0C0C0; display: inline-block" align="right">'.$mess['timeSent'].'</p>';
					$messElem .= '</div>';
					$messElem .= '</div>';
				} else {
					$messElem .= '<div style="display: flex; flex-direction: row-reverse">';
					$messElem .= '<div class="w3-panel w3-rightbar w3-right-align w3-round-xlarge w3-metro-yellow" style="font-style: italic;">';
					$messElem .= '<p style="color: #A9A9A9; display: inline-block" align="right">'.$mess['timeSent'].'</p> <p style="display: inline-block" align="right">'.$mess['Message'].'</p>';
					$messElem .= '</div>';
					$messElem .= '</div>';
				}
			}
			
			$rows1[] = $messElem;
		}
		echo json_encode($rows1);
		die();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"
integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY="
crossorigin="anonymous">
</script>

	<script>
	function sendMessages(evt) {
		evt.preventDefault();

		let messageID = evt.target[0].value;

		let args = {
			message: messageID
		};
		$.post("inbox.php", args)
			.done(function (result, status, xhr) {
			})
			.fail(function (xhr, status, error) {
				$("#messages").html('Error approving post: ${error}, responseText: ${xhr.responseText}');
			});
	}

	function getMessages() {
		let args = {
		getMessages: true
	};
		$.post("inbox.php", args)
			.done(function (result, status, xhr) {
				if (status == "success") {
					console.log(result); 
					let messages = document.getElementById("messages");
					messages.innerHTML = "";

					for (let m of result) {
						messages.innerHTML += m;
					}
				}
				else {
					$("#messages").html("Error approving post: " + result);
				}
			})
			.fail(function (xhr, status, error) {
				$("#messages").html('Error approving post: ${error}, responseText: ${xhr.responseText}');
			});
	}

	setInterval(getMessages, 1000);
	</script>
</head>

<body>

<?php
	require_once "navV2.php";
	/*	$partnerName = $db->prepare("SELECT fName from User where uID=".$_SESSION['fID']." OR uID=".$_SESSION['sID']);
		if($partnerName->execute()) {
		} else {
			echo mysqli_error($db);
		}	
		mysqli_stmt_bind_result($partnerName, $facName, $stuName);
		if ($partnerName->fetch()) {
			if ($_SESSION['position'] == "Faculty") {
				$_SESSION['partnerName'] = $stuName;
			} else {
				$_SESSION['partnerName'] = $facName;
			}
}*/
?>


<!-- page container - needed for submit -->

    <!-- Output Container -->
    <div class="w3-container w3-center w3-padding-16" style="height: 75%">

		<div id="messages" style="height: 450px">
		</div>

    </div>   

    <!-- Predetermined Messages -->
    <div class="w3-container w3-center w3-bottom">
	<hr class="w3-grey">
<form action="" method="POST" onsubmit="sendMessages(event)">
	<select class="w3-select w3-border w3-margin-bottom" style="width: 100%; font-size: 16px" name="message">
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
	<button class="w3-button w3-ripple w3-round-large w3-metro-dark-blue w3-hover-green w3-margin-bottom" style="width: 100%;" type="submit">Send 
		<i class="fa-solid fa-paper-plane"></i></button>
</form>
</div>
</body>
</html>

<?php
} else {
	header("Location: indexV2.php?error=You must be logged in to view this page");
	exit();
}
?>
