<?php
session_start();

// Periksa apakah pengguna telah masuk sesi (logged in)
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Pengguna telah masuk sesi (logged in), hapus data sesi dan arahkan ke halaman login
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
} else {
    // Pengguna belum masuk sesi (not logged in), arahkan ke halaman login
    header("Location: ../index.php");
    exit();
}
?>
