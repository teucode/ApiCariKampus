
<?php 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["userid"] = 1;
?>

<div class="container">
		<h1>Data Kampus yang Diikuti</h1><br>
		<form action="kampusDiikuti.php" method="get">
			<label>Cari Kampus :</label>
			<input type="text" name="cari">
			<input type="submit" value="Cari">
		</form><br>
		<?php 
			if(isset($_GET['cari'])){
				$cari = $_GET['cari'];
				echo "<b>Hasil pencarian : ".$cari."</b>";
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
				///MENAMPILKAN DAFTAR KAMPUS YANG DIIKUTI OLEH USER
                $userid=$_SESSION["userid"];
				if(isset($_GET['cari'])){
					$cari = $_GET['cari'];
					$data = mysqli_query($conn, "SELECT nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto from list_kampus where nama_kampus like '%".$cari."%'") or die( mysqli_error($conn));				
				}else {
					$data = mysqli_query($conn, "SELECT nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto 
                                                from list_kampus l join user_followed_kampus f on l.id_kampus = f.id_kampus
                                                where id_user = $userid")
                                                or die( mysqli_error($conn));
				}
				$no = 1;
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