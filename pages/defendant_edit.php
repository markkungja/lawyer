<?php
session_start();
ob_start();
include("../connect/database.php");
$conDB = new db_conn();

$defendant_id = $conDB->sqlEscapestr($_GET['defendant_id']);

if(isset($_GET['doc_id'])){
    $doc_id = "?doc_id=".$_GET['doc_id'];
} else {
    $doc_id = "";
}

// $_SESSION['PAGE'] = "../pages/plaintiff_edit.php?plaintiff_id=".$plaintiff_id;

$strSQL = "SELECT * FROM `defendant` WHERE `defendant_id` = '$defendant_id'";
// $numrow = $conDB->sqlNumrows($strSQL);
// if($numrow == 0){
//     ?><script>//window.history.back();</script><?php
// }
$objQuery = $conDB->sqlQuery($strSQL);
$objResult = mysqli_fetch_assoc($objQuery);

$id = $objResult['defendant_id'];
$table = 'defendant';
$where_f = 'defendant_id';

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
    แก้ไขทนาย
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">Document</span></a></li>
    <li><a href="notis_list.php"><span class="active">Defendant</span></a></li>
    <li class="active">Edit</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
        <div class="col-xs-12">
        <button type="button" class="btn btn-app flat" onClick="deleteData('document_notis','<?php echo $objResult['doc_id'] ?>','doc_id','<?php echo $objResult['doc_no'] ?>')" title="delete">
            <img src="../dist/img/icon/delete.svg" width="20"><br>
			Delete
        </button>
        <button type="button" class="btn btn-app flat"  onClick="goHref('defendant_select.php<?php echo $doc_id ?>')" title="discard">
            <img src="../dist/img/icon/multiply.svg" width="20"><br>
            Discard
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
                        <label>ชื่อโจทก์ <span class="text-red">*</span></label>
                        <input type="text" id="defendant_name" name="defendant_name" class="form-control" placeholder="Name" value="<?php echo $objResult['defendant_name'];?>" maxlength="100" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>รหัสบัตรประชาชน <span class="text-red">*</span></label>
                        <input type="text" id="defendant_no" name="defendant_no" class="form-control" placeholder="0000000000000" value="<?php echo $objResult['defendant_no'];?>" maxlength="20" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" />
                    </div> 
                    <div class="col-md-6">
                        <label>เชื้อชาติ <span class="text-red">*</span></label>
                        <input type="text" id="race" name="race" class="form-control" placeholder="" value="<?php echo $objResult['race'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" />
                    </div> 
                    <div class="col-md-6">
                        <label>สัญชาติ <span class="text-red">*</span></label>
                        <input type="text" id="nationality" name="nationality" class="form-control" placeholder="" value="<?php echo $objResult['nationality'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)"  />
                    </div> 
                    <div class="col-md-6">
                        <label>อาชีพ <span class="text-red">*</span></label>
                        <input type="text" id="job" name="job" class="form-control" placeholder="" value="<?php echo $objResult['job'];?>" maxlength="50" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)"  />
                    </div> 
                    <div class="col-md-6">
                        <label>วันเกิด </label>
                        <div class="input-group birthday">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" id="birthday" name="birthday" value="<?php echo $objResult['birthday'];?>" onChange="cal_age();form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>อายุ </label>
                        <input type="number" id="age" name="age" class="form-control" placeholder="" value="<?php echo $objResult['age'];?>" maxlength="3" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)"  />
                    </div>                 

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Defendant Current Info</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>เลขที่บ้าน</label>
                        <input type="text" id="current_unit" name="current_unit" class="form-control" placeholder="" value="<?php echo $objResult['current_unit'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>หมู่</label>
                        <input type="text" id="current_bloc" name="current_bloc" class="form-control" placeholder="" value="<?php echo $objResult['current_bloc'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ถนน</label>
                        <input type="text" id="current_road" name="current_road" class="form-control" placeholder="" value="<?php echo $objResult['current_road'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ซอย</label>
                        <input type="text" id="current_alley" name="current_alley" class="form-control" placeholder="" value="<?php echo $objResult['current_alley'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ตำบล/แขวง</label>
                        <input type="text" id="current_zone" name="current_zone" class="form-control" placeholder="" value="<?php echo $objResult['current_zone'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>อำเภอ/เขต</label>
                        <input type="text" id="current_area" name="current_area" class="form-control" placeholder="" value="<?php echo $objResult['current_area'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>จังหวัด</label>
                        <input type="text" id="current_county" name="current_county" class="form-control" placeholder="" value="<?php echo $objResult['current_county'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>รหัสไปรษณีย์</label>
                        <input type="text" id="current_post" name="current_post" class="form-control" placeholder="" value="<?php echo $objResult['current_post'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>โทรศัพท์</label>
                        <input type="text" id="current_phone" name="current_phone" class="form-control" placeholder="" value="<?php echo $objResult['current_phone'];?>" maxlength="15" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>โทรสาร</label>
                        <input type="text" id="current_number" name="current_number" class="form-control" placeholder="" value="<?php echo $objResult['current_number'];?>" maxlength="15" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>จดหมายอิเล็กทรอนิกส์(Email)</label>
                        <input type="text" id="current_email" name="current_email" class="form-control" placeholder="" value="<?php echo $objResult['current_email'];?>" maxlength="50" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box">
            	<div class="box-header with-border">
                  <h3 class="box-title">Defendant Work Info</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-6">
                        <label>เลขที่บ้าน</label>
                        <input type="text" id="work_unit" name="work_unit" class="form-control" placeholder="" value="<?php echo $objResult['work_unit'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>หมู่</label>
                        <input type="text" id="work_bloc" name="work_bloc" class="form-control" placeholder="" value="<?php echo $objResult['work_bloc'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ถนน</label>
                        <input type="text" id="work_road" name="work_road" class="form-control" placeholder="" value="<?php echo $objResult['work_road'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ซอย</label>
                        <input type="text" id="work_alley" name="work_alley" class="form-control" placeholder="" value="<?php echo $objResult['work_alley'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>      
                    <div class="col-md-6">
                        <label>ตำบล/แขวง</label>
                        <input type="text" id="work_zone" name="work_zone" class="form-control" placeholder="" value="<?php echo $objResult['work_zone'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>อำเภอ/เขต</label>
                        <input type="text" id="work_area" name="work_area" class="form-control" placeholder="" value="<?php echo $objResult['work_area'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>จังหวัด</label>
                        <input type="text" id="work_county" name="work_county" class="form-control" placeholder="" value="<?php echo $objResult['work_county'];?>" maxlength="30" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>รหัสไปรษณีย์</label>
                        <input type="text" id="work_post" name="work_post" class="form-control" placeholder="" value="<?php echo $objResult['work_post'];?>" maxlength="10" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div>  
                    <div class="col-md-6">
                        <label>โทรศัพท์</label>
                        <input type="text" id="work_phone" name="work_phone" class="form-control" placeholder="" value="<?php echo $objResult['work_phone'];?>" maxlength="15" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>โทรสาร</label>
                        <input type="text" id="work_number" name="work_number" class="form-control" placeholder="" value="<?php echo $objResult['work_number'];?>" maxlength="15" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 
                    <div class="col-md-6">
                        <label>จดหมายอิเล็กทรอนิกส์(Email)</label>
                        <input type="text" id="work_email" name="work_email" class="form-control" placeholder="" value="<?php echo $objResult['work_email'];?>" maxlength="50" onChange="form_autosave('<?php echo $id;?>','<?php echo $table ?>','<?php echo $where_f ?>',this)" required />
                    </div> 

                    </div><!-- /.row -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            
    </div>

</section>
</body>
<?php include("script.php");?>

<script>
    $('#birthday').datepicker({
        autoclose: true
    })

    function cal_age(){
        var dayBirth = $("#birthday").val();
        var dayBirth_arr = dayBirth.split("-");

        var d = new Date();
        var y = d.getFullYear();

        var age_now = parseInt(y) - parseInt(dayBirth_arr[0]);
             
        $("#age").val(age_now);  
        $("#age").trigger("change");
     }
     

</script>
</html>