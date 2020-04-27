<?php
session_start();
ob_start();
include("../connect/database.php");
include("../dist/php/function.php");
$conDB = new db_conn();
$funcPHP = new func_php();
$t = $conDB->sqlEscapestr($_GET['t']);
$n = $conDB->sqlEscapestr($_GET['n']);
$attach = $funcPHP->getfileattechname($_FILES["attach"]["name"]);
$temp_attach = $conDB->sqlEscapestr($_POST['temp_attach']);
$curr_attach = $conDB->sqlEscapestr($_POST['curr_attach']);
$redirect = "<script>window.history.go(-1)</script>";
if(($temp_attach == '') && ($attach == '')){
	@unlink("../dist/upload/".$curr_attach);
}else{
	if($attach == ''){
		$attach = $curr_attach;
	}
}
$strSQL = "UPDATE `$t` SET `$t`.`attach` = '$attach' WHERE `$t`.`no` = '$n'";
if($conDB->sqlQuery($strSQL)){
	@move_uploaded_file($_FILES["attach"]["tmp_name"],"../dist/upload/".$attach);
	@unlink("../dist/upload/".$curr_attach);
}else{
	@unlink("../dist/upload/".$attach);
}
include("loading.php");
echo $alerts;
echo $redirect;
?>