<?php
  // Koneksi ke database
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "db_psb";
  $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
  $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
  ];

  try {
      $pdo = new PDO($dsn, $username, $password, $options);
  } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  // Ambil data dari formulir
  $judul = $_POST['judul'];
  $isinya = $_POST['isinya'];
  $foto = $_FILES['foto']['name'];
  $foto_tmp = $_FILES['foto']['tmp_name'];

  // Pindahkan file ke folder uploads
  move_uploaded_file($foto_tmp, "../uploads/" . $foto);

  // Simpan data ke database
  $stmt = $pdo->prepare("INSERT INTO tb_forum (judul, isinya, foto) VALUES (:judul, :isinya, :foto)");
  $stmt->execute(['judul' => $judul, 'isinya' => $isinya, 'foto' => $foto]);

  echo "Data berhasil ditambahkan.";
  header("refresh:1;url=admin.php");

  // Tutup koneksi
  $pdo = null;
?>
