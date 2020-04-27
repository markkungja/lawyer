<?php
session_start();
ob_start();
include("../../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$doc_report_id = $conDB->sqlEscapestr($_GET['doc_report_id']);

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
    
</head>
<body>

<div class="navbar">
    <button type="button" class="btn btn-app flat"  onClick="save_report2()">
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
<?php
    $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
    $objQuery_def = $conDB->sqlQuery($strSQL_def);
    while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
        $doc_def_id = $objResult_def['doc_def_id'];

?>
    <div id="def_doc_id_<?php echo $doc_def_id ?>">
        <div class="page">
            <div class="subpage">
                    <table style="width:100%;border: 0px solid black" align="left">
                        <tr>
                            <td class="left-top" align="left" style="width:40%">
                                <br>(แบบ ผบ. ๒)<br>คำฟ้องคดีผู้บริโภค
                            </td>
                            <td style="width:20%" align="top"><img src="../assets/logo.png"></td>
                            <td style="width:40%" align="right">
                                <br><br><br>
                                <div>คดีหมายเลขดำที่...<a class="absolute"><input class="transparent text-center" type="text" id="text1_<?php echo $doc_def_id ?>" name="text1_<?php echo $doc_def_id ?>" size="4"></a>…………
                                _/๒๕<a class="absolute"><input class="transparent" type="text" id="text2_<?php echo $doc_def_id ?>" name="text2_<?php echo $doc_def_id ?>" size="1"></a>……</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" align="right">
                            <br>
                            <div class="center"><b>ในพระปรมาภิไธยพระมหากษัตริย์</b></div>
                                ศาล...<a class="absolute"><input class="transparent text-center" type="text" id="text5_<?php echo $doc_def_id ?>" name="text5_<?php echo $doc_def_id ?>" size="28"></a>…………………………………………&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                                วันที่<a class="absolute"><input class="transparent text-center" type="text" id="text6_<?php echo $doc_def_id ?>" name="text6_<?php echo $doc_def_id ?>" size="1"></a>.........
                                เดือน<a class="absolute"><input class="transparent text-center" type="text" id="text7_<?php echo $doc_def_id ?>" name="text7_<?php echo $doc_def_id ?>" size="8"></a>………………
                                _<?php echo $doc_def_id ?>พุทธศัราช ๒๕<a class="absolute"><input class="transparent" type="text" id="text8_<?php echo $doc_def_id ?>" name="text8_<?php echo $doc_def_id ?>" size="1"></a>.........&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                                ความแพ่ง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>
                            </td>
                        </tr>
                    </table>
                    <div></div>
                    <p><img src="../assets/plan_def_dot.png">
                    <a class="absolute"><textarea style="margin-left:-500px;margin-top:1px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="62" class="transparent" id="text9_<?php echo $doc_def_id ?>" name="text9_<?php echo $doc_def_id ?>"></textarea></a>
                    <a class="absolute"><textarea style="margin-left:-500px;margin-top:85px;line-height:1.2;font-size: 21px;font-family: myFont;" rows="2" cols="62" class="transparent" id="text10_<?php echo $doc_def_id ?>" name="text10_<?php echo $doc_def_id ?>"></textarea></a>
                    <p>
                    <a class="absolute"><textarea style="margin-top:-2px;margin-left:0px;;line-height:1.3;font-size: 21px;font-family: myFont;" rows="2" cols="81" class="transparent" id="textarea1_<?php echo $doc_def_id ?>" name="textarea1_<?php echo $doc_def_id ?>"></textarea></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        หมายถึง……………………………………………………………………………………<br>
                        ………………………………………………………………………………………………………….จำเลย<br>
                        อยู่บ้านเลขที่<a class="absolute"><input class="transparent text-center" type="text" id="text15_<?php echo $doc_def_id ?>" name="text15_<?php echo $doc_def_id ?>" size="13"></a>………………..…...
                        หมู่ที่<a class="absolute"><input class="transparent text-center" type="text" id="text16_<?php echo $doc_def_id ?>" name="text16_<?php echo $doc_def_id ?>" size="5"></a>………… 
                        ถนน<a class="absolute"><input class="transparent text-center" type="text" id="text17_<?php echo $doc_def_id ?>" name="text17_<?php echo $doc_def_id ?>" size="8"></a>……………....
                        ตรอก/ซอย<a class="absolute"><input class="transparent text-center" type="text" id="text18_<?php echo $doc_def_id ?>" name="text18_<?php echo $doc_def_id ?>" size="15"></a>………………………..<br>
                        ใกล้เคียง<a class="absolute"><input class="transparent text-center" type="text" id="text19_<?php echo $doc_def_id ?>" name="text19_<?php echo $doc_def_id ?>" size="14"></a>……………………..
                        ตำบล/แขวง<a class="absolute"><input class="transparent text-center" type="text" id="text20_<?php echo $doc_def_id ?>" name="text20_<?php echo $doc_def_id ?>" size="13"></a>……………………. 
                        อำเภอ/เขต<a class="absolute"><input class="transparent text-center" type="text" id="text21_<?php echo $doc_def_id ?>" name="text21_<?php echo $doc_def_id ?>" size="20"></a>………………………………<br>
                        จังหวัด<a class="absolute"><input class="transparent text-center" type="text" id="text22_<?php echo $doc_def_id ?>" name="text22_<?php echo $doc_def_id ?>" size="18"></a>……………………………
                        โทรศัพท์<a class="absolute"><input class="transparent text-center" type="text" id="text23_<?php echo $doc_def_id ?>" name="text23_<?php echo $doc_def_id ?>" size="15"></a>……………………….
                        โทรสาร<a class="absolute"><input class="transparent text-center" type="text" id="text24_<?php echo $doc_def_id ?>" name="text24_<?php echo $doc_def_id ?>" size="21"></a>……………………………….<br>
                        ด้วยโจทก์ได้ฟ้องท่านเป็นจำเลยต่อศาลนี้โดยมีรายละเอียดเหตุแห่งการฟ้องคดีและคำขอบังคับ<br>ตามสำเนาคำฟ้องซึ่งได้ส่งมาให้ทราบพร้อมกับหมายนี้แล้ว
                        ฉะนั้น  ให้ท่านไปศาลเพื่อการไกล่เกลี่ย ให้การและสืบพยานในวันที่<a class="absolute"><input class="transparent text-center" type="text" id="text25_<?php echo $doc_def_id ?>" name="text25_<?php echo $doc_def_id ?>" size="3"></a>……….
                        เดือน<a class="absolute"><input class="transparent text-center" type="text" id="text26_<?php echo $doc_def_id ?>" name="text26_<?php echo $doc_def_id ?>" size="8"></a>…………….<br>
                        พ.ศ. ๒๕<a class="absolute"><input class="transparent text-center" type="text" id="text27_<?php echo $doc_def_id ?>" name="text27_<?php echo $doc_def_id ?>" size="3"></a>……….
                        เวลา<a class="absolute"><input class="transparent text-center" type="text" id="text28_<?php echo $doc_def_id ?>" name="text28_<?php echo $doc_def_id ?>" size="21"></a>………………………………..นาฬิกา  เพื่อศาลจะได้ดำเนินกระบวนพิจารณาต่อไป  <br>
                        (ให้ดูคำแนะนำเกี่ยวกับวิธีปฏิบัติฯท้ายสำเนาคำฟ้องนี้)<br>

                    <p class="right"><br>
                        …………………………………………………&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                        ผู้พิพากษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br>
                    </p>
                    </p>

            </div>    
        </div>
    </div>
    <?php } ?>

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
if($objResult['doc_report_text'] == "" || $objResult['doc_report_text'] == NULL){

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
    
    $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
    $objQuery_def = $conDB->sqlQuery($strSQL_def);
    while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
        $doc_def_id = $objResult_def['doc_def_id'];
        $defendant_id = $objResult_def['defendant_id'];

        $strSQL_defendant = "SELECT * FROM `defendant` WHERE `defendant_id` = '$defendant_id'";
        $objQuery_defendant = $conDB->sqlQuery($strSQL_defendant);
        $objResult_defendant = mysqli_fetch_assoc($objQuery_defendant);

    ?>
        document.getElementById('text5_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล

        document.getElementById('text9_<?php echo $doc_def_id ?>').value = '<?php echo $plaintiff ?>'; //โจทก์
        document.getElementById('text10_<?php echo $doc_def_id ?>').value = '<?php echo $defendant ?>'; //จำเลย

        document.getElementById('textarea1_<?php echo $doc_def_id ?>').value = '<?php echo "                                     ".$objResult_def['doc_def_name'] ?>'; //หมายถึง โจทก์
        document.getElementById('text15_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_unit'] ?>'; //เลขที่บ้าน
        document.getElementById('text16_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_bloc'] ?>'; //หมู่
        document.getElementById('text17_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_road'] ?>'; //ถนน
        document.getElementById('text18_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_alley'] ?>'; //ซอย
        document.getElementById('text20_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_zone'] ?>'; //แขวง
        document.getElementById('text21_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_area'] ?>'; //เขต
        document.getElementById('text22_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_county'] ?>'; //จังหวัด
        document.getElementById('text23_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_phone'] ?>'; //โทรศัพท์
        document.getElementById('text24_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_number'] ?>'; //โทรสาร


    <?php
    }//end while
} else {
    ?>
    function get_form_report2(text_report){
        // if(){
        //     for(i=0;i<text_report.report.length;i++){
        //         document.getElementById(text_report.report[i].text_id).value = text_report.report[i].value;
        //     }
        // }
        console.log(text_report);
        var result;
        <?php
            $x = 0;
            $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
            $objQuery_def = $conDB->sqlQuery($strSQL_def);
            while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
                $x++;
                $doc_def_id = $objResult_def['doc_def_id'];
                $defendant_id = $objResult_def['defendant_id'];
        ?>
                result = text_report.report.find((element) => {
                    return element.doc_def_id == <?php echo $doc_def_id  ?>
                })
                if(result){
                    // console.log('found');
                    for(i=0;i<result.def_report.length;i++){
                        document.getElementById(result.def_report[i].text_id).value = result.def_report[i].value;
                    }
                }else{
                    // console.log('not found');
                    <?php
                        $strSQL_defendant = "SELECT * FROM `defendant` WHERE `defendant_id` = '$defendant_id'";
                        $objQuery_defendant = $conDB->sqlQuery($strSQL_defendant);
                        $objResult_defendant = mysqli_fetch_assoc($objQuery_defendant);
                    ?>
                    document.getElementById('text5_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_notis['doc_county'] ?>'; //ศาล

                    document.getElementById('text9_<?php echo $doc_def_id ?>').value = '<?php echo $plaintiff ?>'; //โจทก์
                    document.getElementById('text10_<?php echo $doc_def_id ?>').value = '<?php echo $defendant ?>'; //จำเลย

                    document.getElementById('textarea1_<?php echo $doc_def_id ?>').value = '<?php echo "                                     ".$objResult_def['doc_def_name'] ?>'; //หมายถึง โจทก์
                    document.getElementById('text15_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_unit'] ?>'; //เลขที่บ้าน
                    document.getElementById('text16_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_bloc'] ?>'; //หมู่
                    document.getElementById('text17_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_road'] ?>'; //ถนน
                    document.getElementById('text18_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_alley'] ?>'; //ซอย
                    document.getElementById('text20_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_zone'] ?>'; //แขวง
                    document.getElementById('text21_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_area'] ?>'; //เขต
                    document.getElementById('text22_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_county'] ?>'; //จังหวัด
                    document.getElementById('text23_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_phone'] ?>'; //โทรศัพท์
                    document.getElementById('text24_<?php echo $doc_def_id ?>').value = '<?php echo $objResult_defendant['current_number'] ?>'; //โทรสาร
                    

                    
                }
                console.log(result)
                console.log(<?php echo $doc_def_id  ?>);
        <?php
            }
        ?>

    }
    get_form_report2(<?php echo $objResult['doc_report_text'] ?>);
    <?php
}
?>

function save_report2(){
    var jsonStr ='{"report":[],"doc_report_id":'+ document.getElementById("doc_report_id").value +'}';
    var obj = JSON.parse(jsonStr);
    <?php
        $strSQL_def = "SELECT * FROM `document_def` WHERE `doc_id` = '$doc_id'";
        $objQuery_def = $conDB->sqlQuery($strSQL_def);
        while($objResult_def = mysqli_fetch_assoc($objQuery_def)){
            $doc_def_id = $objResult_def['doc_def_id'];
    ?>
            var input = document.getElementById('def_doc_id_<?php echo $doc_def_id ?>').getElementsByTagName('input');
            var doc_arr = '{"def_report":[],"doc_def_id":<?php echo $doc_def_id ?>}';
            var doc_arr_obj = JSON.parse(doc_arr);
            for(i=0;i<input.length;i++){
                var text_id_html = input[i].getAttribute('id');
                var text_value = document.getElementById(text_id_html).value;  
                doc_arr_obj['def_report'].push({"text_id":text_id_html,"value":text_value});
            }

            var input_textarea = document.getElementById('def_doc_id_<?php echo $doc_def_id ?>').getElementsByTagName('textarea');
            for(i=0;i<input_textarea.length;i++){
                var text_id_html = input_textarea[i].getAttribute('id');
                var text_value = document.getElementById(text_id_html).value;  
                doc_arr_obj['def_report'].push({"text_id":text_id_html,"value":text_value});
            }  
        obj['report'].push(doc_arr_obj);
    <?php
        }
    ?>
	console.log(obj);
	var text = JSON.stringify(obj);
	//console.log(text);
	//console.log(obj.doc_report_id);
	var n = obj.doc_report_id;
	var t = "document_report";
	var tf = "doc_report_id";
	var v = text;
	var f = "doc_report_text";
	$.post("../../services/autosave.php", {n:n,t:t,tf:tf,v:v,f,f}, function(data){
		// console.log(data);
		alert('บันทึกข้อมูลแล้ว!');
	});

}

</script>

</html>