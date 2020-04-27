<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$n = $conDB->sqlEscapestr($_GET['n']);
$t = $conDB->sqlEscapestr($_GET['t']);
echo $strSQL = "SELECT `$t`.`attach` FROM `$t` WHERE `$t`.`no` = '$n'";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	$attach = $objResult['attach'];
	@unlink("../dist/upload/".$attach);
	$strSQL2 = "UPDATE `$t` SET `$t`.`attach` = '' WHERE `$t`.`no` = '$n'";
	$conDB->sqlQuery($strSQL2);
}