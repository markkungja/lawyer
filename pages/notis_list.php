<?php
session_start();
ob_start();
$_SESSION['PAGE'] = 'notis_list.php';
include("../connect/database.php");
$conDB = new db_conn();

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
    งานฟ้องคดี
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">งานฟ้องคดี</span></a></li>
    <li class="active">รายการ</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-xs-12">
    <button type="button" class="btn btn-app flat" onClick="goHref('../services/insert.php?type=add_notis')" title="new">
        <img src="../dist/img/icon/add.svg" width="20"><br>
        New
    </button>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover table-fixed">
            <thead>
            <tr>
              <th width="10">No</th>
              <th width="80">Action</th>
              <th>Notis No.</th>
              <th>Create Date</th>
              <th>โจทก์</th>
              <th>สัญญาปรับโครงสร้าง</th>
              <th>ประเภทสินเชื่อ</th>
              <th>ศาลจังหวัด</th>
              <th>โนติสวันที่</th>
              <th>ทนาย</th>
              <th>สถานะ</th>
            </tr>
            </thead>
            <tbody>
<?php 	$index = 1;
    $strSQL = "SELECT * FROM `document_notis` LEFT JOIN `plaintiff` ON document_notis.doc_plaintiff_id = plaintiff.plaintiff_id LEFT JOIN `lawyer` ON document_notis.lawyer_id = lawyer.lawyer_id";
    $objQuery = $conDB->sqlQuery($strSQL);
	while($objResult = mysqli_fetch_assoc($objQuery)) { ;?>
            <tr onDblClick="goHref('../pages/notis_edit.php?act=view&id=<?php echo $objResult['doc_id'] ?>')">
              <td><?php echo $index++; ?></td>
              <td align="center" style="font-size:16px;">
              <i class="fa fa-search text-blue" onClick="goHref('../pages/notis_edit.php?act=view&id=<?php echo $objResult['doc_id'] ?>')" title="view"></i>
              <i class="fa fa-pencil text-yellow" onClick="goHref('../pages/notis_edit.php?act=edit&id=<?php echo $objResult['doc_id'] ?>')" title="edit"></i>
              <i class="fa fa-trash-o text-red" onClick="deleteData('document_notis','<?php echo $objResult['doc_id'] ?>','doc_id','<?php echo $objResult['doc_no'] ?>')" title="delete"></i>
              <!-- <?php if($objResult['attach'] != ''){?>
              <i class="fa fa-paperclip" title="attach" onclick="window.open('../dist/upload/<?php echo $objResult['attach'];?>','<?php echo $objResult['attach'];?>','width=500','height=600')"></i>
              <?php }else{?>
              <i class="fa fa-paperclip disable" title="attach"></i>
              <?php }?> -->
              <!-- <a href="../report/purchase.php?id=<?php echo $objResult['doc_id'] ?>" target="_blank"><i class="fa fa-print" title="print"></i></a> -->
              </td>
              <td><?php echo $objResult['doc_no'] ?></td>
              <td class="td-ellipsis" title="<?php echo $objResult['doc_create_date'] ?>"><?php echo $objResult['doc_create_date'] ?></td>
              <td class="td-ellipsis" title="<?php echo $objResult['plaintiff_name'] ?>"><?php echo $objResult['plaintiff_name'] ?></td>
              <td><?php echo $objResult['doc_restructuring'] ?></td>
              <td><?php echo $objResult['doc_credit_type'] ?></td>
              <td><?php echo $objResult['doc_county'] ?></td>
              <td><?php echo $objResult['doc_notis_date'] ?></td>
              <td><?php echo $objResult['lawyer_name'] ?></td>
              <td><?php echo $objResult['doc_status'] ?></td>
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

<div>
<!-- End row -->
</section>
</body>
<?php include("script.php");?>
<script>
  $(function () {
    $('#example1').DataTable({
	  'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
	  "bStateSave"  : true,
	 "fnStateLoaded": function (oSettings, oData) {
	 //alert( 'Saved filter was: '+oData.oSearch.sSearch );
	 }
    })
  })
</script>
</html>