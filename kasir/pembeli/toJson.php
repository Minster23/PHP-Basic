<?php
$data = file_get_contents('cart.json'); // Membaca data dari file JSON yang sudah ada
$cart = json_decode($data, true); // Mendekode data JSON menjadi array asosiatif

// Menerima data Cart dari JavaScript
$cartData = json_decode(file_get_contents('php://input'), true);

// Menambahkan data Cart yang diterima sebagai objek baru ke dalam array $cart
$cart[] = $cartData;

// Menyimpan data Cart ke file JSON
file_put_contents('../admin/page/cart.json', json_encode($cart));

echo "Data berhasil ditambahkan ke JSON";


?>
