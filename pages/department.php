<?php
session_start();
ob_start();
include("../connect/database.php");
$_SESSION['PAGE'] = "../pages/department.php";
$conDB = new db_conn();
$strSQL = "SELECT * FROM `department`";
$objQuery = $conDB->sqlQuery($strSQL);
$index = 0;
?>
<!DOCTYPE html>
<html>
<head>
<?php include("head.php");?>
</head>
<body class="skin-black">
<section class="content-header">
  <h1>
    จัดการแผนก
  </h1>
  <ol class="breadcrumb">
        <li class="active">จัดการแผนก</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
    <button type="button" class="btn btn-app flat" onClick="goHref('../services/insert.php?type=add_department')" title="new">
        <img src="../dist/img/icon/add.svg" width="20"><br>
        New
    </button>
    <!-- <button type="button" class="btn btn-app flat"  onClick="goHref('notis_edit.php?act=edit&id=<?php echo $id ?>')">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
			Discard
        </button> -->
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
              <th width="15">ลำดับ</th>
              <th width="200">ชื่อแผนก</th>
              <th width="100">สถานะ</th>
              <th width="80"></th>
            </tr>
            </thead>
            <tbody>
<?php 
	while($objResult = mysqli_fetch_assoc($objQuery)) {
        $index++;
        $id = $objResult['department_id'];
        $table = 'department';
        $where_f = 'department_id';
        ?>
            <tr>        
              <td><?php echo $index ?></td>
              <td>
              <input type="text" id="department_name<?php echo $index ?>" name="department_name" class="form-control" placeholder="Name" value="<?php echo $objResult['department_name'] ?>" maxlength="100" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
              </td>
              <td>
                <select id="enable" name="enable" class="form-control" onchange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)">
                    <option value="1" <?php if($objResult['enable'] == 1){echo 'selected';} ?>>เปิด</option>
                    <option value="0" <?php if($objResult['enable'] == 0){echo 'selected';} ?>>ปิด</option>
                </select>
              </td>

              <td align="center" style="font-size:16px;">
                <i class="fa fa-trash-o text-red" onClick="deleteData('department','<?php echo $objResult['department_id'] ?>','department_id','<?php echo $objResult['department_name'] ?>')" title="delete"></i>
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
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
	  "bStateSave"  : true,
	 "fnStateLoaded": function (oSettings, oData) {

	 }
    })
  })
</script>
</html>