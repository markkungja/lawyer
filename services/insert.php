<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

if(isset($_GET['type'])){
    $type = $conDB->sqlEscapestr($_GET['type']);
}

if(isset($_POST['type'])){
    $type = $conDB->sqlEscapestr($_POST['type']);
}

// if(isset($_GET['doc_id'])){
//     $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
// }

$username = $_SESSION['USERNAME'];

if($type == 'add_notis'){
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
    $table_name = 'document_notis';
    $strSQL = "INSERT INTO `$table_name` (`doc_id`, `doc_no`, `doc_create_date`, `doc_plaintiff_id`, `doc_plaintiff_name`, `doc_restructuring`, `doc_credit_type`, `doc_county`, `doc_notis_date`, `lawyer_id`, `lawyer_name`, `doc_status`, `create_by_user`) VALUES (NULL, '', CURRENT_TIMESTAMP, '', '', '', '', '', NULL, '', '', 'รอ', '$username');";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `$table_name` ORDER BY `document_notis`.`doc_create_date` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/notis_edit.php?id=".$objResult['doc_id']."&act=edit'</script>";
    }
}

if($type == 'add_filedoc'){
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
    $table_name = 'document_filedoc';
    $strSQL = "INSERT INTO `document_filedoc` (`doc_file_id`, `doc_id`, `doc_file_name`, `doc_file_text`, `doc_file_date`) VALUES (NULL, '$doc_id', '', '', CURRENT_TIMESTAMP);";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `document_filedoc` ORDER BY `document_filedoc`.`doc_file_date` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/filedoc_notis_edit.php?doc_id=".$doc_id."&doc_file_id=".$objResult['doc_file_id']."'</script>";
    }
}
if($type == 'insert_report'){
    $doc_report_name = $conDB->sqlEscapestr($_GET['doc_report_name']);
    $report_id = $conDB->sqlEscapestr($_GET['report_id']);
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);

    $table_name = 'document_report';
    $strSQL = "INSERT INTO `document_report` (`doc_report_id`, `doc_id`, `doc_report_name`, `doc_report_text`, `report_id`, `doc_report_date`, `doc_report_lastedit`) 
            VALUES (NULL, '$doc_id', '$doc_report_name', '', '$report_id', current_timestamp(), NULL);";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `document_report` ORDER BY `document_report`.`doc_report_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/report_edit.php?doc_id=".$doc_id."&doc_report_id=".$objResult['doc_report_id']."'</script>";
    }
}
if($type == 'add_plaintiff'){
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
    $strSQL = "INSERT INTO `plaintiff` (`plaintiff_id`,`enable`) VALUES (NULL,1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `plaintiff` ORDER BY `plaintiff`.`plaintiff_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/plaintiff_edit.php?plaintiff_id=".$objResult['plaintiff_id']."&doc_id=".$doc_id."'</script>";
    }
}
if($type == 'add_lawyer'){
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
    $strSQL = "INSERT INTO `lawyer` (`lawyer_id`,`enable`) VALUES (NULL,1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `lawyer` ORDER BY `lawyer`.`lawyer_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/lawyer_edit.php?lawyer_id=".$objResult['lawyer_id']."&doc_id=".$doc_id."'</script>";
    }
}
if($type == 'add_defendant'){
    $doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
    $strSQL = "INSERT INTO `defendant` (`defendant_id`,`enable`) VALUES (NULL,1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `defendant` ORDER BY `defendant`.`defendant_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/defendant_edit.php?defendant_id=".$objResult['defendant_id']."&doc_id=".$doc_id."'</script>";
    }
}

if($type == 'add_account'){
    $strSQL = "INSERT INTO `user_account` (`id`,`password`,`enable`) VALUES (NULL,'827ccb0eea8a706c4c34a16891f84e7b',1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `user_account` ORDER BY `user_account`.`id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/account_edit.php?account_id=".$objResult['id']."'</script>";
    }
}

if($type == 'add_department'){
    $strSQL = "INSERT INTO `department` (`department_id`,`enable`) VALUES (NULL,1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `department` ORDER BY `department`.`department_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/department.php'</script>";
    }
}

if($type == 'add_permission'){
    $strSQL = "INSERT INTO `permission` (`permission_id`,`enable`) VALUES (NULL,1)";
    $objQuery = $conDB->sqlQuery($strSQL);

    $strSQL = "SELECT * FROM `permission` ORDER BY `permission`.`permission_id` DESC LIMIT 1";
    $objQuery = $conDB->sqlQuery($strSQL);
    while($objResult = mysqli_fetch_assoc($objQuery)) {
        $redirect = "<script>window.location.href = '../pages/permission.php'</script>";
    }
}


include("loading.php");
echo $redirect;

?>