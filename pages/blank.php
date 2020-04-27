<?php
session_start();
ob_start();
$_SESSION['PAGE'] = 'blank.php';
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
    Blank
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="active">Blank</span></a></li>
    <li class="active">Blank Page</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

blank page

</section>
</body>
<?php include("script.php");?>
</html>