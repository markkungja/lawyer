<?php
header('Cache-Control: no cache');
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$no = $conDB->sqlEscapestr($_POST['id']);
$date = date('Y-m-d');
$username = $_SESSION['USERNAME'];
if( $no != ''){
	$strSQL = "SELECT * FROM `noseries` WHERE `no` = '$no' LIMIT 1";
	$objQuery = $conDB->sqlQuery($strSQL);
	while($objResult = mysqli_fetch_assoc($objQuery)) {
		$next = $objResult['lastuse']+1;
		$type = $objResult['type'];
		$strSQL2 = "UPDATE `noseries` SET `lastuse` = '$next' WHERE `noseries`.`no` = '$no'";
		$conDB->sqlQuery($strSQL2);
		$code = $objResult['code'].sprintf("%03d",$next);
		
		if($type == 'PO'){
			$strSQL3 = "INSERT INTO `purchase_header` (`no`, `code`, `status`, `exdoc`, `sellercode`, `sellername`, `sellerdetail`, `sellerphone`, `sellerfax`, `selleremail`, `country`, `zone`, `vatregisno`, `incoterm`, `paymentterm`, `destination`, `date`, `remark`, `shipment`, `username`, `label`, `carton`, `transportation`, `shippingcost`, `vat`, `currency`, `discount`, `discountper`, `amount`, `sign1`, `sign3`, `sign2`, `sign4`, `attach`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '$username', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1')";
			$conDB->sqlQuery($strSQL3);
			$strSQL = "SELECT * FROM `purchase_header` WHERE `code` = '$code' LIMIT 1";
			$objQuery = $conDB->sqlQuery($strSQL);
			while($objResult = mysqli_fetch_assoc($objQuery)) {
				$redirect = "<script>window.location.href = '../pages/purchase_edit.php?id=".$objResult['no']."&act=edit'</script>";
			}

		}elseif($type == 'PI'){
			$strSQL3 = "INSERT INTO `proformainvoice_header` (`no`, `code`, `status`, `exdoc`, `buyercode`, `buyername`, `buyerdetail`, `buyerphone`, `buyerfax`, `buyeremail`, `country`, `zone`, `vatregisno`, `incoterm`, `paymentterm`, `finaldest`, `destination`, `date`, `remark`, `shipment`, `username`, `vat`, `currency`, `discount`, `discountper`, `amount`, `sign1`, `sign3`, `sign2`, `sign4`, `attach`, `accountno`, `enable`) VALUES ('', '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '', '$username', '', '', '', '', '', '', '', '', '', '', '', '1')";
			$conDB->sqlQuery($strSQL3);
			$strSQL = "SELECT * FROM `proformainvoice_header` WHERE `code` = '$code' LIMIT 1";
			$objQuery = $conDB->sqlQuery($strSQL);
			while($objResult = mysqli_fetch_assoc($objQuery)) {
				$redirect = "<script>window.location.href = '../pages/proformainvoice_edit.php?id=".$objResult['no']."&act=edit'</script>";
			}
			
		}elseif($type == 'QT'){
		}elseif($type == 'VD'){
			$strSQL3 = "INSERT INTO `vendor` (`no`, `code`, `name`, `phone`, `fax`, `email`, `attach`, `contract`, `comment`, `address`, `city`, `country`, `zone`, `region`, `postcode`, `vatregisno`, `branch`, `group`, `type`, `incoterms`, `paymentterm`, `remark`, `destination`, `createat`, `status`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '1')";
			$conDB->sqlQuery($strSQL3);
			$strSQL = "SELECT * FROM `vendor` WHERE `code` = '$code' LIMIT 1";
			$objQuery = $conDB->sqlQuery($strSQL);
			while($objResult = mysqli_fetch_assoc($objQuery)) {
				$redirect = "<script>window.location.href = '../pages/vendor_edit.php?id=".$objResult['no']."&act=edit'</script>";
			}
		}elseif($type == 'CM'){
			$strSQL3 = "INSERT INTO `customer` (`no`, `code`, `name`, `phone`, `fax`, `email`, `image`, `contract`, `comment`, `address`, `city`, `country`, `zone`, `region`, `postcode`, `vatregisno`, `branch`, `group`, `type`, `incoterms`, `paymentterm`, `remark`, `destination`, `createat`, `status`, `enable`) VALUES (NULL, '$code', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '$date', '', '1')";
			$conDB->sqlQuery($strSQL3);
			$strSQL = "SELECT * FROM `customer` WHERE `code` = '$code' LIMIT 1";
			$objQuery = $conDB->sqlQuery($strSQL);
			while($objResult = mysqli_fetch_assoc($objQuery)) {
				$redirect = "<script>window.location.href = '../pages/customer_edit.php?id=".$objResult['no']."&act=edit'</script>";
			}
		}elseif($type == 'IN'){
		}
	}
}
include("loading.php");
echo $alerts;
echo $redirect;
?>