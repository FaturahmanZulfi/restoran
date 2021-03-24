<?php 
  require('../koneksi.php');
  session_start();
  if(!($_SESSION['lvl'] === 'administrator')){
    header("Location:../../");
  }else{
    $nama = $_SESSION['nama'];
    $lvl = $_SESSION['lvl'];
    $id_user = $_SESSION['id_user'];
  }

  if(ISSET($_POST['logout'])){
    session_destroy();
    header('Location:../../');
  }
  if(ISSET($_POST['pesan'])){
    $makanan = $_POST['masakan'];
    $banyak = $_POST['banyak_masakan'];
    $keterangan = $_POST['keterangan'];

    $sql = "SELECT MAX(id_oder) FROM oder";
    $exe = mysqli_query($koneksi,$sql);
    $res = mysqli_fetch_array($exe);
    if ($res['MAX(id_oder)'] === null) {
      $id_oder = 1;
    }else{
      $id_oder = $res['MAX(id_oder)']+1;
    }

    $sqlb = "INSERT INTO oder VALUES ('$id_oder',null,CURRENT_TIMESTAMP,'$id_user','$keterangan','belum dibayar')";
    $exeb = mysqli_query($koneksi,$sqlb);
    if($exeb){
      $sqlc = "INSERT INTO detail_oder VALUES (null,'$id_oder','$makanan','$banyak','$keterangan','belum dibayar')";
      $exec = mysqli_query($koneksi,$sqlc);
      if($exec){
        $pesan = '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Order Berhasil</h4>
          </div>';
      }else{
        $pesan =mysqli_error($koneksi)."<br/>";
      }
    }else{
      $pesan =mysqli_error($koneksi)."<br/>";
    }
  }else{
    $pesan ="";
  }

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kasir Restoran | Entri Order</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KASIR</b> RESTORAN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <span class="hidden-xs"><?= $nama ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <i class="fa fa-user fa-5x" style="color: #fff;"></i>
                <p>
                  <?= $nama ?>
                  <small><?= $lvl ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div>
                  <form method="POST">
                    <input type="submit" class="btn btn-block btn-flat" name="logout" value="Log Out">
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <i class="fa fa-user fa-4x" style="color: #fff;"></i>
        </div>
        <div class="pull-left info">
          <p><?= $nama ?></p>
          <a><?= $lvl ?></a>
        </div>
      </div> -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="generate_laporan.php">
            <?php 
              $sql_ = "SELECT transaksi.id_transaksi as id,transaksi.id_oder,user.username,masakan.nama_masakan,detail_oder.qty,transaksi.tanggal,transaksi.total_bayar FROM transaksi INNER JOIN user USING(id_user) INNER JOIN oder USING(id_oder) INNER JOIN detail_oder USING(id_oder) INNER JOIN masakan USING(id_masakan)";
              $exe_ = mysqli_query($koneksi,$sql_);
              $row_ = mysqli_num_rows($exe_);
              if($row_ === 0){
                $ntf_ = '';
              }else{
                $ntf_ = $row_;
              }
             ?>
            <i class="fa fa-bar-chart"></i> <span>Generate Laporan</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-blue"><?= $ntf_ ?></small>
            </span>
          </a>
        </li>
        <li>
          <a href="entri_transaksi.php">
            <?php 
              $sql_1 = "SELECT oder.id_oder,oder.id_user,oder.tanggal,masakan.nama_masakan,masakan.harga,detail_oder.qty,oder.status_oder FROM oder INNER JOIN detail_oder USING (id_oder) INNER JOIN masakan USING(id_masakan) WHERE oder.status_oder = 'belum dibayar'";
              $exe_1 = mysqli_query($koneksi,$sql_1);
              $row_1 = mysqli_num_rows($exe_1);
              if($row_1 === 0){
                $ntf_1 = '';
              }else{
                $ntf_1 = $row_1;
              }
             ?>
            <i class="fa fa-book"></i> <span>Entri Transaksi</span>
            <span class="pull-right-container">
              <span class="label pull-right bg-blue"><?= $ntf_1 ?></span>
            </span>
          </a>
        </li>
        <li class="active">
          <a href="entri_order.php">
            <i class="fa fa-commenting"></i> <span>Entri Order</span>
          </a>
        </li>
        <li>
          <a href="register.php">
            <i class="fa fa-user-plus"></i> <span>Register</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Entri Order
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <?= $pesan ?>
          <h3 class="box-title">Order Makanan</h3>
        </div>
        <!-- /.box-header -->
        <form method="POST">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Pilih Makanan</label>
                  <select name="masakan" class="form-control select2" style="width: 100%;" required>
                    <?php 
                    $sql = "SELECT * FROM masakan";
                    $exe_masakan = mysqli_query($koneksi,$sql);
                      while ( $res_masakan = mysqli_fetch_array($exe_masakan)) :
                    ?>
                    <option value="<?= $res_masakan['id_masakan'] ?>"><?= $res_masakan['nama_masakan'] ?></option>
                    <?php 
                      endwhile;
                     ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Banyak Makanan Yang Dipesan</label>
                  <select name="banyak_masakan" class="form-control select2" style="width: 100%;" required>
                    <?php 
                      for ($i=1; $i <= 10; $i++) { 
                    ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                    <?php 
                      }
                     ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" rows="3" placeholder="Keterangan" required></textarea>
            </div>
            <input type="submit" class="btn btn-block btn-primary btn-lg" name="pesan" value="Pesan">
          </div>
        </form>

        <div class="box-footer">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Daftar Nama makanan</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th>ID</th>
                    <th>Nama Makanan</th>
                    <th>Harga</th>
                    <th>Status Masakan</th>
                  </tr>
                  <?php                     
                    $sql = "SELECT * FROM masakan";
                    $exe = mysqli_query($koneksi,$sql);
                    while ( $res_mskn = mysqli_fetch_array($exe)) :
                   ?>
                  <tr>
                    <td><?= $res_mskn['id_masakan'] ?></td>
                    <td><?= $res_mskn['nama_masakan'] ?></td>
                    <td>Rp.<?= $res_mskn['harga'] ?></td>
                    <td><span class="label label-success"><?= $res_mskn['status_masakan'] ?></span></td>
                  </tr>
                  <?php 
                    endwhile;
                   ?>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>