<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY nik DESC");

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
<h2 class="text-center">ICT - PT. Mercon</h2>
<h3 class="text-center">Data User</h3>
<div class="row">
  <div class="col-6">
  
  </div>
  <div class="col-6">
  
  </div>
</div>
<br/>
<table class="table">
  <thead class="bg-info">
    <tr>
      <th hidden>ID</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Telepon</th>
      <th>Status</th>
      <th>Divisi</th>
      <th>LOKER</th>
    </tr>
  </thead>
  <!--kolom header table-->
  <tbody>
  <?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['nama']; 
				                echo "<tr>";
			                    echo "<td hidden>".$user_data['id']."</td>";
				                echo "<td> <h6>".$user_data['nik']."</h6></td>";
				                echo "<td> <h6>".$user_data['nama']."</h6> </td>";
				                echo "<td> <h6>".$user_data['alamat']."</h6> </td>";
				                echo "<td><h6>".$user_data['telepon']."</h6></td>";
			                    echo "<td><h6>".$user_data['level']."</h6></td>"; 
			                    echo "<td><h6>".$user_data['divisi']."</h6></td>"; 
			                    echo "<td><h6>".$user_data['loker']." </h6></td>";  
				            }

							?>

  </tbody>
</table>
<script>
window.print()
</script>