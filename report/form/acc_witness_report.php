<?php
session_start();
ob_start();
include("../../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$doc_report_id = $conDB->sqlEscapestr($_GET['doc_report_id']);

$_SESSION['PAGE'] = "../pages/report_edit.php?doc_id=".$doc_id."&doc_report_id=".$doc_report_id;

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
                            <br><img src="../assets/circle.png">&nbsp;&nbsp;(๑๕)<br>บัญชีพยาน
                        </td>
                        <td style="width:20%" align="top"><img src="../assets/logo.png"></td>
                        <td style="width:40%" align="right">
                            <u>สำหรับศาลใช้</u>
                            <br>
                            <br>
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
                <p style="text-indent: 2.5em;">ข้าพเจ้า_<a class="absolute" style="margin-left:-55px"><input class="transparent text-center" type="text" id="text18" name="text18" size="72"></a>_____________________________________________________________________________<br>
                ขอระบุพยานของข้าพเจ้ารวม<a class="absolute" style="margin-left:-55px"><input class="transparent text-center" type="text" id="text19" name="text19" size="10"></a>_____________อันดับ ตามบัญชีตารางข้างล่างนี้
                </p>
                <p style="text-indent: 2.5em;">
                <!-- <a class="absolute"><textarea style="margin-top:-2px;margin-left:-110px;;line-height:1.3;font-size: 22px;font-family: myFont;" rows="4" cols="80" class="transparent" id="textarea1" name="textarea1"></textarea></a> -->
                <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                    <tr style="border: 1px solid black;">
                        <td align="center" style="border: 1px solid black;width:3%">
                            อันดับ
                        </td>
                        <td style="border: 1px solid black;width:30%" align="center">
                            ชื่อและสกุลพยาน
                        </td>
                        <td style="border: 1px solid black;width:40%" align="center">
                            บ้านเลขที่ หมู่ที่ ถนน ซอย<br> ตำบล/แขวง อำเภอ/เขต จังหวัด
                        </td>
                        <td style="border: 1px solid black;width:10%" align="center">
                            หมายเหตุ
                        </td>
                    </tr>
                    <a class="absolute"><textarea style="margin-top:55px;margin-left:0px;line-height:1.415;font-size: 22px;font-family: myFont;" rows="10" cols="88" class="transparent" id="textarea1" name="textarea1"></textarea></a>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                </table>
                <p class="right">____________________________________________ผู้ระบุ<br>(พลิก)</p>
                <p class="line" style="margin-top:-15px;width:100%"></p>
                <p><u>หมายเหตุ</u> กรณีเด็กอายุไม่เกิน ๑๘ ปี ให้ระบุด้วย เพื่อประสานงานในการสืบพยานเด็ก</p>

            <!-- </div> -->
        </div>    
    </div>
    <div class="page">
        <div class="subpage">
            <header>
                <table style="width:100%;border: 0px solid black">
                    <tr style="color:#85929E ">
                        <td style="width:33%" align="left"></td>
                        <td style="width:33%"></td>
                        <td style="width:33%" class="right"><?php echo '2' ?></td>
                    </tr>
                </table>
            </header>
            <!-- <div class="form"> -->
                <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                    <tr style="border: 1px solid black;">
                        <td align="center" style="border: 1px solid black;width:3%">
                            อันดับ
                        </td>
                        <td style="border: 1px solid black;width:30%" align="center">
                            ชื่อและสกุลพยาน
                        </td>
                        <td style="border: 1px solid black;width:40%" align="center">
                            บ้านเลขที่ หมู่ที่ ถนน ซอย<br> ตำบล/แขวง อำเภอ/เขต จังหวัด
                        </td>
                        <td style="border: 1px solid black;width:10%" align="center">
                            หมายเหตุ
                        </td>
                    </tr>
                    <a class="absolute"><textarea style="margin-top:55px;margin-left:0px;line-height:1.415;font-size: 22px;font-family: myFont;" rows="25" cols="88" class="transparent" id="textarea2" name="textarea2"></textarea></a>
                    <?php
                        for($j=1;$j<13;$j++){
                    ?>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                        <?php } ?>
                    
                </table>
                <br>
                <p class="right">____________________________________________ผู้ระบุ</p>

            <!-- </div> -->
        </div>    
    </div>
    
    <?php
        for($i=3;$i<31;$i++){
            //$mod = $i % 2;
    ?>

        <div class="page">
            <div class="subpage">
            <header>
                <table style="width:100%;border: 0px solid black">
                    <tr style="color:#85929E ">
                        <td style="width:33%" align="left"></td>
                        <td style="width:33%"></td>
                        <td style="width:33%" class="right"><?php echo $i ?></td>
                    </tr>
                </table>
            </header>
            <table style="width:100%;border: 0px solid black" align="left">
                <tr>
                    <td class="left-top" align="left" style="width:40%">
                        <br><img src="../assets/circle.png">&nbsp;&nbsp;(๑๕ ทวิ)<br>บัญชีพยาน
                    </td>
                    <td style="width:20%" align="top"></td>
                    <td style="width:40%" align="right">
                        <br>
                        <br>
                        <br>
                        <div>คดีหมายเลขดำที่_<a class="absolute"><input class="transparent text-center" type="text" id="textp1<?php echo $i ?>" name="textp1<?php echo $i ?>" size="4"></a>_________/๒๕<a class="absolute"><input class="transparent" type="text" id="textp2<?php echo $i ?>" name="textp2<?php echo $i ?>" size="1"></a>___</div>
                        คดีหมายเลขแดงที่_<a class="absolute"><input class="transparent text-center" type="text" id="textp3<?php echo $i ?>" name="textp3<?php echo $i ?>" size="4"></a>_________/๒๕<a class="absolute"><input class="transparent" type="text" id="textp4<?php echo $i ?>" name="textp4<?php echo $i ?>" size="1"></a>___
                    </td>
                </tr>
            </table>
            <a class="absolute"><textarea style="margin-top:205px;margin-left:-169mm;line-height:1.415;font-size: 22px;font-family: myFont;" rows="21" cols="88" class="transparent" id="textarea2" name="textarea2"></textarea></a>
            <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                <tr style="border: 1px solid black;">
                    <td align="center" style="border: 1px solid black;width:3%">
                    
                        อันดับ
                    </td>
                    <td style="border: 1px solid black;width:30%" align="center">
                        ชื่อและสกุลพยาน
                    </td>
                    <td style="border: 1px solid black;width:40%" align="center">
                        บ้านเลขที่ หมู่ที่ ถนน ซอย<br> ตำบล/แขวง อำเภอ/เขต จังหวัด
                    </td>
                    <td style="border: 1px solid black;width:10%" align="center">
                        หมายเหตุ
                    </td>
                </tr>
                <?php
                    for($j=1;$j<11;$j++){
                ?>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black"><br><br></td>
                    <td style="border: 1px solid black"><br><br></td>
                    <td style="border: 1px solid black"><br><br></td>
                    <td style="border: 1px solid black"><br><br></td>
                </tr>
                    <?php } ?>
                
            </table>
                
            </div>
        </div>
        <?php $i++; ?>
        <div class="page">
        <div class="subpage">
        <header>
                <table style="width:100%;border: 0px solid black">
                    <tr style="color:#85929E ">
                        <td style="width:33%" align="left"></td>
                        <td style="width:33%"></td>
                        <td style="width:33%" class="right"><?php echo $i ?></td>
                    </tr>
                </table>
            </header>
            <!-- <div class="form"> -->
                <table style="width:100%;border: 1px solid black;border-collapse: collapse;">
                    <tr style="border: 1px solid black;">
                        <td align="center" style="border: 1px solid black;width:3%">
                            อันดับ
                        </td>
                        <td style="border: 1px solid black;width:30%" align="center">
                            ชื่อและสกุลพยาน
                        </td>
                        <td style="border: 1px solid black;width:40%" align="center">
                            บ้านเลขที่ หมู่ที่ ถนน ซอย<br> ตำบล/แขวง อำเภอ/เขต จังหวัด
                        </td>
                        <td style="border: 1px solid black;width:10%" align="center">
                            หมายเหตุ
                        </td>
                    </tr>
                    <a class="absolute"><textarea style="margin-top:55px;margin-left:0px;line-height:1.415;font-size: 22px;font-family: myFont;" rows="25" cols="88" class="transparent" id="textarea<?php echo $i ?>" name="textarea<?php echo $i ?>"></textarea></a>
                    <?php
                        for($j=1;$j<13;$j++){
                    ?>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                        <td style="border: 1px solid black"><br><br></td>
                    </tr>
                        <?php } ?>
                    
                </table>
                <br>
                <p class="right">____________________________________________ผู้ระบุ</p>

            <!-- </div> -->
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

// get_all_input_text();

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
    // $birthday = thai_date($objResult_law['birthday']);
    $birthday = thai_date($objResult_law['birthday']);
    $arr_birthday = explode("-", $birthday);
    ?>
        document.getElementById('text5').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล
        document.getElementById('text11').value = '<?php echo $plaintiff ?>'; //จำเลย
        document.getElementById('text12').value = '<?php echo $defendant ?>'; //โจทย์
        
        document.getElementById('text18').value = '<?php echo $objResult_notis['lawyer_name'] ?>'; //ข้าพเจ้า
        

    <?php
} else {
    ?>
    get_form_report(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>


</script>

</html>