<?php
$host    = "localhost";
$user    = "root";
$pass    = "";
$db    = "DB_kasir";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    //cek koneksi
    die("Invalid connect to database");
} else {

}