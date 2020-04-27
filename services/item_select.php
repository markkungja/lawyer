<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$docno = $conDB->sqlEscapestr($_GET['docno']);
$itemno = $conDB->sqlEscapestr($_GET['itemno']);
$t =  $conDB->sqlEscapestr($_GET['t'])."_header";
$line =  $conDB->sqlEscapestr($_GET['t'])."_line";
$redirect = "<script>window.history.go(-2)</script>";
$strSQL = "SELECT *,(SELECT `$t`.`code` FROM `$t` WHERE `$t`.`no` = '$docno')AS 'docno' FROM `inventory` WHERE `code` = '$itemno' LIMIT 1";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	
	$no = $objResult['no'];
	$code = $objResult['docno'];
	$itemcode = $objResult['code'];
	$description = $objResult['description'];
	$qty = 1;
	$load = $objResult['load'];
	$uom = $objResult['uom'];
	$discount = $objResult['discount'];
	$discountper = $objResult['discountper'];
	$amount = $objResult['price'];
	$mark = $objResult['mark'];
	$applydoc = $objResult['applydoc'];
	
	$strSQL2 = "SELECT * FROM `$line` WHERE `$line`.`code`= '$code'  AND `itemcode` = '$itemno'";
	$exist = $conDB->sqlNumrows($strSQL2);
	if($exist == 0){
		$strLine = "INSERT INTO `$line` (`no`, `code`, `itemcode`, `description`, `qty`, `load`, `uom`, `discount`, `discountper`, `amount`, `mark`, `applydoc`) VALUES (null, '$code', '$itemcode', '$description', '$qty', '$load', '$uom', '$discount', '$discountper', '$amount', '$mark', '$applydoc')";
		$conDB->sqlQuery($strLine);
	}
}
include("loading.php");
echo $alerts;
echo $redirect;
?>