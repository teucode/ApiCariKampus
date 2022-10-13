<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tampil Data Kampus</title>
</head>
<body>
	<div class="container">
		<h1>Data Kampus</h1><br>
		<form action="tampilKampusBrdsrKategori.php" method="get">
			<label>Kategori</label><br>
			<input type="submit" name="kategori" value="Negeri">
			<input type="submit" name="kategori" value="Swasta">
			<input type="submit" name="kategori" value="Politeknik">
			<input type="submit" name="kategori" value="PTN-BLU">
			<input type="submit" name="kategori" value="PTN-BH">
			<input type="submit" name="kategori" value="Kedinasan">
		</form><br>
		<?php 
			if(isset($_GET["kategori"])){
				$cari = $_GET["kategori"];
				echo "<b>Kategori : ".$cari."</b>";
			}
		?><br>
		<table class="table table-bordered">
			<thead><br>
				<tr>
					<th>Nama Kampus</th>
					<th>Alamat</th>
					<th>Jenis PT</th>
					<th>Akreditasi</th>
					<th>Status</th>
					<th>Logo</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				if(isset($_GET["kategori"])){
					$cari = $_GET["kategori"];
					$data = mysqli_query($conn, "SELECT nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto from list_kampus where jenis_pt = '$cari'") or die( mysqli_error($conn));				
				}else {
					$data = mysqli_query($conn, "SELECT nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto from list_kampus") or die( mysqli_error($conn));
				}
				while($value = mysqli_fetch_array($data) or die( mysqli_error($conn))) {
				?>
					<tr>
						<td><?php echo $value["nama_kampus"]; ?></td>
						<td><?php echo $value["alamat"]; ?></td>
						<td><?php echo $value["jenis_pt"]; ?></td>
						<td><?php echo $value["akreditasi"]; ?></td>
						<td><?php echo $value["status"]; ?></td>
						<?php
								$img = 'data:image/jpeg;base64,'
									. base64_encode( $value['foto'] );
						?>
						<td style='padding-right: 2em;'>
							<img src="<?php echo $img; ?>"
							style="width: 190px; height: 200px;"
							/>
						</td>
						<td>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			
		</table>
		
	</div>

</body>
</html>