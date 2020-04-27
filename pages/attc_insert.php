<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$attc_type = $conDB->sqlEscapestr($_GET['attc_type']);

?>
<!DOCTYPE html>
<html>
<head>
<?php include("head.php");?>
</head>
<body class="skin-black">
<div id="alert-background"></div>
<section class="content-header">
  <h1>
    <?php
        if($attc_type === "1"){
            ?> แนบไฟล์ <?php
        }else if($attc_type === "2"){
            ?> แนบไฟล์คำพิพากษา <?php
        }
    ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">Document</span></a></li>
    <li><a href="notis_list.php"><span class="active">Notis</span></a></li>
    <li class="active">Report</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
        <div class="col-xs-12">
        <button type="button" class="btn btn-app" onClick="insert_attc()" title="new">
            <img src="../dist/img/icon/add.svg" width="20"><br> เพิ่มเอกสาร
        </button>
        <button type="button" class="btn btn-app flat"  onClick="goBack()">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
			กลับ
        </button>
        
            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Attached Insert</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>ชื่อแนบไฟล์ <span class="text-red">*</span></label>
                        <input type="text" id="doc_file_name" name="doc_file_name" class="form-control" placeholder="Report name" value="" maxlength="100" required />
                    </div> 
                    <div class="form-group">
                        <label for="exampleInputFile">เลือกแนบไฟล์</label>
                        <input type="file" id="attc_file" multiple>
                        <!-- <p class="help-block"></p> -->
                    </div>
                    

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
</div>

</section>
</body>
<?php include("script.php");?>

<script>
    $('#doc_notis_date').datepicker({
        autoclose: true
    })

function insert_attc(){
    //alert('test');
    var doc_file_name = $("#doc_file_name").val();
    
    var doc_id = <?php echo $doc_id ?>;
    var type_attc = "<?php echo $attc_type ?>";
    // var attc_file = $("#attc_file").val();
    // var insert = ""
    
    var form_data = new FormData();
    var ins = document.getElementById('attc_file').files.length;
    console.log(ins);
    if(!ins){
        alert('ต้องอัพโหลดอย่างน้อย 1 ไฟล์');
    } else {
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('attc_file').files[x]);
        }
        $.ajax({
            url: '../services/upload_attc.php?doc_file_name='+ doc_file_name +'&doc_id='+ doc_id + '&type_attc='+type_attc, // point to server-side PHP script 
            dataType: 'text', // what to expect back from the PHP script
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                if(response === "false"){
                    alert("อัพโหลดผิดพลาดกรุณาลองใหม่");
                } else {
                    alert(response);
                    window.location.href = "notis_edit.php?act=edit&id="+doc_id;
                }
            
            }

        }); 

    }



    // var parValue = "doc_report_name="+doc_report_name+"&report_id="+report_id+"&doc_id="+doc_id+"&type="+type;

    // xmlhttp = new XMLHttpRequest();
    // xmlhttp.open("POST", "../services/insert.php", true);
    // xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    // xmlhttp.send(parValue);
    // goHref("../services/insert.php?"+"doc_report_name="+doc_report_name+"&report_id="+report_id+"&doc_id="+doc_id+"&type="+type);

}

</script>
</html>