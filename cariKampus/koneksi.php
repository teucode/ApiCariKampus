<?php 
$conn = new mysqli("localhost","root","","tesap");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
session_start();
$_SESSION["userid"]=1;
?>