<?php

session_start();

include "connectToDB.php";
include "dbfunctions.php";

if(mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
}

if (isset($_POST['updateLocationForMe'])) {

    // Prepare an insert statement into Geolocation table
    $query = $db->prepare("INSERT INTO Geolocation (user_ID, latitude, longitude) VALUES (?, ?, ?)");

    // Bind the variables to the parameter as integers and floats.
    $query->bind_param("iff", $_SESSION["uID"], $_POST["lat"], $_POST["lon"]);

    // Execute the statement
    if ($query->execute()) {
    } else {
		echo mysqli_error($db);
	}

    //$query = $query->get_result();

}

?>
<?php

