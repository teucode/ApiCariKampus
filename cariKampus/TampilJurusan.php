<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tampil Jurusan</title>
</head>
<body>
	<div class="container">
		<h1>Data Jurusan pada Kampus</h1><br>
		<form action="TampilJurusan.php" method="get">
			<label>Cari Kampus :</label>
			<input type="text" name="cari1">
			<input type="submit" value="Cari">
		</form><br>
		<?php 
			if(isset($_GET['cari1'])){
				$cari = $_GET['cari1'];
                $selectnama = mysqli_query($conn, "SELECT nama_kampus from list_kampus where nama_kampus like '%".$cari."%'") or die( mysqli_error($conn));
				$namaKampus = mysqli_fetch_array($selectnama);
                echo "<b>Daftar Jurusan di Kampus : ".$namaKampus['nama_kampus']."</b>";
			}
		?><br>
		<table class="table table-bordered">
			<thead><br>
				<tr>
					<th>Nama Jurusan</th>
					<th>Akreditasi</th>
					<th>Tingkat Keketatan</th>
					<th>Kuota</th>
					<th>Pendaftar</th>
					<th>UKT Minimal</th>
					<th>UKT Maksimal</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				///MENAMPILKAN DAFTAR JURUSAN DARI SEBUAH KAMPUS
				if(isset($_GET['cari1'])){
					$cari1 = $_GET['cari1'];
					$data1 = mysqli_query($conn, "SELECT j.nama_jurusan, j.akreditasi, j.tingkat_keketatan, j.kuota_mhs, j.pendaftar,
                                                j.ukt_minimal, j.ukt_maksimal from list_kampus k join jurusan j on k.id_kampus = j.id_kampus
                                                where k.nama_kampus like '%".$cari1."%' order by j.nama_jurusan") or die( mysqli_error($conn));	
                }else {
					$data1 = mysqli_query($conn, "SELECT j.nama_jurusan, j.akreditasi, j.tingkat_keketatan, j.kuota_mhs, j.pendaftar,
                                                j.ukt_minimal, j.ukt_maksimal from list_kampus k join jurusan j on k.id_kampus = j.id_kampus
                                                order by j.nama_jurusan") 
                                                or die( mysqli_error($conn));
                }
				$no = 1;
				while($value1 = mysqli_fetch_array($data1) or die( mysqli_error($conn))) {
                    ?>
                        <tr>
                            <td><?php echo $value1["nama_jurusan"]; ?></td>
                            <td><?php echo $value1["akreditasi"]; ?></td>
                            <td><?php echo $value1["tingkat_keketatan"]; ?></td>
                            <td><?php echo $value1["kuota_mhs"]; ?></td>
                            <td><?php echo $value1["pendaftar"]; ?></td>
                            <td><?php echo $value1["ukt_minimal"]; ?></td>
                            <td><?php echo $value1["ukt_maksimal"]; ?></td>
                            <td>
                        </td>
                    </tr>
				<?php } ?>
			</tbody>
			
		</table>
		
	</div>

</body>
</html>