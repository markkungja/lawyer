<?php
session_start();
ob_start();
if(isset($_SESSION['USERNAME'])){
    header("Location:../index.php");
} else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <?php include("head.php");?>
    <title>Lawyer System. | Log in</title>

    <style>
        body {
            height: auto;
            background-image: url("../dist/img/bg/blur-background.jpg");
            background-attachment: fixed;
            background-size: cover;
        }

    </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
  <div class="login-logo">
    <a ><b>Login</b> Tarnine</a>
  </div>
  <p class="login-box-msg text-red" id="message">&nbsp;</p>

    <form id="login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
<?php include("script.php");?>
<script>
$(document).ready(function(){
	formPost('login');
})
</script>
</html>
<?php
}
?>
