<?php
$host    = "localhost";
$user    = "root";
$pass    = "123456789";
$db    = "praktik";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    //cek koneksi
    die("Invalid connect to database");
} else {
    //echo "Succses connect database";
}
