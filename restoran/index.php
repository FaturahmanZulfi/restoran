<?php 
  require('pages/koneksi.php');

  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT *  FROM user INNER JOIN lvl ON user.id_lvl=lvl.id_lvl WHERE user.username='$username' AND user.password='$password'";
    $exe = mysqli_query($koneksi,$sql);
    $res = mysqli_fetch_array($exe);
    if($res === null){
      $pesan = "Username atau Password salah";
    }else{
      session_start();
      if ($res['nama_lvl'] == 'administrator'){
        $_SESSION['lvl'] = $res['nama_lvl'];
        $_SESSION['nama'] = $res['username'];
        $_SESSION['id_user'] = $res['id_user'];
        header('Location:pages/administrator/');
      }else if ($res['nama_lvl'] == 'waiter'){
        $_SESSION['lvl'] = $res['nama_lvl'];
        $_SESSION['nama'] = $res['username'];
        $_SESSION['id_user'] = $res['id_user'];
        header('Location:pages/waiter/');
      }else if ($res['nama_lvl'] == 'kasir') {
        $_SESSION['lvl'] = $res['nama_lvl'];
        $_SESSION['nama'] = $res['username'];
        $_SESSION['id_user'] = $res['id_user'];
        header('Location:pages/kasir/');
      }else if ($res['nama_lvl'] == 'owner'){
        $_SESSION['lvl'] = $res['nama_lvl'];
        $_SESSION['nama'] = $res['username'];
        $_SESSION['id_user'] = $res['id_user'];
        header('Location:pages/owner/');
      }else if ($res['nama_lvl'] == 'pelanggan'){
        $_SESSION['lvl'] = $res['nama_lvl'];
        $_SESSION['nama'] = $res['username'];
        $_SESSION['id_user'] = $res['id_user'];
        header('Location:pages/pelanggan/');
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kasir Restoran | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index.html"><b>KASIR RESTORAN</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="padding: 30px 30px">
    <?php 
      if(isset($pesan)){
    ?>
      <p class="login-box-msg"><?= $pesan; ?></p>
    <?php 
      }
     ?>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
