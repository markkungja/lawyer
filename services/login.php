<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$myObj = (object)array();
$username = $conDB->sqlEscapestr($_POST['username']);
$password = $conDB->sqlEscapestr($_POST['password']);

$strSQL = "SELECT * FROM `user_account` WHERE `username` = '".$username."' AND `password` = '".md5($password)."' LIMIT 1";
$exist = $conDB->sqlNumrows($strSQL);
if($exist == 0){
	$myObj->alerts = 'Username or password is incorrect. Please check.';
}else{
	$objQuery = $conDB->sqlQuery($strSQL);
	while($objResult = mysqli_fetch_assoc($objQuery)) {
		if( $objResult['enable'] == 0){
			$myObj->alerts = 'Your account has been suspended. Please contact the system administrator.';
		}else{
			$_SESSION['USERNAME'] = $objResult['username'];
			$myObj->message = $_SESSION['USERNAME'];
			$myObj->redirect = "../";
			$_SESSION['PAGE'] = "dashboard.php";
		}
	}
}
$myJSON = json_encode($myObj);
echo $myJSON;
?>