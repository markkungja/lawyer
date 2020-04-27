<?php
session_start();
ob_start();

include("../connect/database.php");
$conDB = new db_conn();

$doc_file_id = $conDB->sqlEscapestr($_GET['doc_file_id']);
$doc_id = $conDB->sqlEscapestr($_GET['doc_id']);


$_SESSION['PAGE'] = "../pages/filedoc_notis_edit.php?doc_id='$doc_id'&doc_file_id=".$doc_file_id;

$strSQL = "SELECT * FROM `document_filedoc` WHERE `doc_file_id` = '$doc_file_id' ORDER BY `doc_file_date` DESC";
$numrow = $conDB->sqlNumrows($strSQL);
if($numrow == 0){
    ?><script>window.history.back();</script><?php
}
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
    เอกสาร
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">Blank</span></a></li>
    <li class="active">Blank Page</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<button type="button" class="btn btn-app flat" onClick="testget()" title="save">
    <img src="../dist/img/icon/save.svg" width="20"><br>
    Save
</button>
<button type="button" class="btn btn-app flat"  onClick="goHref('../pages/notis_edit.php?act=edit&id=<?php echo $objResult['doc_id']?>')">
    <img src="../dist/img/icon/multiply.svg" width="20"><br>
    Discard
</button>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">รายชื่อจำเลย</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
            <div class="row">
                <div class="col-md-6">
                    <label>ชื่อเอกสาร <span class="text-red">*</span></label>
                    <input type="text" id="doc_file_name" name="doc_file_name" class="form-control" placeholder="Document name" value="<?php echo $objResult['doc_file_name'];?>" maxlength="200" onChange="form_autosave('<?php echo $objResult['doc_file_id'];?>','document_filedoc','doc_file_id',this)" required />
                </div> 
            </div>

                <div id="summernote"><?php echo $objResult['doc_file_text']; ?></div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->

</section>
</body>
<?php include("script.php");?>

<script src="../dist/js/popper.min.js"></script>
    <link href="../dist/summernote-bs4.css" rel="stylesheet">
    <script src="../dist/summernote-bs4.js"></script>

<script>
    function testget(){
        var markupStr = $('#summernote').summernote('code');

        var n = '<?php echo $objResult['doc_file_id'];?>';
        var t = 'document_filedoc';
        var tf = 'doc_file_id';
        var v = markupStr;
        var f = 'doc_file_text';

        $.post("../services/autosave.php", {n:n,t:t,tf:tf,v:v,f,f}, function(data){
            console.log(data);
        });

    }
    $('#summernote').summernote({
        placeholder: 'Hello bootstrap 4',
        tabsize: 2,
        height: 400
    });

</script>

</html>