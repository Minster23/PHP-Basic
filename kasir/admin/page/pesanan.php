<?php
require 'koneksi.php';

// Path to cart.json file
$cartFilePath = __DIR__ . '/cart.json';

// Read cart data from cart.json file
$cartData = json_decode(file_get_contents($cartFilePath), true);


// Iterate through each cart item
foreach ($cartData as $item) {
    $meja = $item['meja'];

    // Iterate through each item in the cart
    foreach ($item as $id => $quantity) {
        if ($id !== 'meja') {
            // Query to fetch data from 'pesanan' table based on ID
            $query = "SELECT harga, nama, jenis FROM pesanan WHERE id = '$id'";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                $data = mysqli_fetch_assoc($result);

                if ($data) {
                    $harga = $data['harga'];
                    $nama = $data['nama'];
                    $jenis = $data['jenis'];
                    $total = $harga * $quantity;
?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Meja: <?php echo $meja; ?><br>
                            ID: <?php echo $id; ?><br>
                            Nama: <?php echo $nama; ?><br>
                            Jenis: <?php echo $jenis; ?><br>
                            Harga: <?php echo $harga; ?><br>
                            Quantity: <?php echo $quantity; ?><br>
                            Total: <?php echo $total; ?>
                            <form method="post" action="">
                                <input type="hidden" name="meja" value="<?php echo $meja; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" value="Sudah" name="hapus">
                            </form>
                        </li>
                    </ul>
<?php
                } else {
                    echo "Data dengan ID '$id' tidak ditemukan.";
                }

                mysqli_free_result($result);
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }
    }
}

if (isset($_POST['hapus'])) {
    $meja = $_POST['meja'];
    $id = $_POST['id'];

    // Remove item from the cart based on meja and ID
    $cartData = json_decode(file_get_contents($cartFilePath), true);

    if (isset($cartData[$meja]) && isset($cartData[$meja][$id])) {
        unset($cartData[$meja][$id]);

        if (empty($cartData[$meja])) {
            unset($cartData[$meja]);
        }

        file_put_contents($cartFilePath, json_encode($cartData));

        echo "Data berhasil dihapus.";
    } else {
        foreach ($cartData as $key => $value) {
            if (is_array($value) && isset($value[$id])) {
                unset($cartData[$key][$id]);

                if (empty($cartData[$key])) {
                    unset($cartData[$key]);
                }

                file_put_contents($cartFilePath, json_encode($cartData));
                echo "Data berhasil dihapus.";
                exit;
            }
        }

        // echo "Meja '$meja' tidak ditemukan.";
    }
}
?>
