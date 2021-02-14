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
<?php
// include database connection file
include_once("../config.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{ 
  $id = $_POST['id'];
  $kode=$_POST['kode_barang'];
  $nama_barang=$_POST['nama_barang'];
  $kapal=$_POST['kapal'];
  $tanggal=$_POST['tanggal'];
  $supplier=$_POST['supplier'];
  $nominal=$_POST['nominal'];
  $stok=$_POST['stok'];
  $satuan=$_POST['satuan'];
    
  // update user data
  $result = mysqli_query($koneksi, "UPDATE barang_masuk SET kode_barang='$kode',nama_barang='$nama_barang',tanggal='$tanggal',kapal='$kapal',supplier='$supplier',nominal='$nominal',stok='$stok',satuan='$satuan' WHERE id=$id");
  $result2 = mysqli_query($koneksi, "UPDATE gudang SET kode_barang='$kode',nama_barang='$nama_barang',tanggal='$tanggal',kapal='$kapal',supplier='$supplier',nominal='$nominal',stok='$stok',satuan='$satuan' WHERE id=$id");
  
  // Redirect to homepage to display updated user in list
  header("Location: barangmasuk.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];
 
//$result = mysqli_query($koneksi, "SELECT * FROM barang_masuk WHERE id=$id");
 
$sql_cek = "SELECT * FROM barang_masuk WHERE id='".$_GET['id']."'";
$query_cek = mysqli_query($koneksi, $sql_cek);
$user_data = mysqli_fetch_object($query_cek);

//while($user_data = mysqli_fetch_object($result))
//{
//  $kode = $user_data->kode_barang;
//  $nama_barang = $user_data->nama_barang;
//  $tanggal = $user_data->tanggal;
//  $kapal = $user_data->kapal;
//  $supplier = $user_data->supplier;
//  $nominal = $user_data->nominal;
//  $stok = $user_data->stok;
//  $satuan = $user_data->satuan;
//}
//echo "<script>alert('$nama_barang');</script>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.ico">
	<!--Import Google Icon Font-->
    <link href="../fonts/material.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
	       /* label color */
	       .e-input-field label {
	         color: #000;
	       }
	       /* label focus color */
	       .e-input-field input[type=text]:focus + label,.e-input-field input[type=password]:focus + label {
	         color: #d32f2f !important;
	       }
	       /* label underline focus color */
	       .e-input-field input[type=text]:focus,.e-input-field input[type=password]:focus {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* valid color */
	       .e-input-field input[type=text].valid,.e-input-field input[type=password].valid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* invalid color */
	       .e-input-field input[type=text].invalid,.e-input-field input[type=password].invalid {
	         border-bottom: 1px solid #d32f2f !important;
	         box-shadow: 0 1px 0 0 #d32f2f !important;
	       }
	       /* icon prefix focus color */
	       .e-input-field .prefix.active {
	         color: #d32f2f !important;
	       }
	    </style>
</head>
<body>
	<div class="row">
		<!--header-->
		<header>
			<!--TopNav-->
	        <nav class="row top-nav blue darken-2">
	    		<div class="container">
	    			<div class="col offset-l2 nav-wrapper">
	    				<a href="#" data-activates="slide-out" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
	    				<a class="page-title">Edit Barang Masuk</a>
	    			</div>
	    		</div>
			</nav>

			<!--Sidenav-->
			<ul id="slide-out" class="side-nav fixed">
	            
	            <li class="no-padding">
		            <ul class="collapsible collapsible-accordion">
		                <li>
		                	<div class="user-view">
		                    	<div class="background" style="margin-bottom:-15%;">
		                    		<img src="../images/1bg.jpg">
		                    	</div>
		                		<span class="white-text name"><?php echo $nama; ?><i class="material-icons left">account_circle</i></span>
		                	</div>
		                </li>
		                
		                <li><div class="divider" style="margin-top:15%;"></div></li>

		                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>

		                <li>
		                	<a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
		                	<div class="collapsible-body">
		                		<ul>
		                			<li><a>User</a></li>
									<li class="active blue darken-4"><a href="barangmasuk.php">Barang Masuk</a></li>
									<li><a href="gudang.php">Gudang</a></li>
									<li><a href="barangkeluar.php">Barang Keluar</a></li>
								</ul>
							</div>
		                </li>

		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container">
				<div class="col s12 m12 l10 offset-l3"> <br>
					<!--table-->
				<form action="" method="post" name="form1">
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom isian table-->
							<tr>
					        	<td>Kode Barang</td>
					        	<td><input type="text" name="kode_barang" value=<?php echo $user_data->kode_barang; ?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Nama Barang</td>
					        	<td><input type="text" name="nama_barang" value=<?php echo $user_data->nama_barang; ?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Tanggal</td>
					        	<td><input type="date" name="tanggal" value=<?php echo $user_data->tanggal;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Kapal/Bengkel</td>
					        	<td><input type="text" name="kapal" value=<?php echo $user_data->kapal;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Supplier</td>
					        	<td><input type="text" name="supplier" value=<?php echo $user_data->supplier;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Nominal</td>
					        	<td><input type="number" name="nominal" value=<?php echo $user_data->nominal;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Jumlah</td>
					        	<td><input type="number" name="stok" value=<?php echo $user_data->stok;?>></td>
					      	</tr>
					      	<tr> 
					        	<td>Satuan</td>
					        	<td><input type="text" name="satuan" value=<?php echo $user_data->satuan;?>></td>
					      	</tr>
					      	<tr>
				            	<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				            </tr>
					      	</table>
					      	<table>
				            <tr>
				            	<th>
				            		<input type="submit" name="update" value="Edit Barang" class="right waves-effect waves-light btn blue darken-2" style="float: left;">
				            	</th>
				            	<th style="width: 1%;">
				            		<a href="barangmasuk.php"><input type="button" value="Kembali" class="right waves-effect waves-light btn red darken-2"></a> 
				            	</th>
				            </tr>
				        </table>
					</div>
				</form>
				</div>
			</div>
		</main>
        <!--end of content-->

	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	    	$('.collapsible').collapsible();
	    	$(".button-collapse").sideNav();
		});
	</script>
</body>
</html>