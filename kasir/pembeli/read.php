<?php
$data = file_get_contents('cart.json'); // Membaca data dari file JSON
$cart = json_decode($data, true); // Mendekode data JSON menjadi array asosiatif

// Menampilkan data Cart yang telah dibaca
foreach ($cart as $id => $quantity) {
    echo "ID: " . $id . ", Quantity: " . $quantity . "<br>";
}
