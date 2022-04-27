<?php
session_start();

include "connectToDB.php";
include "dbfunctions.php";

if (isset($_POST["getPartnerLoc"])){

	$getPartnerLoc = $db->prepare("SELECT *  FROM location where  uID == PartnerID");
	$getPartnerLoc->execute();
	$partnerLocResult = $getMessages->get_result();

	$results = [];

	while ($pLoc = $ = $partnerLocResult->fetch_assoc(){
		$results []= $pLoc;
	} 

}



?>
