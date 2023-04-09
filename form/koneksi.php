<?php

$koneksi = mysqli_connect("localhost", "root", "123456789", "latihan");
if (!$koneksi) {
	die ('Gagal terhubung MySQL: ' . mysqli_connect_error());	
}
?>