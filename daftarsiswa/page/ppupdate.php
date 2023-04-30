<?php
// Koneksi ke database
require('../koneksi.php');

// Ambil data dari formulir
$foto = $_FILES['foto']['name'];
$foto_tmp = $_FILES['foto']['tmp_name'];

// Pindahkan file ke folder uploads
move_uploaded_file($foto_tmp, "../uploads/" . $foto);

// Simpan data ke database
$query_update = "UPDATE tb_kontenwebdepan SET pt_kepsek = '$foto'  WHERE id = '1'";
mysqli_query($conn, $query_update);
echo "Data berhasil ditambahkan.";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $sql = "SELECT * FROM tb_kontenwebdepan ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $foto = $row['pt_kepsek'];

    ?>
            <div class="col">
                <div class="card">
                    <?php
                    echo "<img class='ard-img-top w-100' src='../uploads/" . $row['pt_kepsek'] . " ' alt='Foto'>";
                    ?></img>
    <?php
        }
    } else {
        echo "Tidak ada data yang ditemukan.";
    }
    mysqli_close($conn);
    header("refresh:1;url=../index.php");
    ?>
</body>

</html>