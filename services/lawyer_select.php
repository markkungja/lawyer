<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$lawyer_id = $conDB->sqlEscapestr($_GET['lawyer_id']);
$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$redirect = "<script>window.location.assign('../pages/".$_SESSION['PAGE']."')</script>";
$strSQL = "SELECT * FROM `lawyer` WHERE `lawyer_id` = '$lawyer_id' LIMIT 1";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	$id = $objResult['lawyer_id'];
	$name = $objResult['lawyer_name'];
	
	$strSQL2 = "UPDATE `document_notis` SET `lawyer_id` = '$id', `lawyer_name` = '$name' WHERE `document_notis`.`doc_id` = '$doc_id';";
	$conDB->sqlQuery($strSQL2);
}
include("loading.php");
//echo $alerts;
echo $redirect;
?>