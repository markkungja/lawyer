<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$type = $conDB->sqlEscapestr($_POST['type']);
$code = $conDB->sqlEscapestr($_POST['code']);
$date = date('Y-m-d');
$username = $_SESSION['USERNAME'];
if($type == 'PO'){
	$strSQL = "SELECT * FROM `purchase_header` WHERE `purchase_header`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
		$strSQL3 = "INSERT INTO `purchase_header` (`no`, `code`, `status`, `exdoc`, `sellercode`, `sellername`, `sellerdetail`, `sellerphone`, `sellerfax`, `selleremail`, `country`, `zone`, `vatregisno`, `incoterm`, `paymentterm`, `destination`, `date`, `remark`, `shipment`, `username`, `label`, `carton`, `transportation`, `shippingcost`, `vat`, `currency`, `discount`, `discountper`, `amount`, `sign1`, `sign3`, `sign2`, `sign4`, `attach`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '$username', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1')";
		$conDB->sqlQuery($strSQL3);
		$strSQL = "SELECT * FROM `purchase_header` WHERE `code` = '$code' LIMIT 1";
		$objQuery = $conDB->sqlQuery($strSQL);
		while($objResult = mysqli_fetch_assoc($objQuery)) {
			$redirect = "<script>window.location.href = '../pages/purchase_edit.php?id=".$objResult['no']."&act=edit'</script>";
		}
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}

}elseif($type == 'PI'){
	$strSQL = "SELECT * FROM `proformainvoice_header` WHERE `proformainvoice_header`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
		$strSQL3 = "INSERT INTO `proformainvoice_header` (`no`, `code`, `status`, `exdoc`, `buyercode`, `buyername`, `buyerdetail`, `buyerphone`, `buyerfax`, `buyeremail`, `country`, `zone`, `vatregisno`, `incoterm`, `paymentterm`, `finaldest`, `destination`, `date`, `remark`, `shipment`, `username`, `vat`, `currency`, `discount`, `discountper`, `amount`, `sign1`, `sign3`, `sign2`, `sign4`, `attach`, `accountno`, `enable`) VALUES ('', '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '$username', '', '', '', '', '', '', '', '', '', '', '', '1')";
		$conDB->sqlQuery($strSQL3);
		$strSQL = "SELECT * FROM `proformainvoice_header` WHERE `code` = '$code' LIMIT 1";
		$objQuery = $conDB->sqlQuery($strSQL);
		while($objResult = mysqli_fetch_assoc($objQuery)) {
			$redirect = "<script>window.location.href = '../pages/proformainvoice_edit.php?id=".$objResult['no']."&act=edit'</script>";
		}
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}
}elseif($type == 'QT'){
	$strSQL = "SELECT * FROM `quotation_header` WHERE `quotation_header`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}
}elseif($type == 'VD'){
	$strSQL = "SELECT * FROM `vendor` WHERE `vendor`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
		$strSQL3 = "INSERT INTO `vendor` (`no`, `code`, `name`, `phone`, `fax`, `email`, `attach`, `contract`, `comment`, `address`, `city`, `country`, `zone`, `region`, `postcode`, `vatregisno`, `branch`, `group`, `type`, `incoterms`, `paymentterm`, `remark`, `destination`, `createat`, `status`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '1', '1')";
		$conDB->sqlQuery($strSQL3);
		$strSQL = "SELECT * FROM `vendor` WHERE `code` = '$code' LIMIT 1";
		$objQuery = $conDB->sqlQuery($strSQL);
		while($objResult = mysqli_fetch_assoc($objQuery)) {
			$redirect = "<script>window.location.href = '../pages/vendor_edit.php?id=".$objResult['no']."&act=edit'</script>";
		}
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}
}elseif($type == 'CM'){
	$strSQL = "SELECT * FROM `customer` WHERE `customer`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
		$strSQL3 = "INSERT INTO `customer` (`no`, `code`, `name`, `phone`, `fax`, `email`, `image`, `contract`, `comment`, `address`, `city`, `country`, `zone`, `region`, `postcode`, `vatregisno`, `branch`, `group`, `type`, `incoterms`, `paymentterm`, `remark`, `destination`, `createat`, `status`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '1')";
		$conDB->sqlQuery($strSQL3);
		$strSQL = "SELECT * FROM `customer` WHERE `code` = '$code' LIMIT 1";
		$objQuery = $conDB->sqlQuery($strSQL);
		while($objResult = mysqli_fetch_assoc($objQuery)) {
			$redirect = "<script>window.location.href = '../pages/customer_edit.php?id=".$objResult['no']."&act=edit'</script>";
		}
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}
}elseif($type == 'IN'){
	$strSQL = "SELECT * FROM `inventory` WHERE `inventory`.`code` = '".$code."' ";
	$exist = $conDB->sqlNumrows($strSQL);
	if($exist == 0){
	}else{
		$alerts = "<script>alert('Your no.series \"".$code."\" already exists. Please Check.')</script>";
		$redirect = "<script>window.history.back()</script>";
	}
}
include("loading.php");
echo $alerts;
echo $redirect;
?>
