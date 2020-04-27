<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$plaintiff_id = $conDB->sqlEscapestr($_GET['plaintiff_id']);
$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$redirect = "<script>window.location.assign('../pages/".$_SESSION['PAGE']."')</script>";
$strSQL = "SELECT * FROM `plaintiff` WHERE `plaintiff_id` = '$plaintiff_id' LIMIT 1";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	$id = $objResult['plaintiff_id'];
	$name = $objResult['plaintiff_name'];
	
	$strSQL2 = "UPDATE `document_notis` SET `doc_plaintiff_id` = '$id', `doc_plaintiff_name` = '$name' WHERE `document_notis`.`doc_id` = '$doc_id';";
	$conDB->sqlQuery($strSQL2);
}
include("loading.php");
//echo $alerts;
echo $redirect;
?>