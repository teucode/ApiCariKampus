<?php
include 'koneksi.php';
$userid=$_SESSION["userid"];
?>
<?php
    $sql = "INSERT INTO user_followed_kampus (id, id_kampus, id_user)
    VALUES ('', '$_POST[idkampus]', '$userid')";
    
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Berhasil mengikuti!');</script>";
			echo "<script>location='kampusDiikuti.php';</script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
?>