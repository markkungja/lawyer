<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$n = $conDB->sqlEscapestr($_POST['n']); //No.
$t = $conDB->sqlEscapestr($_POST['t']); //Table
$tf = $conDB->sqlEscapestr($_POST['tf']); //Table
$v = $conDB->sqlEscapestr($_POST['v']); //Value
$f = $conDB->sqlEscapestr($_POST['f']); //Field
$strSQL = "UPDATE `$t` SET `$f` = '$v' WHERE `$t`.`$tf` = '$n'";
$conDB->sqlQuery($strSQL);
echo $strSQL;
?>