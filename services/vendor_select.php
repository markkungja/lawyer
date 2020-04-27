<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$no = $conDB->sqlEscapestr($_GET['id']);
$docno = $conDB->sqlEscapestr($_GET['docno']);
$redirect = "<script>window.location.assign('../pages/purchase_edit.php?id=".$docno."')</script>";
$strSQL = "SELECT * FROM `vendor` WHERE `no` = '$no' LIMIT 1";
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
	
	$strSQL2 = "UPDATE `purchase_header` SET `sellercode` = '$code', `sellername` = '$name', `sellerdetail` = '$address', `sellerphone` = '$phone', `sellerfax` = '$fax', `selleremail` = '$email', `vatregisno` = '$vatregisno', `incoterm` = '$incoterms', `paymentterm` = '$paymentterm', `destination` = '$destination' WHERE `purchase_header`.`no` = '$docno'";
	$conDB->sqlQuery($strSQL2);
}
include("loading.php");
echo $alerts;
echo $redirect;
?>