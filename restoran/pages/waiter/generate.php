<?php 
  require('../koneksi.php');
  session_start();
  if(!($_SESSION['lvl'] === 'waiter')){
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

  $sql = "SELECT transaksi.id_transaksi as id,user.username,masakan.nama_masakan,detail_oder.qty,transaksi.total_bayar FROM transaksi INNER JOIN user USING(id_user) INNER JOIN oder USING(id_oder) INNER JOIN detail_oder USING(id_oder) INNER JOIN masakan USING(id_masakan)";
  $exe = mysqli_query($koneksi,$sql);
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporanPenjualanRestoran.xls");
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kasir Restoran | Generate Laporan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
</head>
<body>

  <table border="1">
    <tr>
      <th>Id</th>
      <th>Pemesan</th>
      <th>Masakan</th>
      <th>Qty</th>
      <th>Total bayar</th>
    </tr>
    <?php 
      $i = 1;
      while ($res = mysqli_fetch_array($exe)) :
      ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $res['username'] ?></td>
      <td><?= $res['nama_masakan'] ?></td>
      <td><?= $res['qty'] ?></td>
      <td><?= $res['total_bayar'] ?></td>
    </tr>
    <?php 
      $i++;endwhile;
      ?>
  </table>
            
</body>
</html>
