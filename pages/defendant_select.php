<?php
session_start();
ob_start();
include("../connect/database.php");
if(!isset($_GET['view_list'])){
  $doc_id = "&doc_id=".$_GET['doc_id'];
  $id = $_GET['doc_id'];
} else {
  $doc_id = "";
  $id = "";
  $_SESSION['PAGE'] = "../pages/defendant_select.php?view_list=view_list";
}
$conDB = new db_conn();
$strSQL = "SELECT * FROM `defendant` WHERE `enable` = '1'";
$objQuery = $conDB->sqlQuery($strSQL);
$index = 0;
?>
<!DOCTYPE html>
<html>
<head>
<?php include("head.php");?>
<?php
  if(isset($_GET['view_list'])){
    ?>
      <style>
        .list{
          display:none;
        }
      </style>
    <?php
  } else {
    ?>
      <style>
        .list{
          display:block;
        }
      </style>
    <?php
  }
?>
</head>
<body class="skin-black">
<section class="content-header">
  <h1>
    รายชื่อจำเลย
  </h1>
  <ol class="breadcrumb">
        <li class="active">Select Defendant</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
        <button type="button" class="btn btn-app flat" onClick="goHref('../services/insert.php?type=add_defendant&doc_id=<?php echo $doc_id ?>')" title="new">
            <img src="../dist/img/icon/add.svg" width="20"><br>
            New
        </button>
        <button type="button" class="btn btn-app flat"  onClick="goHref('notis_edit.php?act=edit&id=<?php echo $id ?>')">
              <img src="../dist/img/icon/multiply.svg" width="20"><br>
          Discard
        </button>
  
      <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">List</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="15">No</th>
              <th width="25">#</th>
              <th>ชื่อจำเลย</th>
              <th>รหัสบัตรประชาชน</th>
              <th width="80">Action</th>
            </tr>
            </thead>
            <tbody>
<?php 
	while($objResult = mysqli_fetch_assoc($objQuery)) {
        $index++;
        ?>
            <tr>        
              <td><?php echo $index ?></td>
              <td style="padding:0px;"><a class="list" href="../services/defendant_select.php?doc_id=<?php echo $doc_id; ?>&defendant_id=<?php echo $objResult['defendant_id']; ?>"><button type="button" class="btn btn-success btn-flat btn-block">เลือก</button></a></td>
              <td><?php echo $objResult['defendant_name'] ?></td>
              <td><?php echo $objResult['defendant_no'] ?></td>
              <td align="center" style="font-size:16px;">
                <i class="fa fa-pencil text-yellow" onClick="goHref('../pages/defendant_edit.php?defendant_id=<?php echo $objResult['defendant_id']; ?><?php echo $doc_id ?>')" title="edit"></i>
                <!-- <i class="fa fa-trash-o text-red" onClick="deleteData('document_report','<?php echo $objResult_doc['doc_report_id'] ?>','doc_report_id','<?php echo $objResult_doc['doc_report_name'] ?>')" title="delete"></i> -->
              </td>
            </tr>
<?php }?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
</body>
<?php include("script.php");?>
<script>
  $(function () {
    $('#example1').DataTable({
	  'responsive'  : true,
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
	  "bStateSave"  : true,
	 "fnStateLoaded": function (oSettings, oData) {
	 //alert( 'Saved filter was: '+oData.oSearch.sSearch );
	 }
    })
  })
</script>
</html>