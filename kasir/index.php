<?php
include './koneksi.php';

session_start();
$_SESSION['role'] = 'pembeli';

// Cek nilai sesi
if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // Jika sesi sama dengan "admin", arahkan ke halaman admin
    header("Location: admin/login.php");
    exit();
} elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'pembeli') {
    // Jika sesi sama dengan "pembeli", arahkan ke halaman pembeli
    header("Location: pembeli/pembeli.php");
    exit();
} else {
    // Jika sesi tidak terdefinisi atau tidak sesuai dengan kriteria yang ditentukan, arahkan ke halaman default atau tampilkan pesan kesalahan
    header("Location: pembeli/pembeli.php");
    exit();
}