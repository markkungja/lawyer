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

function thai_date($time){
    $thai_month_arr=array(
        "",
        "มกราคม",
        "กุมภาพันธ์",
        "มีนาคม",
        "เมษายน",
        "พฤษภาคม",
        "มิถุนายน", 
        "กรกฎาคม",
        "สิงหาคม",
        "กันยายน",
        "ตุลาคม",
        "พฤศจิกายน",
        "ธันวาคม"                 
    );
    $pieces = explode("-", $time);
    $thai_date = $pieces[2];
    $thai_date .= "-".$thai_month_arr[2];
    $thai_date .= "-".($pieces[0]+543);
    return $thai_date;
}

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

<div class="book" id="div_id">
<input type="hidden" id="doc_report_id" name="doc_report_id" value="<?php echo $doc_report_id ?>">
    <div class="page">
        <div class="subpage">
            <!-- <div class="form"> -->
                <table style="width:100%;border: 0px solid black" align="left">
                    <tr>
                        <td class="left-top" align="left" style="width:40%">
                            <br><img src="../assets/circle.png">&nbsp;&nbsp;(๗)<br>คำร้องกำหนดวันนัดพิจารณาเกินกว่า 30 วัน
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
                            ความ_<a class="absolute"><input class="transparent text-center" type="text" id="text10" name="text10" size="26"></a>_______________________________<br><br>
                        </td>
                    </tr>
                </table>
                <div></div>
                <p><img src="../assets/plan_def.png">
                <a class="absolute"><textarea style="margin-left:-550px;margin-top:1px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="68" class="transparent" id="text11" name="text11"></textarea></a>
                <a class="absolute"><textarea style="margin-left:-550px;margin-top:100px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="68" class="transparent" id="text12" name="text12"></textarea></a>
                <p style="text-indent: 2.5em;">ข้าพเจ้า_<a class="absolute" style="margin-left:-55px"><input class="transparent text-center" type="text" id="text18" name="text18" size="66"></a>_____________________________________________________________________<br>
                เลขประจำตัวประชาชน <a class="absolute" style="margin-left:-55px;margin-top:-2px"><input class="transparent" type="text" id="text19" name="text19" size="29"></a>---- <br>
                เชื้อชาติ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text20" name="text20" size="13"></a>_________________สัญชาติ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text21" name="text21" size="13"></a>_________________อาชีพ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text22" name="text22" size="23"></a>___________________________<br>
                เกิดวันที่<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text23" name="text23" size="1"></a>____เดือน_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text24" name="text24" size="13"></a>_________________พ.ศ. _<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text25" name="text25" size="5"></a>_________อายุ_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text26" name="text26" size="1"></a>____ปี อยู่บ้านเลขที่_<a class="absolute" style="margin-left:-55px;"><input class="transparent" type="text" id="text27" name="text27" size="9"></a>_____________<br>
                หมู่ที่ _<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text28" name="text28" size="5"></a>_________ถนน_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text28_2" name="text28_2" size="23"></a>___________________________ตรอก/ซอย_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text29" name="text29" size="22"></a>__________________________<br>
                ตำบล/แขวง_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text30" name="text30" size="17"></a>_____________________อำเภอ/เขต_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text31" name="text31" size="14"></a>__________________จังหวัด_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text32" name="text32" size="12"></a>_______________<br>
                รหัสไปรษณีย์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text33" name="text33" size="12"></a>________________โทรศัพท์_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text34" name="text34" size="17"></a>_____________________โทรสาร_<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text35" name="text35" size="14"></a>__________________<br>
                ไปรษณีย์อิเล็กทรอนิกส์ _<a class="absolute" style="margin-left:-55px;"><input class="transparent text-center" type="text" id="text36" name="text36" size="56"></a>_____________________________________________________________<br>
                ขอยื่นคำร้อง / คำแถลง / คำขอ มีข้อความตามที่จะกล่าวต่อไปนี้<br>
                </p>
                <p style="text-indent: 2.5em;">
                <a class="absolute"><textarea style="margin-top:-2px;margin-left:-110px;;line-height:1.3;font-size: 22px;font-family: myFont;" rows="4" cols="80" class="transparent" id="textarea1" name="textarea1"></textarea></a>
                ข้อ ๑. _______________________________________________________________________<br>
                ____________________________________________________________________________________<br>
                ____________________________________________________________________________________<br>
                ____________________________________________________________________________________
                
                <p class="line" style="margin-top:-15px;width:90%"></p>
                <p><u>หมายเหตุ </u> ข้าพเจ้ารอฟังคำสั่งอยู่ ถ้าไม่รอให้ถือว่าทราบแล้ว</p>
                <p class="right">__________________________________________ผู้ร้อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>


            <!-- </div> -->
        </div>    
    </div>
    
    <?php
        for($i=2;$i<32;$i++){
            $mod = $i % 2;
    ?>

        <div class="page">
            <div class="subpage">
            <header>
                <table style="width:100%;border: 0px solid black">
                    <tr style="color:#85929E ">
                        <td style="width:33%" align="left"><?php if($mod == 1){echo "(๔๐ ก.)";} ?></td>
                        <td style="width:33%"><center>- <?php echo $i ?> -</center></td>
                        <td style="width:33%"></td>
                    </tr>
                </table>
            </header>
                <p>_<a class="absolute"><textarea style="margin-top:-16px;margin-left:-5px;line-height:2.3;font-size: 22px;font-family: myFont;" rows="18" cols="84" class="transparent" id="textarea<?php echo $i ?>" name="textarea<?php echo $i ?>"></textarea></a>_______________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
                <p>________________________________________________________________________________________</p>
            </div>
        </div>
    <?php
        }
    ?>

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
    $tex_number_edit = "  ".$tex_nember[0]."   ".$tex_nember[1]."  ".$tex_nember[2]."  ".$tex_nember[3]."  ".$tex_nember[4]."   ".$tex_nember[5]."  ".$tex_nember[6]."   ".$tex_nember[7]."  ".$tex_nember[8]."  ".$tex_nember[9]."   ".$tex_nember[10]."  ".$tex_nember[11]."   ".$tex_nember[12];

    // $birthday = thai_date($objResult_law['birthday']);
    $birthday = thai_date($objResult_law['birthday']);
    $arr_birthday = explode("-", $birthday);
    ?>
        document.getElementById('text5').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล
        document.getElementById('text11').value = '<?php echo $plaintiff ?>'; //จำเลย
        document.getElementById('text12').value = '<?php echo $defendant ?>'; //โจทย์
        
        document.getElementById('text18').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ข้าพเจ้า
        document.getElementById('text19').value = '<?php echo $tex_number_edit ?>'; //เลขบัตร
        document.getElementById('text20').value = '<?php echo $objResult_notis['race'] ?>'; //เชื้อชาติ
        document.getElementById('text21').value = '<?php echo $objResult_notis['nationality'] ?>'; //สัญชาติ
        document.getElementById('text22').value = '<?php echo $objResult_notis['job'] ?>'; //อาชีพ

        document.getElementById('text23').value = '<?php echo $arr_birthday[0] ?>'; //เกิดวัน
        document.getElementById('text24').value = '<?php echo $arr_birthday[1] ?>'; //เดือน
        document.getElementById('text25').value = '<?php echo $arr_birthday[2] ?>'; //ปี

        document.getElementById('text26').value = '<?php echo $objResult_notis['age'] ?>'; //อายุ

        document.getElementById('text27').value = '<?php echo $objResult_law['current_unit'] ?>'; //ที่อยู่
        document.getElementById('text28').value = '<?php echo $objResult_law['current_bloc'] ?>'; //หมู่
        document.getElementById('text28_2').value = '<?php echo $objResult_law['current_road'] ?>'; //ถนน
        document.getElementById('text29').value = '<?php echo $objResult_law['current_alley'] ?>'; //ซอย
        document.getElementById('text30').value = '<?php echo $objResult_law['current_zone'] ?>'; //แขวง
        document.getElementById('text31').value = '<?php echo $objResult_law['current_area'] ?>'; //เขต
        document.getElementById('text32').value = '<?php echo $objResult_law['current_county'] ?>'; //จังหวัด
        document.getElementById('text33').value = '<?php echo $objResult_law['current_post'] ?>'; //รหัสไป
        document.getElementById('text34').value = '<?php echo $objResult_law['current_phone'] ?>'; //โทรศัพท์
        document.getElementById('text35').value = '<?php echo $objResult_law['current_number'] ?>'; //โทรสาร
        document.getElementById('text36').value = '<?php echo $objResult_law['current_email'] ?>'; //email

        document.getElementById('textarea1').value = '<?php echo "                       " ?>'; //email

    <?php
} else {
    ?>
    get_form_report(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>


</script>

</html>