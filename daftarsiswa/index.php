<?php
require('koneksi.php');
// URL untuk menampilkan lokasi pada Google Maps
$gmap_url = "https://www.google.com/maps/place/Islamic+Junior+High+School+Integrated+Raudhatul+Jannah/@-6.0472934,106.052262,15z/data=!4m6!3m5!1s0x2e418c2c03d7665b:0x40f460d0eba17c9a!8m2!3d-6.0433342!4d106.0607317!16s%2Fg%2F1hm5brw0k";

//query untuk mengambil profil, visi, dan misi dari row
$query = "SELECT Profil, Visi, Misi, jumlah_siswa FROM tb_kontenwebdepan WHERE id = '1'";
$hasil = mysqli_query($conn, $query);

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

//memeriksa apakah query berhasil dijalankan dan mengambil data
if ($hasil === false) {
    //jika query gagal, tampilkan pesan error
    echo "Error: " . mysqli_error($koneksi);
} else {
    //jika query berhasil, ambil data dari hasil query
    $row = mysqli_fetch_assoc($hasil);
    $profil = $row['Profil'];
    $visi = nl2br(htmlspecialchars($row['Visi']));
    $misi = nl2br(htmlspecialchars($row['Misi']));
    $jml_siswa = $row['jumlah_siswa'];
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "delete from tb_forum where id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

session_start();
$_SESSION['login_status'] = 'login_status';
// session_destroy();

////////////////////////////////////////////
// Membuat array nama bulan
$bulan = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
);

// Menggabungkan semua nama bulan dengan tanda koma dan tanda kutip di antara setiap nama bulan
$nama_bulan = "'" . implode("', '", $bulan) . "'";

// Menampilkan semua nama bulan dengan tanda koma dan tanda kutip di antara setiap nama bulan
echo $nama_bulan;

///////////////////////////////////////////////////
// Input nilai siswa
$input = $jml_siswa;

// Memisahkan nilai siswa menjadi array berdasarkan spasi
$nilai = explode(" ", $input);

// Mengubah setiap nilai menjadi string yang dikelilingi oleh tanda kutip tunggal
$nilai_str = array_map(function ($n) {
    return "'" . $n . "'";
}, $nilai);

// Menggabungkan setiap nilai yang telah diubah menjadi string dengan pemisah koma
$nilai_gabung = implode(", ", $nilai_str);

// Menampilkan nilai siswa yang telah diubah menjadi string dengan tanda kutip dan pemisah koma
echo $nilai_gabung;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="chart.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Buatan Gw ygy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Profil"">Profil</a>
                    </li>
                    <li class=" nav-item">
                            <a class="nav-link" href="#VisiMisi">Visi dan Misi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    ?>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <div>
                Anda adalah admin
            </div>
        </div>
    <?php
    } ?>

    <?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
    ?>

        <div class="card draggable resizable">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="tab">Tab</span>
                <button type="button" class="btn-close" data-dismiss="card" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body d-flex">
                <iframe src="./page/admin.php" width="100%" height="300"></iframe>
            </div>
        </div>

    <?php
    } ?>


    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto text-center">
                <div class="card-body">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="https://smpitrjcilegon.sch.id/media_library/image_sliders/6a610c34b8dfedba999838116abd1882.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block text-white">
                                    <!-- <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p> -->
                                </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                                <img src="https://smpitrjcilegon.sch.id/media_library/image_sliders/88354d0bc144fcbd15b9cac6ffbe3708.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block text-white">
                                    <!-- <h5>Second slide label</h5>
                                    <p>Some representative placeholder content for the second slide.</p> -->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="https://smpitrjcilegon.sch.id/media_library/image_sliders/029aae13a9d5ca2ad251501932107ada.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block text-white">
                                    <!-- <h5>Third slide label</h5>
                                    <p>Some representative placeholder content for the third slide.</p> -->
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-left text-start">
                            <p>Halo, ini Sekolah Gw</p>
                        </div>
                        <div class="col-md-6 text-right text-end">
                            <p id="tanggal"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container mt-3">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img src="https://lh5.googleusercontent.com/p/AF1QipMEUayiWycD2zzYk4D7HZ1lqro-ll6bPmtls2sH=w408-h306-k-no" class="card-img-top" alt="gambar1">
                        <div class="card-body">
                            <h5 class="card-title">Lokasi</h5>
                            <p class="card-text"><?php echo "<a href='$gmap_url' target='_blank'>Lihat Lokasi di Google Maps</a>"; ?></p>
                            <span class="material-icons">
                                map
                            </span>
                            <p class="card-text">Jl. Ciberko No.4, Cibeber, Kec. Cibeber, Kota Cilegon, Banten 42424</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" id="scrollspyHeading1">Visi & Misi</h5>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="VisiMisi">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Visi
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php echo $visi; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Misi
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php echo $misi; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nilai murid kami</h5>
                            <div class="chart-container">
                                <canvas id="myPieChart"></canvas>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body" id="Profil">
                                        <h5 class="card-title">Profil</h5>
                                        <p class="card-text"><?php echo $profil; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Kepala sekolah</h5>
                                        <?php
                                        $sql1 = "SELECT * FROM tb_kontenwebdepan ORDER BY id ASC";
                                        $result = mysqli_query($conn, $sql1);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $foto = $row['pt_kepsek'];

                                        ?>
                                                <?php
                                                echo "<img class='ard-img-top w-100' src='uploads/" . $row['pt_kepsek'] . " ' alt='Foto'>";
                                                ?></img>
                                        <?php
                                            }
                                        } else {
                                            echo "Tidak ada data yang ditemukan.";
                                        }
                                        ?>
                                        <?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
                                        ?>
                                            <form method="post" action="./page/ppupdate.php" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <input type="file" class="form-control" id="foto" name="foto" aria-label="With textarea">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Ubah Foto</button>

                                            <?php

                                        } ?>
                                            <p class="card-text">DEDI MUGNI PERMADI, S.PD</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                    $sql = "SELECT * FROM tb_forum ORDER BY id ASC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $judul = $row['Judul'];
                            $isinya = nl2br(htmlspecialchars($row['Isinya']));
                            $sinposis = $row['Isinya'];
                            $foto = $row['Foto'];

                    ?>
                            <div class="col">
                                <div class="card">
                                    <?php
                                    echo "<img class='ard-img-top w-100' src='uploads/" . $row['Foto'] . " ' alt='Foto'>";
                                    ?></img>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $judul; ?></h5>
                                        <div class="w-900">
                                            <p class="text-truncate"><?php echo $sinposis; ?></p>
                                        </div>
                                        <a href="index.php?judul=<?php echo urlencode($judul); ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $id; ?>">Lihat Selengkapnya</a>
                                        <?php if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
                                        ?>
                                            <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                        <?php

                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-<?php echo $id; ?>" tabindex="-1" aria-labelledby="modal-<?php echo $id; ?>-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-<?php echo $id; ?>-label"><?php echo $judul; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="bg-secondary p-3 rounded">
                                                <?php
                                                echo "<img class='rounded ard-img-top w-100' src='uploads/" . $row['Foto'] . " ' alt='Foto'>";
                                                ?></img>
                                            </div>
                                            <p><?php echo $isinya; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Tidak ada data yang ditemukan.";
                    }
                    mysqli_close($conn);
                    ?>
                </div>

            </div>
        </div>




    </div>

    </div>

    
</body>
<style>
    .root {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body.dark-mode {
        background-color: #333333;
        color: #ffffff;
    }

    .card.draggable {
        position: absolute;
        z-index: 12;
        left: 0;
        top: 0;
    }

    .card-header {
        cursor: move;
    }
</style>

</html>

<script>
    function updateTanggal() {
        var now = new Date();
        var tanggal = now.toLocaleDateString() + " " + now.toLocaleTimeString();
        document.getElementById("tanggal").innerHTML = tanggal;
    }
    setInterval(updateTanggal, 1000);

    $(document).ready(function() {
        // Data untuk chart
        const data = {
            labels: [<?php echo $nama_bulan; ?>],
            datasets: [{
                label: 'My First Dataset',
                data: [<?php echo $nilai_gabung ?>],
                backgroundColor: [
                    '#2ecc71',
                    '#3498db',
                    '#95a5a6',
                    '#9b59b6',
                    '#f1c40f',
                    '#e74c3c',
                    '#34495e',
                    '#16a085',
                    '#f39c12',
                    '#c0392b',
                    '#7f8c8d',
                    '#8e44ad',
                    '#2980b9'

                ],
                hoverOffset: 4
            }]
        };

        // Opsi untuk chart
        const options = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Mengambil elemen canvas dan membuat chart lingkaran
        const ctx = $('#myPieChart')[0].getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const card = $('.card.draggable');
        const cardHeader = $('.card-header');

        let isDragging = false;
        let currentX;
        let currentY;
        let initialX;
        let initialY;
        let xOffset = 0;
        let yOffset = 0;

        cardHeader.on('mousedown touchstart', dragStart);
        cardHeader.on('mouseup touchend', dragEnd);
        $(document).on('mousemove touchmove', drag);

        function dragStart(e) {
            if (e.type === 'touchstart') {
                initialX = e.touches[0].clientX - xOffset;
                initialY = e.touches[0].clientY - yOffset;
            } else {
                initialX = e.clientX - xOffset;
                initialY = e.clientY - yOffset;
            }

            if (e.target === cardHeader[0]) {
                isDragging = true;
            }
        }

        function dragEnd(e) {
            initialX = currentX;
            initialY = currentY;

            isDragging = false;
        }

        function drag(e) {
            if (isDragging) {
                e.preventDefault();

                if (e.type === 'touchmove') {
                    currentX = e.touches[0].clientX - initialX;
                    currentY = e.touches[0].clientY - initialY;
                } else {
                    currentX = e.clientX - initialX;
                    currentY = e.clientY - initialY;
                }

                xOffset = currentX;
                yOffset = currentY;

                setTranslate(currentX, currentY, card[0]);
            }
        }

        function setTranslate(xPos, yPos, el) {
            el.style.transform = 'translate3d(' + xPos + 'px, ' + yPos + 'px, 0)';
        }
        $('.btn-close').click(function() {
            card.hide();
        });
    });
</script>

<script>
    $(document).ready(function() {
        const card = $('.card.draggable.resizable');
        const cardHeader = $('.card-header');

        // membuat card draggable seperti sebelumnya
        card.draggable({
            handle: cardHeader
        });

        // membuat card resizable dan dapat diatur ukuran lebar dan tingginya
        card.resizable({
            minWidth: 200,
            minHeight: 200,
            maxWidth: 800,
            maxHeight: 800
        });

        // menambahkan class "overflow-auto" pada card-body agar scrollable saat diresize
        card.find('.card-body').addClass('overflow-auto');
    });
</script>