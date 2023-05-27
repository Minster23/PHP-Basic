<?php
require '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Prepare and execute the SELECT query
    $query = "SELECT * FROM tb_produk WHERE id = $id";
    $statement = $koneksi->prepare($query);
    $statement->execute();

    // Get the result
    $result = $statement->get_result();

    // Check if a row was found
    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();
        $id         = $row['id'];
        $ffoto         = base64_encode($row['foto']);
        $nama        = $row['Nama'];
        $deskrisi        = $row['Deskripsi'];
        $harga        = $row['Harga'];
        $kategori        = $row['Kategori'];
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
            <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
            <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
            <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
            <title>Beli <?php echo $nama . " || " . $kategori; ?></title>
        </head>

        <body>

            <div class="w-full h-auto">
                <div class="relative block  p-6 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                    <a href="jelajahi.php">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Produk</h5>
                    </a>


                    <form method="GET" action="cari.php" class="flex items-center" enctype="multipart/form-data">
                        <label for="simple-search" class="sr-only">Search</label>

                        <?php require './components/keranjang.php'; ?>

                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input name="keyword" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                        </div>
                        <button type="submit" name="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>

                    <div class="flex h-screen justify-center items-center">

                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 justify-center">
                            <a href="#">
                                <?php echo "<img src='data:image/jpeg;base64,$ffoto' class='w-full h-auto max-w-xl rounded-lg' alt='Foto Pesanan'>"; ?>
                            </a>
                            <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                    <li class="inline-flex items-center">
                                        <a href="kategori.php?category=<?php echo $kategori; ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                            <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">

                                            </svg>
                                            <?php echo $kategori; ?>
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $nama; ?></h5>
                                </a>
                                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400"><?php echo $deskrisi; ?></p>


                                <div class="flex items-center justify-between">
                                    <span id="convertedValue<?php echo $id ?>" class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo $harga; ?></span>
                                    <script>
                                        var floatValue = <?php echo $harga ?>;
                                        var idrValue = floatValue.toLocaleString("id-ID", {
                                            style: "currency",
                                            currency: "IDR"
                                        });
                                        document.getElementById("convertedValue<?php echo $id ?>").innerHTML = idrValue;
                                    </script>
                                    <form method="POST" action="">
                                        <input name="Banyak"></input>
                                        <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Tambah keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

            <footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
                <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                    <div class="sm:flex sm:items-center sm:justify-between">
                        <a href="https://flowbite.com/" class="flex items-center mb-4 sm:mb-0">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
                            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                        </a>
                        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                            <li>
                                <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                            </li>
                            <li>
                                <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                    <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.</span>
                </div>
            </footer>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        </body>

<?php
    }
} else {
    echo "ID tidak ditemukan dalam URL.";
}
?>

<?php
require '../config/koneksi.php';

if (isset($_POST['submit'])) {
    // Data yang akan ditambahkan ke JSON
    $data = array(
        array(
            'id' => 1,
            'nama' => 'Produk 1',
            'harga' => 10,
            'banyak' => 2
        ),
        array(
            'id' => 2,
            'nama' => 'Produk 2',
            'harga' => 20,
            'banyak' => 3
        )
    );

    // Mendapatkan data JSON yang ada dalam file
    $file = './cart/chart25.json';
    $jsonData = file_get_contents($file);
    $cartData = json_decode($jsonData, true);

    // Memeriksa apakah $cartData adalah null
    if ($cartData === null) {
        $cartData = array();
    }

    // Menambahkan data baru ke dalam JSON
    $cartData = array_merge($cartData, $data);

    // Mengonversi kembali ke JSON dengan opsi JSON_PRETTY_PRINT
    $newJsonData = json_encode($cartData, JSON_PRETTY_PRINT);

    // Menyimpan data JSON yang diperbarui ke dalam file
    file_put_contents($file, $newJsonData);

    echo "Data berhasil ditambahkan ke dalam JSON.";
}
?>