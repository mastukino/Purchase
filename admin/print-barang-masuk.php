<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM barang_masuk ORDER BY kode_barang");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

?>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
	<div class="center">
		<h2>ICT - PT. Mercon</h2>
		<h3>Data Barang Keluar</h3>
	</div>
<table class="table">
  <thead class="thead bg-info">
    <tr>
      <th>No</th>
      <th>ID</th>
      <th>Tanggal</th>
      <th>Kapal/Bengkel</th>
      <th>Supplier</th>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Nominal</th>
      <th>Qty</th>
      <th>Satuan</th>
    </tr>
  </thead>
  <?php 
			$no = 1;
 
			if(isset($_GET['tanggal'])){
					$tgl = $_GET['tanggal'];
					$sql = mysqli_query($koneksi,"select * from barang_masuk where tanggal='$tgl'");
				}elseif(isset($_GET['bulan'])){
					$bulan = $_GET['bulan'];
					$sql=mysqli_query($koneksi, "select * from barang_masuk where month(tanggal)='$bulan'");
				}elseif(isset($_GET['tahun'])){
					$tahun = $_GET['tahun'];
					$sql=mysqli_query($koneksi, "select * from barang_masuk where year(tanggal)='$tahun'");
				}else{
					$sql = mysqli_query($koneksi,"select * from barang_masuk");
				}
			
			while($data = mysqli_fetch_array($sql)){
			?>
		  <tr>
				<td><?php echo $no++; ?></td>
		    <td><?php echo $data['id']; ?></td>
		    <td><?php echo $data['tanggal']; ?></td>
		    <td><?php echo $data['kapal']; ?></td>
		    <td><?php echo $data['supplier']; ?></td>
		    <td><?php echo $data['kode_barang']; ?></td>
		    <td><?php echo $data['nama_barang']; ?></td>
		    <td><?php echo $data['nominal']; ?></td>
		    <td><?php echo $data['stok']; ?></td>
		    <td><?php echo $data['satuan']; ?></td>
		  </tr>
		  <?php 
			}
			?>

</table>
<script>
window.print()
</script>