<?php
session_start();

include "connectToDB.php";
include "dbfunctions.php";

require "retrieve.php";

// if  there are two users that match to walk together
// share the location with each other and display on the map
//

// 
$loc = $db->query(SELECT * FROM location");



?>
