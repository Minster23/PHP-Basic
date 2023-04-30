<?php
require('../koneksi.php');

$Profil     = "";
$Visi    = "";
$Misi  = "";
$Jumlah_siswa = "";
$sukses = "";
$error = "";



if (isset($_POST['simpan'])) {
    $profil     = $_POST['Profil'];
    $visi    = $_POST['Visi'];
    $misi  = $_POST['Misi'];
    $Jumlah_siswa  = $_POST['jumlah_siswa'];

    $query_cek = "SELECT * FROM tb_kontenwebdepan WHERE id = '1'";
    $hasil_cek = mysqli_query($conn, $query_cek);


    if ($profil && $visi && $misi) {
        if ($hasil_cek === false) {

            echo "Error: " . mysqli_error($conn);
        } else {
            if (mysqli_num_rows($hasil_cek) > 0) {
                //jika row sudah diisi, lakukan query UPDATE untuk memperbarui data di dalam row tersebut
                $query_update = "UPDATE tb_kontenwebdepan SET Profil = '$profil', Visi = '$visi', Misi = '$misi', jumlah_siswa = '$Jumlah_siswa'  WHERE id = '1'";
                mysqli_query($conn, $query_update);
            } else {
                //jika row belum diisi, lakukan query INSERT untuk menambahkan data ke dalam row tersebut
                $query_insert = "INSERT INTO tb_kontenwebdepan (Profil, Visi, Misi,jumlah_siswa) VALUES ('$profil', '$visi', '$misi', '$Jumlah_siswa ')";
                mysqli_query($conn, $query_insert);
            }
        }
    }
    if ($Jumlah_siswa) {
        // Input nilai siswa
        $input = $_POST['jumlah_siswa'];

        // Memisahkan nilai siswa menjadi array berdasarkan spasi
        $nilai = explode(" ", $input);

        // Mengubah setiap nilai menjadi string yang dikelilingi oleh tanda kutip tunggal
        $nilai_str = array_map(function ($n) {
            return "'" . $n . "'";
        }, $nilai);

        // Menggabungkan setiap nilai yang telah diubah menjadi string dengan pemisah koma
        $nilai_gabung = implode(", ", $nilai_str);
        echo $nilai_gabung;

        $query_update = "UPDATE tb_kontenwebdepan SET jumlah_siswa = '$nilai_gabung '  WHERE id = '1'";
        mysqli_query($conn, $query_update);
    } else {
        // Mulai output buffering
        ob_start();

        // Include file A.php
        include '../index.php';

        // Ambil nilai variabel $nama menggunakan variable parsing
        $nama = ${'nilai_gabung'};


        // Gunakan variabel $nama
        echo $nama;
        $query_update = "UPDATE tb_kontenwebdepan SET jumlah_siswa = '$nama '  WHERE id = '1'";
        mysqli_query($conn, $query_update);

         // Hentikan output buffering dan hapus buffer
         ob_end_clean();
    }
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="chart.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-K1Tcq0MV9/v88P0vS8WlUw7/0nE6gzZ7VExDQ6dG7VFXnk9Npwn7xuIzr/aYiuzDBKGf15Zg5c5F58Gr3mWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <div class="card mx-auto" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <!-- tombol untuk memunculkan modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Buka Modal
                </button>

                <!-- modal window -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php
                                if ($error) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error ?>
                                    </div>
                                <?php
                                    header("refresh:1;url=admin.php");
                                }
                                ?>

                                <?php
                                if ($sukses) {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $sukses ?>
                                    </div>
                                <?php
                                    header("refresh:1;url=admin.php");
                                }
                                ?>
                                <form action="" method="POST">
                                    <div>
                                        <div class="mb-3">
                                            <label for="nim" class="form-label">Profil</label>
                                            <input class="form-control" id="nim" name="Profil" value="<?php echo $Profil ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Visi</label>
                                            <textarea class="form-control" id="nama" name="Visi" value="<?php echo $Visi ?>"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Misi</label>
                                            <textarea class="form-control" id="alamat" name="Misi" value="<?php echo $Misi ?>"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Nilai siswa</label>
                                            <input class="form-control" id="jumlah_siswa" name="jumlah_siswa" value="<?php echo $Jumlah_siswa ?>">
                                        </div>
                                    </div>
                                    <div class="col12">
                                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" </div>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="list-group-item">
                <!-- tombol untuk memunculkan modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Artikel">
                    Buat artikel
                </button>

                <!-- modal window -->
                <div class="modal fade" id="Artikel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat artikel baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php require('page.php'); ?>
                            </div>
                            <div class="modal-footer">
                                <p>Buat artikel baru</p>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
            <li class="list-group-item">

            </li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>