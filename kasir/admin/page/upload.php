<?php
require('koneksi.php');

$jenis  = "";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['Harga'];
    $foto = $_FILES['foto']['tmp_name'];

    // Baca file gambar menjadi string
    $data = file_get_contents($foto);

    // Escape string data
    $data = $koneksi->real_escape_string($data);

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO pesanan (nama, deskripsi, jenis, foto, harga) VALUES ('$nama', '$deskripsi', '$jenis', '$data', '$harga')";

    if ($koneksi->query($query) === TRUE) {
        echo "Data berhasil disimpan.";
        header("Location:../admin/admin.php?menu=menu1");
    } else {
        echo "Terjadi kesalahan: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Gambar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Tambahakan menu</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <select class="form-control" name="jenis" id="fakultas">
                    <option value="">- Pilih Jenis -</option>
                    <option value="Minuman" <?php if ($jenis == "Minuman") echo "selected" ?>>Minuman</option>
                    <option value="Makanan" <?php if ($jenis == "Makanan") echo "selected" ?>>Makanan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="floatInput" class="form-label">Bilangan Harga:</label>
                <input type="number" step="any" class="form-control" id="floatInput" name="Harga" placeholder="Masukkan bilangan float">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>