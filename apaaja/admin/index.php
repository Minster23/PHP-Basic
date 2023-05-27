<?php $jenis = ""; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Upload Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        #autocomplete-list {
            @apply list-none p-0 w-48 m-0 border border-gray-300 bg-gray-100;
        }

        #autocomplete-list li {
            @apply py-2 px-3 cursor-pointer;
        }

        #autocomplete-list li:hover {
            @apply bg-gray-200;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="POST" action="http://localhost/apaaja/api/api_tambah.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Kategori</label>
                <input type="text" id="autocomplete-input" name="selected-fruit" autocomplete="on" placeholder="Masukan kategori" class="form-control" required>
                <ul class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white" id="autocomplete-list"></ul>
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

        <script>
            // Daftar kategori untuk autocomplete (contoh data)
            const categoryList = [
                'Hobi', 'Olahraga', 'Memasak', 'Kesehatan', 'Elektronik', 'Fashion', 'Musik', 'Buku', 'Kendaraan'
            ];

            const inputElement = document.getElementById('autocomplete-input');
            const listElement = document.getElementById('autocomplete-list');

            inputElement.addEventListener('input', function() {
                const inputText = this.value.toLowerCase();
                const matchedCategories = categoryList.filter(category => category.toLowerCase().startsWith(inputText));

                // Hapus semua elemen dalam daftar autocomplete
                while (listElement.firstChild) {
                    listElement.removeChild(listElement.firstChild);
                }

                // Tambahkan kategori yang cocok ke dalam daftar autocomplete
                matchedCategories.forEach(category => {
                    const listItem = document.createElement('li');
                    listItem.textContent = category;
                    listElement.appendChild(listItem);
                });
            });

            listElement.addEventListener('click', function(event) {
                const selectedCategory = event.target.textContent;
                inputElement.value = selectedCategory;
                listElement.innerHTML = '';
            });
        </script>


    </div>
</body>

</html>