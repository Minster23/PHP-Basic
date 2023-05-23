<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sortir berdasarkan Meja</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <ul class="list-group">
      <?php
      // Data JSON sebagai contoh
      $dataJson = '[{"669":12,"670":8,"meja":"2"},{"671":6,"672":4,"meja":"3"},{"673":3,"674":9,"meja":"2"}]';
      $data = json_decode($dataJson, true);

      // Mendapatkan nilai $meja yang unik dari data JSON
      $mejaValues = array_unique(array_column($data, 'meja'));

      // Sortir nilai $meja secara ascending
      sort($mejaValues);

      // Menampilkan daftar sesuai dengan nilai $meja yang ada di JSON
      foreach ($mejaValues as $mejaValue) {
        echo '<li class="list-group-item">';
        foreach ($data as $item) {
          if ($item['meja'] === $mejaValue) {
            foreach ($item as $key => $value) {
              if ($key === 'meja') {
                echo 'Meja: ' . $value . '<br>';
              } else {
                echo $key . ': ' . $value . '<br>';
              }
            }
          }
        }
        echo '</li>';
      }
      ?>
    </ul>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mendapatkan elemen-elemen list
      var listItems = document.querySelectorAll('.list-group-item');

      // Menonaktifkan elemen-elemen list selain yang pertama
      for (var i = 1; i < listItems.length; i++) {
        listItems[i].classList.add('disabled');
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
