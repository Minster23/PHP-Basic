<?php
$host    = "localhost";
$user    = "root";
$pass    = "";
$db    = "db_toko";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    //cek koneksi
    die("Invalid connect to database");
} else {
    //echo "Succses connect database";
}


?>
<!-- add icon link -->
<link rel="icon" href="https://yt3.googleusercontent.com/ytc/AGIKgqN4BTiXwhZwdWiPMOJZxVgzSCtyLU5EeTubdaP8TQ=s900-c-k-c0x00ffffff-no-rj" type="image/x-icon">