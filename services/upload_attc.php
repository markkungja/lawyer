<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$doc_id = $_GET['doc_id'];
$doc_file_name = $_GET['doc_file_name'];
$type_attc = $_GET['type_attc'];

$time = date("Ymdhisa");
$location = "../src/attc/";
$sum = 0;
$sumlost = 0;

if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    $no_files = count($_FILES["files"]['name']);
    for ($i = 0; $i < $no_files; $i++) {
        if ($_FILES["files"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
        } else {
            if (file_exists($location . $_FILES["files"]["name"][$i])) {
                // echo 'File already exists : '. $location . $_FILES["files"]["name"][$i];
            } else {
                $filename = $time.$_FILES['files']['name'][$i];
                $imageFileType = pathinfo($filename,PATHINFO_EXTENSION);
                $valid_extensions = array("jpg","jpeg","png","pdf");
                if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
                    $sumlost= $sumlost+1;
                 }else{

                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $location . $filename);
                $sum = $sum+1;
                $strSQL ="INSERT INTO `document_attc` (`attc_id`, `doc_id`, `attc_name`, `attc_file`, `attc_type`) 
                        VALUES (NULL, '$doc_id', '$doc_file_name', '$filename', '$type_attc')";
                $result=$conDB->sqlQuery($strSQL) ;
                 }
            }
        }
    }
    echo 'อัพโหลดแล้ว '.$sum.' ล้มเหลว '.$sumlost;
} else {
    echo 'false';
}


?>