<?php 

$mysqli = new mysqli("localhost","root","","tesap");

class user
{
	public $koneksi;
	function __construct($mysqli)
	{
		$this->koneksi = $mysqli;
	}

	function save_ikuti($id_kampus,$id_user)
	{
		$this->koneksi->query("INSERT INTO user_followed_kampus (id, id_kampus, id_user) VALUES ('', '$idkampus', '$userid');");
		return 'sukses';
	}

}


$user = new user($mysqli);
?>