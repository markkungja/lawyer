<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);
$doc_report_id = $conDB->sqlEscapestr($_GET['doc_report_id']);

$_SESSION['PAGE'] = "../pages/report_edit.php?doc_id=".$doc_id."&doc_report_id=".$doc_report_id;

$strSQL = "SELECT * FROM `document_report` LEFT JOIN report ON document_report.report_id = report.report_id WHERE `doc_report_id` = '$doc_report_id'";
$objQuery = $conDB->sqlQuery($strSQL);
$objResult = mysqli_fetch_assoc($objQuery);

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
    แก้ไขรายงาน
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
        <a href="../report/form/<?php echo $objResult['report_file'] ?>?doc_id=<?php echo $doc_id ?>&doc_report_id=<?php echo $doc_report_id ?>" target="_blank">
            <button type="button" class="btn btn-app" title="">
                <img src="../dist/img/icon/files.svg" width="20"><br> เปิดรายงานในหน้าแยก
            </button>
        </a>
        <button type="button" class="btn btn-app" title="reset" onClick="btn_reset(<?php echo $objResult['doc_report_id'] ?>,'document_report','doc_report_id','','doc_report_text')">
            <img src="../dist/img/icon/repeat.svg" width="20"><br> รีเซตข้อมูลการปรับแต่ง
        </button>
        <button type="button" class="btn btn-app flat"  onClick="goHref('../pages/notis_edit.php?act=edit&id=<?php echo $objResult['doc_id']?>')">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
			กลับ
        </button>
        
            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Report Edit</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>ชื่อรายงาน <span class="text-red">*</span></label>
                        <input type="text" id="doc_report_name" name="doc_report_name" class="form-control" placeholder="Report name" value="<?php echo $objResult['doc_report_name'] ?>" maxlength="100" onChange="form_autosave('<?php echo $objResult['doc_report_id'];?>','document_report','doc_report_id',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>รายงาน <span class="text-red">*</span></label>
                        <input type="text" id="report_name" name="report_name" class="form-control" placeholder="Report name" value="<?php echo $objResult['report_name'] ?>" readonly />
                    </div> 
                    <!-- <div class="col-md-12">
                        <label>คำอธิบายรายงาน <span class="text-red">*</span></label>
                        <input type="text" id="doc_report_text" name="doc_report_text" class="form-control" placeholder="Description" value="<?php echo $objResult['doc_report_text'] ?>" maxlength="100" onChange="form_autosave('<?php echo $objResult['doc_report_id'];?>','document_report','doc_report_id',this)" required />
                    </div>  -->
                    

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- <div id="report_div"></div> -->
            <iframe src="../report/form/<?php echo $objResult['report_file'] ?>?doc_id=<?php echo $doc_id ?>&doc_report_id=<?php echo $doc_report_id ?>" height="800" width="100%"></iframe>
</div>

</section>
</body>
<?php include("script.php");?>

<script>



</script>
</html>