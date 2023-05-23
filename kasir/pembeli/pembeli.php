<?php
include '../koneksi.php';


if (isset($_POST['submit'])) {
    // Ambil nilai yang dipilih dari dropdown
    $selectedNumber = $_POST['number'];
    session_start();
    $_SESSION['meja'] = $selectedNumber;

    // echo '<a href="' . $selectedNumber . '">Pergi ke Pembeli</a>';
    // echo "Angka yang dipilih: " . $selectedNumber;
    $url = '?meja=' . urlencode($_SESSION['meja']);
}

if (isset($_POST['order'])) {
    $logData = "Pembelian Meja: $selectedNumber - Tanggal: " . date("Y-m-d H:i:s") . PHP_EOL;
    file_put_contents("../admin/log.txt", $logData, FILE_APPEND);
    session_unset();
    session_destroy();
    header("Location: thx.html");
    exit();
}




// Query untuk mendapatkan data pesanan dari database dengan urutan ID
$query = "SELECT * FROM pesanan ORDER BY id ASC";
$result = $koneksi->query($query);


?>

<style>
    body {
        overflow-y: hidden;
        /* Hide vertical scrollbar */
        overflow-x: hidden;
        /* Hide horizontal scrollbar */
    }

    .float {
        position: fixed;
        bottom: 40px;
        right: 40px;
        z-index: 11;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <title>Pelangan || meja:<?php echo $selectedNumber;?></title>
</head>



<body class="p-4">
    <div class="drawer" x-data="{ open: false }">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <?php
            if (!isset($_SESSION['meja'])) {
                echo "Pilih meja";
            ?>
                <form method="post" action="">
                    <div class="mt-4">
                        <label class="block text-sm font-medium">PiLIH MEJA:</label>
                        <div class="mt-1 relative">
                            <select name="number" id="number" class="w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <?php
                                // Loop untuk menampilkan opsi angka 1 hingga 10
                                for ($i = 1; $i <= 10; $i++) {
                                    echo "<option value=\"$i\">$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">Pilih</button>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Makanan || Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th id="cartList"></th>
                                <th id="Harga"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form method="post" action="">
                    <h2 class="text-xl font-bold mt-4">Cart</h2>
                    <ul id="cartList" class="mt-2 table"></ul>
                    <button type="submit" name="order" onclick="Pesan()" class="float bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Pesan
                    </button>
                </form>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $nama = $row['nama'];
                                $deskripsi = $row['deskripsi'];
                                $jenis = $row['jenis'];
                                $harga = $row['harga'];
                                $foto = base64_encode($row['foto']);
                        ?>
                                <div class="card p-4 card-compact bg-base-100 shadow-xl">
                                    <div class="card-body">
                                        <?php echo $id; ?>
                                        <div class="avatar">
                                            <div class="rounded">
                                                <?php echo "<img src='data:image/jpeg;base64,$foto' class='img-fluid' alt='Foto Pesanan'>"; ?>
                                            </div>
                                        </div>
                                        <h5 class="card-title"><?php echo $nama; ?></h5>
                                        <div class="collapse">
                                            <input type="checkbox" />
                                            <div class="collapse-title text-xl font-medium">
                                                Deskripsi
                                            </div>
                                            <div class="collapse-content">
                                                <p class="card-text"><?php echo $deskripsi; ?></p>
                                            </div>
                                        </div>
                                        <button class="btn gap-2">
                                            Jenis
                                            <div class="badge"><?php echo $jenis; ?></div>
                                        </button>
                                        <button class="btn gap-2">
                                            harga:
                                            <div class="badge-secondary"><?php echo $harga; ?></div>
                                        </button>
                                        <button class="btn gap-2">
                                            Total:
                                            <div class="badge  badge-lg" id="hasil-<?php echo $id; ?>"></div>
                                        </button>
                                        <div class="carousel rounded-box w-96">
                                            <div class="carousel-item w-1/2">
                                                <div class="btn-group">
                                                    <button class="btn btn-active" onclick="decreaseQuantity('<?php echo $id; ?>', <?php echo $harga; ?>)">-</button>
                                                    <button class="btn btn-active" onclick="increaseQuantity('<?php echo $id; ?>', <?php echo $harga; ?>)">+</button>
                                                    <button class="btn" id="quantity-<?php echo $id; ?>"></button>
                                                    <button onclick="addToCart('<?php echo $nama; ?>', <?php echo $id; ?>, <?php echo $harga; ?>)" class="btn btn-active">
                                                        Tambahkan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>




            <footer class="footer p-10 bg-base-200 text-base-content">
                <div>
                    <p>Waroeng LTD<br />Providing reliable tech since 1992</p>
                </div>
                <div>
                    <span class="footer-title">Kontak kami</span>
                    <a class="link link-hover">Branding</a>
                    <a class="link link-hover">Design</a>
                    <a class="link link-hover">Marketing</a>
                    <a class="link link-hover">Advertisement</a>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>

</body>

</html>

<script>
    const quantities = {};
    const hasil = {};

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(number);
    }

    function updateQuantity(id) {
        const quantityElement = document.getElementById(`quantity-${id}`);
        const hasilElement = document.getElementById(`hasil-${id}`);
        quantityElement.textContent = quantities[id].toString();
        hasilElement.textContent = formatRupiah(hasil[id]);
    }

    function decreaseQuantity(id, harga) {
        if (quantities[id] === undefined) {
            quantities[id] = 0;
            hasil[id] = 0;
        }
        quantities[id]--;
        hasil[id] = quantities[id] * harga;
        updateQuantity(id);
    }

    function increaseQuantity(id, harga) {
        if (quantities[id] === undefined) {
            quantities[id] = 0;
            hasil[id] = 0;
        }
        quantities[id]++;
        hasil[id] = quantities[id] * harga;
        updateQuantity(id);
    }
    var meja = "<?php echo $_SESSION['meja']; ?>";

    function addToCart(nama, id, harga, total) {
        const cartList = document.getElementById("cartList");
        const Harga = document.getElementById("Harga");

        if (quantities[id] === undefined) {
            quantities[id] = 0;
            hasil[id] = 0;
        }

        const listItem = document.createElement("li");
        if (quantities[id] === undefined) {
            quantities[id] = 0;
            hasil[id] = 0;
        }
        hasill = quantities[id] * harga;
        // listItem.textContent = `${nama} ${id} ${hasill} ${meja}`;
        listItem.textContent = `${nama}`;
        listItem.textContent = `${nama} ${hasill}`;

        cartList.appendChild(listItem);
        Harga.appendChild(listItem);
    }

    function Pesan() {
        // Mengirim data Cart ke admin.php menggunakan metode POST
        quantities.meja = "<?= $_SESSION['meja']; ?>";
        fetch("toJson.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(quantities) // Mengirim objek quantities ke admin.php
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); // Respon dari admin.php
            })
            .catch(error => {
                console.error("Terjadi kesalahan:", error);
            });
    }
</script>