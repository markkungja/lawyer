<?php
session_start();
ob_start();
include("../../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$doc_report_id = $conDB->sqlEscapestr($_GET['doc_report_id']);

// $_SESSION['PAGE'] = "../pages/report_edit.php?doc_id=".$doc_id."&doc_report_id=".$doc_report_id;

$strSQL_notis = "SELECT * FROM `document_notis` LEFT JOIN `plaintiff` ON document_notis.doc_plaintiff_id = plaintiff.plaintiff_id LEFT JOIN `lawyer` ON document_notis.lawyer_id = lawyer.lawyer_id WHERE document_notis.doc_id = '$doc_id'";
$objQuery_notis = $conDB->sqlQuery($strSQL_notis);
$objResult_notis = mysqli_fetch_assoc($objQuery_notis);

$strSQL = "SELECT * FROM `document_report` LEFT JOIN report ON document_report.report_id = report.report_id WHERE `doc_report_id` = '$doc_report_id'";
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
    <link rel="stylesheet" type="text/css" href="form_css.css">
    <!-- <style>
        @font-face {
            font-family: myFont;
            src: url(../font/cordia.ttf);
        }
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-size: 21px;
            font-weight: 100;
            font-family: myFont;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .navbar{
            color: white;
            background-color: #333;
            position: fixed;
        }
        .page {
            width: 210mm;
            /* min-height: 297mm; */
            padding-top: 10mm;
            padding-left: 20mm;
            padding-right: 10mm;
            padding-bottom: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .A4{
            background: white;
            width: 21cm;
            height: 29.7cm;
            display: block;
            margin: 10 auto;
            padding: 50px 25px;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            /* overflow-y: scroll; */
            box-sizing: border-box;
            font-size: 17pt;
        }
        .subpage {
            padding: 0.5cm;
            /* border: 5px red solid; */
            height: 277mm;
            /* outline: 1cm #FFEAEA solid; */
        }
        header,
        footer {
            /* position: relative; */
            left: 0;
            right: 0;
            /* background-color: #ccc; */
            /* padding-right: 1.5cm;
            padding-left: 1.5cm; */
        }
        header {
            top: 0;
            font-family: myFont;
            /* padding-top: 5mm;
            padding-bottom: 3mm; */
        }
        footer {
            bottom: 0;
            color: #000;
            padding-top: 3mm;
            padding-bottom: 5mm;
        }
        .form{
            position: absolute;
            z-index: -1;
        }

        .left-top{
            vertical-align: top;
            text-align: left;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .normal-line{
            line-height: 0.6cm;
        }
        .short-line{
            line-height: 0.2cm;
        }
        .parag{
            text-indent: 2.5em;
        }
        .text-center{
            text-align: center;
        }

        /* Text Box Start*/

        .absolute {
            position: absolute;
            font-family: myFont;
        }
        .transparent{
            background: transparent;
            font-family: myFont;
            font-size: 21px;
            margin-top: -3px;
            /* border: 0; */
        }
        .text1 {
            position: absolute;
            /* padding-inline-start : 100px */
            /* padding-top: 50px; */
            /* margin-left: 20px; */
        }
        #print_helper {
            /* display: none; */
        }

        /* Text Box End */

        p.line {border-top: 2px solid black;}
        
        @page {
            size: A4;
            margin: 0;
            /* padding: 10px; */
        }
        @media print {
            body {
                width: 210mm;
                height: 297mm;
            }
            .page {
                display: block;
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                /* min-height: initial; */
                box-shadow: initial;
                background: initial;
                page-break-before: always;
                /* page-break-after:auto;
                position:relative;
                display:block; */
               
            }
            .page-break {
                display: block;
                page-break-before: always;
            }
            size: A4 portrait;

            .A4 {
                box-shadow: none;
                margin: 0;
                width: auto;
                height: auto;
            }
            
            
            #print_helper { 
                display: block;
                overflow: visible;
                font-family: myFont;
                white-space: pre;
                white-space: pre-wrap;
                page-break-after: auto;
                /* margin-top:0.5in; */
            }
            #the_textarea {
                display: none;
            }
            .transparent{
                border: 0;
            }
            header,
            footer {
                /* position: relative; */
                left: 0;
                right: 0;
                top :0;
                /* padding-right: 1.5cm;
                padding-left: 1.5cm; */
            }
            .navbar{
                display: none;
            }
        }
    </style> -->
    
</head>
<body>
<div class="navbar">
    <button type="button" class="btn btn-app flat"  onClick="save_report()">
        <img src="../../dist/img/icon/save.svg" width="20"><br>
        บันทึก
    </button>
    <button type="button" class="btn btn-app flat"  onClick="print_report()">
        <img src="../../dist/img/icon/print.svg" width="20"><br>
        พิมพ์
    </button>
</div>

<div class="book" class="book" id="div_id">
<input type="hidden" id="doc_report_id" name="doc_report_id" value="<?php echo $doc_report_id ?>">
    <div class="page">
        <div class="subpage">
            <p class="short-line">คำขอท้ายฟ้องคดีผู้บริโภค</p>
            <p class="short-line parag">ขอศาลโปรดออกหมายเรียกจำเลยมาพิจารณาพิพากษาและบังคับจำเลยตามคำขอต่อไปนี้</p>
            <a class="absolute"><textarea style="margin-top:-17px;line-height:1.35;font-size: 21px;font-family: myFont;" rows="6" cols="80" class="transparent" id="text1" name="text1"></textarea></a>
            <p class="short-line parag">๑. ให้จำเลยชำระเงิน………………………………………………………………………………</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <a class="absolute"><textarea style="margin-top:-17px;line-height:1.35;font-size: 21px;font-family: myFont;" rows="6" cols="80" class="transparent" id="text2" name="text2"></textarea></a>
            <p class="short-line parag">๒. ให้จำเลยชำระเงิน………………………………………………………………………………</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <a class="absolute"><textarea style="margin-top:-17px;line-height:1.35;font-size: 21px;font-family: myFont;" rows="5" cols="80" class="transparent" id="text3" name="text3"></textarea></a>
            <p class="short-line parag">๓. ให้จำเลยส่งมอบสิ่งของ…………………………………………………………………………</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <a class="absolute"><textarea style="margin-top:-17px;line-height:1.35;font-size: 21px;font-family: myFont;" rows="5" cols="80" class="transparent" id="text4" name="text4"></textarea></a>
            <p class="short-line parag">๔. อื่นๆ……………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line">………………………………………………………………………………………………………………..</p>
            <p class="short-line parag">ข้าพเจ้ายื่นมาพร้อมสำเนา โดยข้อความถูกต้องเป็นอย่างเดียวกันมาด้วย…<a class="absolute" style="margin-left:-55px;margin-top:-15px"><input class="transparent text-center" type="text" id="text5" name="text5" size="8"></a>………………ฉบับ</p>
            <p class="short-line">และรอฟังคำสั่งอยู่  หากไม่รอถือว่าทราบแล้ว</p>
            <p class="short-line right">…<a class="absolute" style="margin-top:-15px"><input class="transparent text-center" type="text" id="text6" name="text6" size="45"></a>…………………………………………………………………โจทก์</p>
            <p class="short-line right">…<a class="absolute" style="margin-top:-15px"><input class="transparent text-center" type="text" id="text7" name="text7" size="45"></a>……………………………………………………………….</p>
            <p class="right">
                ข้าพเจ้า…<a class="absolute" style="margin-top:-3px"><input class="transparent text-center" type="text" id="text8" name="text8" size="45"></a>………………………………………………………………….เจ้าพนักงานคดี/ผู้บันทึก<br>
                …<a class="absolute" style="margin-top:-3px"><input class="transparent text-center" type="text" id="text9" name="text9" size="30"></a>………………………………………………
            </p>
            <p class="right">
                ข้าพเจ้า…<a class="absolute" style="margin-top:-3px"><input class="transparent text-center" type="text" id="text10" name="text10" size="20"></a>……………………………….ทนายความ ใบอนุญาตที่…<a class="absolute" style="margin-top:-3px"><input class="transparent text-center" type="text" id="text11" name="text11" size="8"></a>………………ผู้เรียง/พิมพ์<br>
                …<a class="absolute" style="margin-top:-3px"><input class="transparent text-center" type="text" id="text12" name="text12" size="30"></a>………………………………………………
            </p>

        </div>    
    </div>
</div>

</body>

<script src="../../dist/js/jquery-3.3.1.js"></script>
<script src="../../dist/js/app.js"></script>
<script>

function print_report(){
    window.print();
}

// get_all_input_text();

<?php
if($objResult['doc_report_text'] == "" || $objResult['doc_report_text'] == NULL){
    //หา จำเลย
    $defendant = "";
    $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
    $objQuery_def = $conDB->sqlQuery($strSQL_def);
    while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
        if($defendant == ""){
            $defendant = $objResult_def['doc_def_name'];
        }else{
            $defendant = $defendant.','.$objResult_def['doc_def_name'];
        }
    }
    //end หาจำเลย
    //หาโจทย์
    $plaintiff = $objResult_notis['doc_plaintiff_name'];
    //end หาโจทย์

    $lawyer_id = $objResult_notis['lawyer_id'];
    $strSQL_law = "SELECT * FROM `lawyer` WHERE `lawyer_id` = '$lawyer_id'";
    $objQuery_law = $conDB->sqlQuery($strSQL_law);
    $objResult_law = mysqli_fetch_assoc($objQuery_law);

    ?>
        document.getElementById('text1').value = '<?php echo "                                             " ?>'; //ศาล
        document.getElementById('text2').value = '<?php echo "                                             " ?>'; //ศาล
        document.getElementById('text3').value = '<?php echo "                                                     " ?>'; //ศาล
        document.getElementById('text4').value = '<?php echo "                         " ?>'; //ศาล

        document.getElementById('text7').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ศาล
        document.getElementById('text10').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //จำเลย
        document.getElementById('text11').value = '<?php echo $objResult_law['submit_no'] ?>'; //โจทย์

    <?php
} else {
    ?>
    get_form_report(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>


</script>

</html>