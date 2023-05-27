<?php
require '../config/koneksi.php';

$jenis  = "";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['Harga'];
    $foto = $_FILES['foto']['tmp_name'];
    $jenis = $_POST['selected-fruit'];

    // Baca file gambar menjadi string
    $data = file_get_contents($foto);

    // Escape string data
    $data = $koneksi->real_escape_string($data);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO tb_produk (Nama, Kategori, foto, Harga, deskripsi) VALUES ('$nama', '$jenis', '$data', '$harga', '$deskripsi')";

    if ($koneksi->query($query) === TRUE) {
        echo "Data berhasil disimpan.";
        header('location: http://localhost/apaaja/admin');
    } else {
        echo "Terjadi kesalahan: " . $koneksi->error;
    }
}
?>