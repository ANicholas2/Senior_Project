<?php 
session_start();

//connecting to DB
include "connectToDB.php";
include "dbfunctions.php";

if(isset($_POST['message'])) {
	header("Content-type: application/json");

	$getMessages = $db->prepare("SELECT Message FROM Walk".$_SESSION['walkID']." NATURAL JOIN Notify ORDER BY messageID ASC");
	if($getMessages->execute()) {
	}
	else {
		echo mysqli_error($db);
	}	
	$resMess = $getMessages->get_result();
	$rows1 = [];
	while($mess = $resMess->fetch_assoc()) {
		$rows1 [] = $mess;

		/*echo '<div style="display: flex; flex-direction: row">';
		echo '<div class="w3-panel w3-leftbar w3-left-align w3-round-xlarge w3-metro-dark-blue" style="font-style: italic;">';
		echo '<p>'.$rows1["Message"].'</p>';
		echo '</div>';
		echo '</div>';*/
	}

	echo json_encode($rows1);
	die();
}	

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title> GETTING MESSAGES </title>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJu5yEx1q6GSYGSHk7tPXkynS7ogEvDej/m4="
crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
crossorigin="anonymous">
</script>
<style type="text/css">

body {
	margin:40px auto;
	max-width:650px;
line-height:1.6;
font-size:18px;
color:#444;
padding:0 10px
}

h1, h2, h3 {
	line-height:1.2
}

.controls > a {
	padding: 0 4px;
}

</style>

<script>
function getMessages() {
	let args = {
		getMessages: true
};
$.post("printer.php", args)
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
			$("#messages").html("Error approving post: " + result);
		}
	})
	.fail(function (xhr, status, error) {
		$("#messages").html("Error approving post: ${error}, responseText: ${xhr.responseText}");
	});
}

setInterval(getMessages, 1000);

</script>
<script type="text/javascript">
function reloadPage()
{
	getMessages();
	window.location.reload()
	
}
</script>
</head>
<body>
<!--button onclick="getMessages()">Get messages</button>-->
<div id="messages">
</div>
</body>
</html>
