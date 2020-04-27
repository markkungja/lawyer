<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$no = $conDB->sqlEscapestr($_GET['id']);
$docno = $conDB->sqlEscapestr($_GET['docno']);
$redirect = "<script>window.location.assign('../pages/".$_SESSION['PAGE']."')</script>";
$strSQL = "SELECT * FROM `customer` WHERE `no` = '$no' LIMIT 1";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	$code = $objResult['code'];
	$name = $objResult['name'];
	$address = $objResult['address']." ".$objResult['post'];
	$phone = $objResult['phone'];
	$vatregisno = $objResult['vatregisno'];
	$fax = $objResult['fax'];
	$email = $objResult['email'];
	
	$incoterms = $objResult['incoterms'];
	$paymentterm = $objResult['paymentterm'];
	$destination = $objResult['destination'];
	$finaldest = $objResult['finaldest'];
	
	$strSQL2 = "UPDATE `proformainvoice_header` SET `buyercode` = '$code', `buyername` = '$name', `buyerdetail` = '$address', `buyerphone` = '$phone', `buyerfax` = '$fax', `buyeremail` = '$email', `incoterm` = '$incoterms', `paymentterm` = '$paymentterm', `finaldest` = '$finaldest', `destination` = '$destination' WHERE `proformainvoice_header`.`no` = '$docno'";
	$conDB->sqlQuery($strSQL2);
}
include("loading.php");
echo $alerts;
echo $redirect;
?>