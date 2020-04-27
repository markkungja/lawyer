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
        .parag{
            text-indent: 2.5em;
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

<div class="book" class="book" id="div_id">
<input type="hidden" id="doc_report_id" name="doc_report_id" value="<?php echo $doc_report_id ?>">
    <div class="page">
        <div class="subpage">
            <!-- <div class="form"> -->
                <table style="width:100%;border: 0px solid black" align="left">
                    <tr>
                        <td class="left-top" align="left" style="width:40%">
                            <br>(แบบ ผบ. ๑)<br>คำฟ้องคดีผู้บริโภค
                        </td>
                        <td style="width:20%" align="top"><img src="../assets/logo.png"></td>
                        <td style="width:40%" align="right">
                            <br><br>
                            <div>คดีหมายเลขดำที่...<a class="absolute"><input class="transparent text-center" type="text" id="text1" name="text1" size="4"></a>…………/๒๕<a class="absolute"><input class="transparent" type="text" id="text2" name="text2" size="1"></a>……</div>
                            คดีหมายเลขแดงที่...<a class="absolute"><input class="transparent text-center" type="text" id="text3" name="text3" size="4"></a>…………/๒๕<a class="absolute"><input class="transparent" type="text" id="text4" name="text4" size="1"></a>……
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">
                            ศาล...<a class="absolute"><input class="transparent text-center" type="text" id="text5" name="text5" size="28"></a>…………………………………………&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            วันที่<a class="absolute"><input class="transparent text-center" type="text" id="text6" name="text6" size="1"></a>.........เดือน<a class="absolute"><input class="transparent text-center" type="text" id="text7" name="text7" size="8"></a>………………พุทธศัราช ๒๕<a class="absolute"><input class="transparent" type="text" id="text8" name="text8" size="1"></a>.........&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                            ความแพ่ง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                        </td>
                    </tr>
                </table>
                <div></div>
                <p><img src="../assets/plan_def_dot.png">
                <a class="absolute"><textarea style="margin-left:-500px;margin-top:1px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="62" class="transparent" id="text9" name="text9"></textarea></a>
                <a class="absolute"><textarea style="margin-left:-500px;margin-top:85px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="62" class="transparent" id="text10" name="text10"></textarea></a>
                <p>
                    เรื่อง…<a class="absolute"><input class="transparent text-center" type="text" id="text11" name="text11" size="75"></a>…………………………………………………………………………………………………………<br>
                    จำนวนทุนทรัพย์<a class="absolute"><input class="transparent text-center" type="text" id="text12" name="text12" size="34"></a>…………………………………………………บาท<a class="absolute"><input class="transparent text-center" type="text" id="text13" name="text13" size="19"></a>……………………………..สตางค์<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            ข้าพเจ้า…<a class="absolute"><input class="transparent text-center" type="text" id="text14" name="text14" size="53"></a>……………………………………………………………………………โจทก์<br>
                    เชื้อชาติ<a class="absolute"><input class="transparent text-center" type="text" id="text15" name="text15" size="12"></a>…………………...สัญชาติ<a class="absolute"><input class="transparent text-center" type="text" id="text16" name="text16" size="10"></a>…………………อาชีพ<a class="absolute"><input class="transparent text-center" type="text" id="text17" name="text17" size="19"></a>……………………………..อายุ<a class="absolute"><input class="transparent text-center" type="text" id="text18" name="text18" size="5"></a>…………..ปี<br>
                    เลขประจำตัวประชาชน <a class="absolute" style="margin-top:-2px"><input class="transparent" type="text" id="text19" name="text19" size="29"></a>      
                    อยู่บ้านเลขที่<a class="absolute" style="margin-top:-2px"><input class="transparent text-center" type="text" id="text19_2" name="text19_2" size="17"></a>…………………………<br>
                    หมู่ที่<a class="absolute"><input class="transparent text-center" type="text" id="text20" name="text20" size="5"></a>………… ถนน<a class="absolute"><input class="transparent text-center" type="text" id="text21" name="text21" size="12"></a>…………………….ตรอก/ซอย<a class="absolute"><input class="transparent text-center" type="text" id="text22" name="text22" size="13"></a>……………………..ใกล้เคียง<a class="absolute"><input class="transparent text-center" type="text" id="text23" name="text23" size="14"></a>………………………<br>
                    ตำบล/แขวง<a class="absolute"><input class="transparent text-center" type="text" id="text24" name="text24" size="15"></a>……………………….. 
                    อำเภอ/เขต<a class="absolute"><input class="transparent text-center" type="text" id="text25" name="text25" size="13"></a>……………………. 
                    จังหวัด<a class="absolute"><input class="transparent text-center" type="text" id="text26" name="text26" size="18"></a>…………………………….<br>
                    โทรศัพท์<a class="absolute"><input class="transparent text-center" type="text" id="text27" name="text27" size="8"></a>………………
                    โทรสาร<a class="absolute"><input class="transparent text-center" type="text" id="text28" name="text28" size="8"></a>………………
                    จดหมายอิเล็กทรอนิกส์<a class="absolute"><input class="transparent text-center" type="text" id="text29" name="text29" size="24"></a>……………………………………<br>
                    สถานที่ติดต่อ<a class="absolute"><input class="transparent text-center" type="text" id="text30" name="text30" size="70"></a>………………………………………………………………………………………………….<br>
                    โทรศัพท์<a class="absolute"><input class="transparent text-center" type="text" id="text31" name="text31" size="10"></a>…………………
                    โทรสาร<a class="absolute"><input class="transparent text-center" type="text" id="text32" name="text32" size="8"></a>………………
                    จดหมายอิเล็กทรอนิกส์<a class="absolute"><input class="transparent text-center" type="text" id="text33" name="text33" size="24"></a>……………………………………<br>
                    <a class="absolute"><textarea style="margin-top:-4px;line-height:1.3;font-size: 22px;font-family: myFont;" rows="2" cols="81" class="transparent" id="text34" name="text34"></textarea></a>
                    ขอยื่นฟ้อง………………………………………………………………………………………….…………<br>
                    ………………………………………………………………..........................................................จำเลย<br>
                    เชื้อชาติ<a class="absolute"><input class="transparent text-center" type="text" id="text35" name="text35" size="15"></a>…………………….….
                    สัญชาติ<a class="absolute"><input class="transparent text-center" type="text" id="text36" name="text36" size="17"></a>……………………………
                    อาชีพ<a class="absolute"><input class="transparent text-center" type="text" id="text37" name="text37" size="24"></a>……………………………..……<br>
                    อยู่บ้านเลขที่<a class="absolute"><input class="transparent text-center" type="text" id="text38" name="text38" size="22"></a>………….…………….…….…
                    หมู่<a class="absolute"><input class="transparent text-center" type="text" id="text39" name="text39" size="21"></a>……………………………...…
                    ซอย<a class="absolute"><input class="transparent text-center" type="text" id="text40" name="text40" size="14"></a>………………………<br>
                    ตำบล/แขวง<a class="absolute"><input class="transparent text-center" type="text" id="text41" name="text41" size="34"></a>……….…….…….…………….………………
                    อำเภอ<a class="absolute"><input class="transparent text-center" type="text" id="text42" name="text42" size="28"></a>……….…….…….……………………<br>
                    จังหวัด<a class="absolute"><input class="transparent text-center" type="text" id="text43" name="text43" size="26"></a>………………………………………
                    โทรศัพท์<a class="absolute"><input class="transparent text-center" type="text" id="text44" name="text44" size="13"></a>……………………
                    โทรสาร<a class="absolute"><input class="transparent text-center" type="text" id="text45" name="text45" size="16"></a>…………………………<br>
                    จดหมายอิเล็กทรอนิกส์<a class="absolute"><input class="transparent text-center" type="text" id="text46" name="text46" size="29"></a>……………………………………………มีข้อความตามที่จะกล่าวต่อไปนี้
                </p>


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
                        <td style="width:33%" align="left"></td>
                        <td style="width:33%"></td>
                        <td style="width:33%" align="right"><?php echo $i ?></td>
                    </tr>
                </table>
            </header>
            <?php
                if($i==2){
                    ?> <p><a class="absolute"><textarea style="margin-top:-16px;margin-left:-5px;line-height:2.3;font-size: 22px;font-family: myFont;" rows="18" cols="84" class="transparent" id="textarea<?php echo $i ?>" name="textarea<?php echo $i ?>"></textarea></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อ ๑. ……………………………………………………………………………………………………</p> <?php
                }else{
                    ?> <p><a class="absolute"><textarea style="margin-top:-16px;margin-left:-5px;line-height:2.3;font-size: 22px;font-family: myFont;" rows="18" cols="84" class="transparent" id="textarea<?php echo $i ?>" name="textarea<?php echo $i ?>"></textarea></a>…………………..…………………………………………………………………………………………………</p> <?php
                }
            ?>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
                <p>…………………..…………………………………………………………………………………………………</p>
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

    $plaintiff_id = $objResult_notis['doc_plaintiff_id'];
    $strSQL_plain = "SELECT * FROM `plaintiff` WHERE `plaintiff_id` = '$plaintiff_id'";
    $objQuery_plain = $conDB->sqlQuery($strSQL_plain);
    $objResult_plain = mysqli_fetch_assoc($objQuery_plain);

    //จัดข้อความเลขบัตรประชาชน
    $tex_nember = str_replace("-", "", $objResult_plain['plaintiff_tex_no']);
    if(strlen($tex_nember) == 13){
        $tex_number_edit = " ".$tex_nember[0]."   ".$tex_nember[1]."  ".$tex_nember[2]."  ".$tex_nember[3]."  ".$tex_nember[4]."   ".$tex_nember[5]."  ".$tex_nember[6]."   ".$tex_nember[7]."  ".$tex_nember[8]."  ".$tex_nember[9]."   ".$tex_nember[10]."  ".$tex_nember[11]."   ".$tex_nember[12];
    } else {
        $tex_number_edit = "";
    }
    ?>
        document.getElementById('text5').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล
        document.getElementById('text9').value = '<?php echo $plaintiff ?>'; //โจทย์
        document.getElementById('text10').value = '<?php echo $defendant ?>'; //จำเลย

        document.getElementById('text14').value = '<?php echo $plaintiff ?>'; //ข้าพเจ้า
        document.getElementById('text15').value = '<?php echo $objResult_plain['race'] ?>'; //เชื้อชาติ
        document.getElementById('text16').value = '<?php echo $objResult_plain['nationality'] ?>'; //สัญชาติ
        document.getElementById('text17').value = '<?php echo $objResult_plain['job'] ?>'; //อาชีพ
        document.getElementById('text18').value = '<?php echo $objResult_plain['age'] ?>'; //อายุ
        document.getElementById('text19').value = '<?php echo $tex_number_edit ?>'; //เลขบัตรประชาชน
        document.getElementById('text19_2').value = '<?php echo $objResult_plain['current_unit'] ?>'; //ที่อยู่
        document.getElementById('text20').value = '<?php echo $objResult_plain['current_bloc'] ?>'; //หมู่
        document.getElementById('text21').value = '<?php echo $objResult_plain['current_road'] ?>'; //ถนน
        document.getElementById('text22').value = '<?php echo $objResult_plain['current_alley'] ?>'; //ซอย
        document.getElementById('text24').value = '<?php echo $objResult_plain['current_zone'] ?>'; //แขวง
        document.getElementById('text25').value = '<?php echo $objResult_plain['current_area'] ?>'; //เขต
        document.getElementById('text26').value = '<?php echo $objResult_plain['current_county'] ?>'; //จังหวัด
        document.getElementById('text27').value = '<?php echo $objResult_plain['current_phone'] ?>'; //โทรศัพท์
        document.getElementById('text28').value = '<?php echo $objResult_plain['current_number'] ?>'; //โทรสาร
        document.getElementById('text29').value = '<?php echo $objResult_plain['current_email'] ?>'; //email

        document.getElementById('text34').value = '<?php echo "               ".$defendant ?>'; //ขอยื่นฟ้อง

        document.getElementById('textarea2').value = '<?php echo "                        " ?>'; //ขอยื่นฟ้อง

    <?php
} else {
    ?>
    get_form_report(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>

</script>

</html>