<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);

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
    เพิ่มรายงาน
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
        <button type="button" class="btn btn-app" onClick="insert_report()" title="new">
            <img src="../dist/img/icon/add.svg" width="20"><br> เพิ่มเอกสาร
        </button>
        <button type="button" class="btn btn-app flat"  onClick="goBack()">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
			กลับ
        </button>
        
            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Report Insert</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>ชื่อรายงาน <span class="text-red">*</span></label>
                        <input type="text" id="doc_report_name" name="doc_report_name" class="form-control" placeholder="Report name" value="" maxlength="100" required />
                    </div> 
                    <div class="col-md-6">
                        <label>เลือกรายงาน <span class="text-red">*</span></label>
                        <select class="form-control" id="report_id" name="report_id">
                            <?php
                            $strSQL = "SELECT * FROM `report`";
                            $objQuery = $conDB->sqlQuery($strSQL);
                            while($objResult = mysqli_fetch_assoc($objQuery)){
                            ?>
                            <option value="<?php echo $objResult['report_id'] ?>"><?php echo $objResult['report_name'] ?></option>
                            <?php } ?>

                        </select>
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

function insert_report(){
    //alert('test');
    var doc_report_name = $("#doc_report_name").val();
    var report_id = $("#report_id").val();
    var doc_id = <?php echo $doc_id ?>;
    var type = "insert_report";

    var parValue = "doc_report_name="+doc_report_name+"&report_id="+report_id+"&doc_id="+doc_id+"&type="+type;

    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "../services/insert.php", true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xmlhttp.send(parValue);
    goHref("../services/insert.php?"+"doc_report_name="+doc_report_name+"&report_id="+report_id+"&doc_id="+doc_id+"&type="+type);
    // $.post("../services/insert.php", {doc_report_name:doc_report_name,report_id:report_id,doc_id:doc_id,type:type}, function(data){
    //         console.log(data);
    // });
}

</script>
</html>