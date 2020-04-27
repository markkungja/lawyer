<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();
$defendant_id = $conDB->sqlEscapestr($_GET['defendant_id']);
$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$redirect = "<script>window.location.assign('../pages/".$_SESSION['PAGE']."')</script>";
$strSQL = "SELECT * FROM `defendant` WHERE `defendant_id` = '$defendant_id' LIMIT 1";
$objQuery = $conDB->sqlQuery($strSQL);
while($objResult = mysqli_fetch_assoc($objQuery)) {
	$id = $objResult['defendant_id'];
    $name = $objResult['defendant_name'];
    $no = $objResult['defendant_no'];
}

$strSQL3 = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id' AND `defendant_id` = '$id'";
$numrow = $conDB->sqlNumrows($strSQL3);
if($numrow == 1){
    ?>
    <script>
        alert('นอติสนี้มีชื่อจำเลยนี้แล้ว');
        window.history.back();
    </script>
     <?php
}else{

$strSQL2 = "INSERT INTO `document_def` (`doc_def_id`, `doc_id`, `defendant_id`, `doc_def_name`, `doc_def_no`) VALUES (NULL, '$doc_id', '$id', '$name', '$no');";
$conDB->sqlQuery($strSQL2);

include("loading.php");
//echo $alerts;
echo $redirect;

}
?>