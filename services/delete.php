<?php 
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$t = $conDB->sqlEscapestr($_POST['t']);
$v = $conDB->sqlEscapestr($_POST['v']);
$tf = $conDB->sqlEscapestr($_POST['tf']);

$strSQL = "DELETE FROM `$t` WHERE `$t`.`$tf` = '$v'";
$conDB->sqlQuery($strSQL);
echo $strSQL;
?>