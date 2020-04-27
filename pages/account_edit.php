<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$account_id = $conDB->sqlEscapestr($_GET['account_id']);

// $_SESSION['PAGE'] = "../pages/plaintiff_edit.php?plaintiff_id=".$plaintiff_id;

$strSQL = "SELECT * FROM `user_account` WHERE `id` = '$account_id'";
$objQuery = $conDB->sqlQuery($strSQL);
$objResult = mysqli_fetch_assoc($objQuery);

$id = $objResult['id'];
$table = 'user_account';
$where_f = 'id';

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
    แก้ไขบัญชีผู้ใช้
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">Document</span></a></li>
    <li><a href="account.php"><span class="active">User Account</span></a></li>
    <li class="active">Edit</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
        <div class="col-xs-12">
        <!-- <button type="button" class="btn btn-app flat" onClick="deleteData('user_account','<?php echo $objResult['id'] ?>','id','<?php echo $objResult['name'] ?>','account.php')" title="delete">
            <img src="../dist/img/icon/delete.svg" width="20"><br>
			Delete
        </button> -->
        <button type="button" class="btn btn-app flat"  onClick="goHref('../pages/account.php')" title="discard">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
            Back
        </button>

        
            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Defendant Info</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>รหัสประจำตัว <span class="text-red">*</span></label>
                        <input type="text" id="code" name="code" class="form-control" placeholder="Code" value="<?php echo $objResult['code'];?>" maxlength="20" onChange="duplicate_data('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>Username <span class="text-red">*</span></label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="username" value="<?php echo $objResult['username'];?>" maxlength="20" onChange="duplicate_data('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>ชื่อบัญชี <span class="text-red">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?php echo $objResult['name'];?>" maxlength="100" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>เบอร์ติดต่อ <span class="text-red"></span></label>
                        <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" value="<?php echo $objResult['phone'];?>" maxlength="11" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>อีเมล <span class="text-red"></span></label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $objResult['email'];?>" maxlength="100" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>ตำแหน่ง <span class="text-red">*</span></label>
                        <input type="text" id="position" name="position" class="form-control" placeholder="Position" value="<?php echo $objResult['position'];?>" maxlength="100" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                    <label>แผนก <span class="text-red">*</span></label>
                    <select id="department" name="department" class="form-control" onchange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)">
                    <?php
                        $dep_id = $objResult['department'];
                        $strSQL_dep = "SELECT * FROM `department` WHERE `enable` = 1";
                        $objQuery_dep = $conDB->sqlQuery($strSQL_dep);
                        while($objResult_dep = mysqli_fetch_assoc($objQuery_dep)){
                    ?>
                        <option value="<?php echo $objResult_dep['department_id']; ?>" <?php if($dep_id == $objResult_dep['department_id']){echo 'selected';} ?>><?php echo $objResult_dep['department_name']  ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <label>สิทธิ <span class="text-red">*</span></label>
                    <select id="permission" name="permission" class="form-control" onchange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)">
                    <?php
                        $per_id = $objResult['permission'];
                        $strSQL_per = "SELECT * FROM `permission` WHERE `enable` = 1";
                        $objQuery_per = $conDB->sqlQuery($strSQL_per);
                        while($objResult_per = mysqli_fetch_assoc($objQuery_per)){
                    ?>
                        <option value="<?php echo $objResult_per['permission_id']; ?>" <?php if($per_id == $objResult_per['permission_id']){echo 'selected';} ?>><?php echo $objResult_per['permission_name']  ?></option>
                    <?php
                        }
                    ?>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <label>สถานะการใช้งาน <span class="text-red">*</span></label>
                    <select id="enable" name="enable" class="form-control" onchange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)">
                        <option value="1" <?php if($objResult['enable'] == 1){echo 'selected';} ?>>เปิด</option>
                        <option value="0" <?php if($objResult['enable'] == 0){echo 'selected';} ?>>ปิด</option>
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
//     $('#birthday').datepicker({
//         autoclose: true
//     })

//     function cal_age(){
//         var dayBirth = $("#birthday").val();
//         var dayBirth_arr = dayBirth.split("-");

//         var d = new Date();
//         var y = d.getFullYear();

//         var age_now = parseInt(y) - parseInt(dayBirth_arr[0]);
//              
//         $("#age").val(age_now);  
//         $("#age").trigger("change");
//      }
     

</script>
</html>