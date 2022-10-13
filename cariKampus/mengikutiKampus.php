<?php 
include 'koneksi.php';
include 'class.php'
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["userid"] = 1;
$userid = $_SESSION["userid"];
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<div class="container">
		<h1>Data Kampus</h1><br>
		<form action="mengikutiKampus.php" method="get">
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
		<form action="insertfav.php" method="post">
		<table class="table table-bordered">
			<thead><br>
				<tr>
					<th>Nama Kampus</th>
					<th>Alamat</th>
					<th>Jenis PT</th>
					<th>Akreditasi</th>
					<th>Status</th>
					<th>Logo</th>
                    <th>Opsi</th>
				</tr>
			</thead>
			<tbody>
			<?php 
                ///API MENAMPILKAN KAMPUS YANG BELUM DIIKUTI
				if(isset($_GET['cari'])){
					$cari = $_GET['cari'];
					$data = mysqli_query($conn, "SELECT id_kampus, nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto from list_kampus 
												where id_kampus not in (select id_kampus from user_followed_kampus)
												and nama_kampus like '%".$cari."%'") or die( mysqli_error($conn));				
				}else {
					$data = mysqli_query($conn, "SELECT id_kampus, nama_kampus, alamat, jenis_pt, akreditasi, `status`, foto from list_kampus
                                                where id_kampus not in (select id_kampus from user_followed_kampus)")
                                                or die( mysqli_error($conn));
				}
				$no = 1;
				while($value = mysqli_fetch_array($data) or die( mysqli_error($conn))) {
				?>
					<tr>
						<input type="hidden" id="idkampus" name="idkampus" value=<?php echo $value["id_kampus"]; ?>>
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
						<td><input type="submit" name="ikuti" value="Ikuti"></td>
					</td>
				</tr>
				<?php } ?>
				</form>
				
			</tbody>
			
		</table>
		
	</div>

</body>
</html>