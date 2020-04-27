<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$table = $conDB->sqlEscapestr($_POST['table']);
$f = $conDB->sqlEscapestr($_POST['f']);
$value = $conDB->sqlEscapestr($_POST['value']);


$strSQL_row = "SELECT * FROM $table WHERE `$f` = '$value'";
$numrow = $conDB->sqlNumrows($strSQL_row);
if($numrow == 0){
    echo "success";
} else {
    echo "error";
}
?>