<?php
include 'koneksi.php';


// Proses penghapusan jika parameter 'op' diterima
if (isset($_GET['op']) && $_GET['op'] === 'hapus' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Query untuk menghapus data pesanan berdasarkan ID
    $deleteQuery = "DELETE FROM pesanan WHERE id = '$id'";
    if ($koneksi->query($deleteQuery) === TRUE) {
        echo "Data dengan ID $id berhasil dihapus.";
    } else {
        echo "Terjadi kesalahan saat menghapus data: " . $koneksi->error;
    }
}

// Query untuk mendapatkan data pesanan dari database dengan urutan ID
$query = "SELECT * FROM pesanan ORDER BY id ASC";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <?php require 'upload.php'; ?>
    </div>

    <div class="container">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $deskripsi = $row['deskripsi'];
                    $jenis = $row['jenis'];
                    $harga = $row['harga'];
                    $foto = base64_encode($row['foto']);

                    echo '<div class="col">';
                    echo '<div class="card" style="width: 18rem;">';
                    echo "<img src='data:image/jpeg;base64,$foto' class='img-fluid' alt='Foto Pesanan'>";
                    echo '<div class="card-body">';
                    echo "<h5 class='card-title'>$nama</h5>";
                    echo "<p class='card-text'>$deskripsi</p>";
                    echo "<h6>Jenis <span class='badge bg-secondary'>$jenis</span></h6>";
                    echo "<h6>Harga <span class='badge bg-secondary'>$harga</span></h6>";
                    echo "<a href='admin.php?menu=menu1&op=hapus&id=$id' class='btn btn-danger'>Hapus</a>";
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo 'Tidak ada menu.';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>

</html>