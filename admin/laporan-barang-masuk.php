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
<!DOCTYPE html>
<html>
<head>
	<title>Barang masuk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<link type="text/css" rel="stylesheet" href="../css/style.css"  media="screen,projection"/>
	<style>
		body{
			-webkit-print-color-adjust: exact !important;
		}
	</style>
</head>
<body>
	<br/><br/>
	<div class="row">
		<div class="col">
			<h2>Barang Masuk</h2>
		</div>
		<div class="col text-right">
		  <nav>
		    <div class="nav nav-tabs" id="nav-tab" role="tablist">
		      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-tanggal" role="tab" aria-controls="nav-home" aria-selected="true">tanggal</a>
		      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-bulan" role="tab" aria-controls="nav-profile" aria-selected="false">bulan</a>
		      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-tahun" role="tab" aria-controls="nav-contact" aria-selected="false">tahun</a>
		    </div>
		  </nav>
		  <div class="tab-content" id="nav-tabContent">
		    <div class="tab-pane fade show active" id="nav-tanggal" role="tabpanel" aria-labelledby="nav-home-tab">
					<form method="get">
						<label>PILIH TANGGAL</label>
						<input type="date" name="tanggal">
						<input type="submit" value="FILTER">
					</form>
					<span style="display: none">
						<?php $tgl = $_GET['tanggal']; ?>
					</span>
				</div>
		    <div class="tab-pane fade" id="nav-bulan" role="tabpanel" aria-labelledby="nav-profile-tab">
		      <form method="get">
		        <label>PILIH BULAN</label>
		        <select name="bulan">
		          <option value="01">Januari</option>
		          <option value="02">Februari</option>
		          <option value="03">Maret</option>
		          <option value="04">April</option>
		          <option value="05">Mei</option>
		          <option value="06">Juni</option>
		          <option value="07">Juli</option>
		          <option value="08">Agustus</option>
		          <option value="09">September</option>
		          <option value="10">Oktober</option>
		          <option value="12">November</option>
		          <option value="12">Desember</option>
						</select>
						<span style="display: none">
							<?php $bulan = $_GET['bulan']; ?>
						</span>
		        <input type="submit" value="FILTER">
		      </form>
				</div>
				
		    <div class="tab-pane fade" id="nav-tahun" role="tabpanel" aria-labelledby="nav-contact-tab">
					<form method="get">
						<label for="">PILIH TAHUN</label>
						<select name="tahun">
							<?php
				$mulai= date('Y') - 50;
				for($i = $mulai;$i<$mulai + 100;$i++){
						$sel = $i == date('Y') ? ' selected="selected"' : '';
						echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
				}
				?>
						</select>
						<span style="display: none">
							<?php $tahun = $_GET['tahun']; ?>
						</span>
						<input type="submit" value="FILTER">
					<form>
				</div>
				<?php if($tgl != NULL): ?>
					<a class="btn btn-info" href="print-barang-masuk.php?tanggal=<?php echo $tgl; ?>" target="_blank">Print per hari</a>
				<?php endif ?>
				<?php if($bulan != NULL): ?>
					<a class="btn btn-info" href="print-barang-masuk.php?bulan=<?php echo $bulan; ?>" target="_blank">Print per bulan</a>
				<?php endif ?>
				<?php if($tahun != NULL): ?>
					<a class="btn btn-info" href="print-barang-masuk.php?tahun=<?php echo $tahun; ?>" target="_blank">Print per tahun</a>
				<?php endif ?>
					<a class="btn btn-danger" href="laporan-barang-masuk.php">Reset</a>
		  </div>
		</div>
	</div>
	<br/><br/>
		<center class="container neu">
			<table class="table table-striped">
				<thead class="thead bg-success">
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
		</center>
</body>
</html>