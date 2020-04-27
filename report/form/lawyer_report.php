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
            min-height: 297mm;
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
        .subpage {
            padding: 0.5cm;
            /* border: 5px red solid; */
            height: 277mm;
            /* outline: 1cm #FFEAEA solid; */
        }
        .form{
            position: absolute;
            /* top: 0;
            left: 0;
            bottom: 0;
            right: 0; */
            z-index: -1;
            /* overflow: hidden; */
        }

        .left-top{
            vertical-align: top;
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .normal-line{
            line-height: 0.6cm;
        }
        .short-line{
            line-height: 0.3cm;
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
        }

        /* Text Box End */
        
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;        
            }
            .navbar{
                display: none;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .transparent{
                border: 0;
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

<div class="book" id="div_id">
    <input type="hidden" id="doc_report_id" name="doc_report_id" value="<?php echo $doc_report_id ?>">
    <div class="page">
        <div class="subpage">
            <!-- <div class="form"> -->
                <table style="width:100%;border: 0px solid black" align="left">
                    <tr>
                        <td class="left-top" align="left" style="width:40%">
                            <br><img src="../assets/circle.png">&nbsp;&nbsp;(๙)<br>ใบแต่งทนายความ
                        </td>
                        <td style="width:20%" align="top"><img src="../assets/logo.png"></td>
                        <td style="width:40%" align="right">
                            <br><br>
                            <div>คดีหมายเลขดำที่_<a class="absolute"><input class="transparent text-center" type="text" id="text1" name="text1" size="4"></a>_________/๒๕<a class="absolute"><input class="transparent" type="text" id="text2" name="text2" size="1"></a>___</div>
                            คดีหมายเลขแดงที่_<a class="absolute"><input class="transparent text-center" type="text" id="text3" name="text3" size="4"></a>_________/๒๕<a class="absolute"><input class="transparent" type="text" id="text4" name="text4" size="1"></a>___
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">
                            ศาล_<a class="absolute"><input class="transparent text-center" type="text" id="text5" name="text5" size="28"></a>________________________________<br>
                            วันที่<a class="absolute"><input class="transparent text-center" type="text" id="text6" name="text6" size="1"></a>_____เดือน<a class="absolute"><input class="transparent text-center" type="text" id="text8" name="text8" size="8"></a>_____________พุทธศัราช ๒๕<a class="absolute"><input class="transparent" type="text" id="text9" name="text9" size="1"></a>___<br>
                            ความ_<a class="absolute"><input class="transparent text-center" type="text" id="text10" name="text10" size="26"></a>_______________________________<br>
                        </td>
                    </tr>
                </table>
                
                <p><img src="../assets/plan_def.png">
                <a class="absolute"><textarea style="margin-left:-550px;margin-top:1px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="68" class="transparent" id="text11" name="text11"></textarea></a>
                <a class="absolute"><textarea style="margin-left:-550px;margin-top:100px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="68" class="transparent" id="text12" name="text12"></textarea></a>
                <div class="normal-line">
                    <p style="text-indent: 2.5em;">ข้าพเจ้า_<a class="absolute" style="margin-left:-55px;margin-top:-5px"><input class="transparent text-center" type="text" id="text13" name="text13" size="68"></a>______________________________________________________________________</p>
                    <p>ขอแต่งตั้งให้_<a class="absolute"><input class="transparent text-center" style="margin-top:-7px" type="text" id="text14" name="text14" size="68"></a>__________________________________________________________________________</p>
                    <p><a class="absolute"><textarea style="margin-top:-13px;line-height:2;font-size: 21px;font-family: myFont;" rows="3" cols="85" class="transparent" id="text15" name="text15"></textarea></a>เป็นทนายความของข้าพเจ้าในคดีนี้ และให้มีอำนาจ *__________________________________________</p>
                    <p>_____________________________________________________________________________________</p>
                    <p>_____________________________________________________________________________________</p>
                    <p>ข้าพเจ้ายอมรับผิดชอบตามที่_<a class="absolute"><input class="transparent text-center" style="margin-top:-7px" type="text" id="text16" name="text16" size="56"></a>____________________________________________________________</p>
                    <p>ทนายความจะได้ดำเนินกระบวนพิจารณาต่อไปตามกฎหมาย</p>
                    <p>ขอรับรองว่าผู้แต่งทนายความได้ลงลายมือชื่อจริง_______________________________ผู้แต่งทนายความ</p>
                    <p style="text-indent: 15em;">(_<a class="absolute" style="margin-left:-318px;margin-top:-6px"><input class="transparent text-center" type="text" id="text17" name="text17" size="13"></a>_________________)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(พลิก)
                </div>
                ลงชื่อ________________________________________________________________________________<br>
                <u>หมายเหตุ</u> *ตามประมวลกฎหมายวิธีพิจารณาความแพ่งมาตรา ๖๒ ทนายความไม่มีอำนาจดำเนินกระบวน  
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พิจารณาใดไปในทางจำหน่ายสิทธิของคู่ความนั้น  เช่น การยอมรับตามที่คู่ความอีกฝ่ายหนึ่งเรียก
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้อง การถอนฟ้อง การประนีประนอมยอมความ การสละสิทธิหรือการใช้สิทธิในการอุทธรณ์หรือ
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ฎีกาหรือในการขอให้พิจารณาคดีใหม่ ถ้าจะมอบให้มีอำนาจดังกล่าวประการใดบ้าง ให้กรอกลง
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในช่องที่ว่าง ไว้ โดยระบุให้ชัดเจน (คำที่ไม่ใช้และช่องว่างที่เหลือให้ขีดเสีย)
                </p>
            <!-- </div> -->
        </div>    
    </div>
    <div class="page">
        <div class="subpage">
            <br><br><br>
            <p><center><u>คำรับเป็นทนายความ</u></center></p>
            <p style="text-indent: 2.5em;">ข้าพเจ้า_<a class="absolute" style="margin-left:-55px"><input class="transparent text-center" type="text" id="text18" name="text18" size="66"></a>_____________________________________________________________________<br>
            เลขประจำตัวประชาชน <a class="absolute" style="margin-left:-55px;margin-top:-2px"><input class="transparent" type="text" id="text19" name="text19" size="29"></a>---- <br>
            ใบอนุญาตให้เป็นทนายความเลขที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text20" name="text20" size="14"></a>___________________ได้รับอนุญาตให้ว่าความ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text21" name="text21" size="11"></a>______________<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                ที่อยู่ปัจจุบันเลขที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text22" name="text22" size="12"></a>_________________หมู่ที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text23" name="text23" size="4"></a>_________ถนน_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text24" name="text24" size="22"></a>__________________________<br>
            ตรอก/ซอย_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text25" name="text25" size="14"></a>__________________ตำบล/แขวง_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text26" name="text26" size="11"></a>________________อำเภอ/เขต_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text27" name="text27" size="14"></a>___________________<br>
            จังหวัด_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text28" name="text28" size="14"></a>___________________รหัสไปรษณีย์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text29" name="text29" size="11"></a>________________โทรศัพท์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text30" name="text30" size="14"></a>_____________________<br>
            โทรสาร_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text31" name="text31" size="14"></a>__________________ไปรษณีย์อิเล็กทรอนิกส์ _<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text32" name="text32" size="32"></a>_____________________________________<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                สำนักงานอยู่ที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text33" name="text33" size="11"></a>________________หมู่ที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text34" name="text34" size="4"></a>_________ถนน_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text35" name="text35" size="24"></a>_____________________________<br>
            ตรอก/ซอย_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text36" name="text36" size="14"></a>__________________ตำบล/แขวง_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text37" name="text37" size="11"></a>________________อำเภอ/เขต_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text38" name="text38" size="14"></a>___________________<br>
            จังหวัด_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text39" name="text39" size="14"></a>___________________รหัสไปรษณีย์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text40" name="text40" size="11"></a>________________โทรศัพท์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text41" name="text41" size="16"></a>_____________________<br>
            โทรสาร_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text42" name="text42" size="14"></a>__________________ไปรษณีย์อิเล็กทรอนิกส์ _<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text43" name="text43" size="32"></a>_____________________________________<br>
            ขอรับเป็นทนายของ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text44" name="text44" size="62"></a>__________________________________________________________________<br>
            เพื่อดำเนินกระบวนพิจารณาต่อไปตามหน้าที่ในกฎหมาย<br>
                <p class="right">_____________________________________ทนายความ<br>
                    (_<a class="absolute"><input class="transparent text-center" type="text" id="text45" name="text45" size="20"></a>_________________________)
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </p>
            <p><center><u>คำสั่ง</u></center></p>
            <p><a class="absolute"><textarea style="margin-top:-10px;line-height:2;font-size: 22px;font-family: myFont;" rows="2" cols="85" class="transparent" id="text46" name="text46"></textarea></a>_______________________________________________________________________________________</p>
            <p>_______________________________________________________________________________________</p>
            <p class="right">_<a class="absolute"><input class="transparent text-center" type="text" id="text47" name="text47" size="19"></a>________________________ผู้พิพากษา</p>
            
            
        </div>    
    </div>
    <?php
        $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
        $objQuery_def = $conDB->sqlQuery($strSQL_def);
        $num_def = $conDB->sqlNumrows($strSQL_def);
        if($num_def >= 4){
    ?>
            <?php include './plugin/attr_def_last.php';?>
    <?php
        }
    ?>
</div>

</body>
<script src="../../dist/js/jquery-3.3.1.js"></script>
<script src="../../dist/js/app.js"></script>
<script>

function print_report(){
    window.print();
}

//get_all_input_text();

<?php
if($objResult['doc_report_text'] == "" || $objResult['doc_report_text'] == NULL){
    //หา จำเลย
    $defendant = "";
    $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
    $objQuery_def = $conDB->sqlQuery($strSQL_def);
    $num_def = $conDB->sqlNumrows($strSQL_def);
    
    if($num_def >= 4){
        $objResult_def = mysqli_fetch_assoc($objQuery_def);
        $defendant = $objResult_def['doc_def_name'].' ที่1 กับพวกรวม '.$num_def.' คน';
        $create_attr = true;
        //thicket attr
    }else{
        while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
            if($defendant == ""){
                $defendant = $objResult_def['doc_def_name'];
            }else{
                $defendant = $defendant.','.$objResult_def['doc_def_name'];
            }
        }
        $create_attr = false;
    }
    //end หาจำเลย
    //หาโจทย์
    $plaintiff = $objResult_notis['doc_plaintiff_name'];
    //end หาโจทย์

    $lawyer_id = $objResult_notis['lawyer_id'];
    $strSQL_law = "SELECT * FROM `lawyer` WHERE `lawyer_id` = '$lawyer_id'";
    $objQuery_law = $conDB->sqlQuery($strSQL_law);
    $objResult_law = mysqli_fetch_assoc($objQuery_law);

    //จัดข้อความเลขบัตรประชาชน
    $tex_nember = str_replace("-", "", $objResult_law['lawyer_tex_no']);
    if(strlen($tex_nember) == 13){
        $tex_number_edit = "  ".$tex_nember[0]."   ".$tex_nember[1]."  ".$tex_nember[2]."  ".$tex_nember[3]."  ".$tex_nember[4]."   ".$tex_nember[5]."  ".$tex_nember[6]."   ".$tex_nember[7]."  ".$tex_nember[8]."  ".$tex_nember[9]."   ".$tex_nember[10]."  ".$tex_nember[11]."   ".$tex_nember[12];
    } else {
        $tex_number_edit = "";
    }
    ?>
        document.getElementById('text5').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล
        document.getElementById('text11').value = '<?php echo $plaintiff ?>'; //โจทก์
        document.getElementById('text12').value = '<?php echo $defendant ?>'; //จำเลย
        document.getElementById('text13').value = '<?php echo $plaintiff ?>'; //ข้าพเจ้า
        document.getElementById('text14').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ขอแต่งตั้งให้
        document.getElementById('text15').value = '<?php echo "                                                                              " ?>'; //ขอแต่งตั้งให้
        document.getElementById('text16').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ข้าพเจ้ายอมรับผิดชอบ
        document.getElementById('text17').value = '<?php echo $plaintiff ?>'; //ลายเซ็น

        //ใบที่ 2

        document.getElementById('text18').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ข้าพเจ้า

        document.getElementById('text19').value = '<?php echo $tex_number_edit ?>'; //เลขบัตรประชาชน

        document.getElementById('text20').value = '<?php echo $objResult_law['submit_no'] ?>'; //เลขใบ
        document.getElementById('text21').value = '<?php echo $objResult_law['submit_info'] ?>'; //ได้รับ

        document.getElementById('text22').value = '<?php echo $objResult_law['current_unit'] ?>'; //ที่อยู่
        document.getElementById('text23').value = '<?php echo $objResult_law['current_bloc'] ?>'; //หมู่
        document.getElementById('text24').value = '<?php echo $objResult_law['current_road'] ?>'; //ถนน
        document.getElementById('text25').value = '<?php echo $objResult_law['current_alley'] ?>'; //ซอย
        document.getElementById('text26').value = '<?php echo $objResult_law['current_zone'] ?>'; //แขวง
        document.getElementById('text27').value = '<?php echo $objResult_law['current_area'] ?>'; //เขต
        document.getElementById('text28').value = '<?php echo $objResult_law['current_county'] ?>'; //จังหวัด
        document.getElementById('text29').value = '<?php echo $objResult_law['current_post'] ?>'; //รหัสไป
        document.getElementById('text30').value = '<?php echo $objResult_law['current_phone'] ?>'; //โทรศัพท์
        document.getElementById('text31').value = '<?php echo $objResult_law['current_number'] ?>'; //โทรสาร
        document.getElementById('text32').value = '<?php echo $objResult_law['current_email'] ?>'; //email

        document.getElementById('text33').value = '<?php echo $objResult_law['work_unit'] ?>'; //ที่อยู่
        document.getElementById('text34').value = '<?php echo $objResult_law['work_bloc'] ?>'; //หมู่
        document.getElementById('text35').value = '<?php echo $objResult_law['work_road'] ?>'; //ถนน
        document.getElementById('text36').value = '<?php echo $objResult_law['work_alley'] ?>'; //ซอย
        document.getElementById('text37').value = '<?php echo $objResult_law['work_zone'] ?>'; //แขวง
        document.getElementById('text38').value = '<?php echo $objResult_law['work_area'] ?>'; //เขต
        document.getElementById('text39').value = '<?php echo $objResult_law['work_county'] ?>'; //จังหวัด
        document.getElementById('text40').value = '<?php echo $objResult_law['work_post'] ?>'; //รหัสไป
        document.getElementById('text41').value = '<?php echo $objResult_law['work_phone'] ?>'; //โทรศัพท์
        document.getElementById('text42').value = '<?php echo $objResult_law['work_number'] ?>'; //โทรสาร
        document.getElementById('text43').value = '<?php echo $objResult_law['work_email'] ?>'; //email

        document.getElementById('text44').value = '<?php echo $plaintiff ?>'; //รับเป็นทนาย
        document.getElementById('text45').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //รับเป็นทนายลายเซ็น


    // document.getElementById(text_id_html);
    // alert('<?php echo $defendant ?>'); 

    <?php
} else {
    ?>
    get_form_report(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>

</script>

</html>