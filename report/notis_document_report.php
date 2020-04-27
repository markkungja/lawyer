<?php
session_start();
ob_start();

include("../connect/database.php");
$conDB = new db_conn();

$doc_file_id = $conDB->sqlEscapestr($_GET['doc_file_id']);

$strSQL = "SELECT * FROM `document_filedoc` WHERE `doc_file_id` = '$doc_file_id' ORDER BY `doc_file_date` DESC";
$objQuery = $conDB->sqlQuery($strSQL);
$objResult = mysqli_fetch_assoc($objQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: rgb(204,204,204); 
        }
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        page[size="A4"] {  
            width: 21cm;
            height: 29.7cm; 
        }
        @media print {
            body, page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>
<body>
    <page id="data" size="A4">
    <?php
        echo $objResult['doc_file_text'];
    ?>
    </page>

</body>

</html>