<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$doc_id =  $conDB->sqlEscapestr($_GET['doc_id']);
if($doc_id != ''){
    for($i=1;$i<=8;$i++){
        echo $strSQL = "INSERT INTO `document_report` (`doc_id`, `report_id`) VALUES ('$doc_id', '$i');";
        $objQuery = $conDB->sqlQuery($strSQL);
    }
}
//echo "<script>window.location.href = '../pages/notis_edit.php'</script>";
?>