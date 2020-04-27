<?php 
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$t = $conDB->sqlEscapestr($_POST['t']);
$v = $conDB->sqlEscapestr($_POST['v']);
$tf = $conDB->sqlEscapestr($_POST['tf']);
$ff = $conDB->sqlEscapestr($_POST['ff']);

$strSQL ="SELECT * FROM `$t` WHERE `$t`.`$tf` = '$v'";
$objQuery = $conDB->sqlQuery($strSQL);
$location = "../src/attc/";
$objResult = mysqli_fetch_assoc($objQuery);

if (file_exists($location.$objResult[$ff])) {
    $myFile = $location.$objResult[$ff];
    unlink($myFile);
}

$strSQL = "DELETE FROM `$t` WHERE `$t`.`$tf` = '$v'";
$conDB->sqlQuery($strSQL);
echo $strSQL;
?>