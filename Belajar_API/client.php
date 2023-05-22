<?php
$first_name = 'John';  // Nama depan
$last_name = 'Doe';  // Nama belakang
$input_text = 'username';  // Teks masukan
$umur = '90';

$data = array('first_name' => $first_name, 'last_name' => $last_name);  // Data yang akan dikirim ke rute /combine_names
$data2 = array('input_text' => $input_text); // Data yang akan dikirim ke rute /add_gmail
$data3 = array('umur' => $umur);  

$ch = curl_init();

// Permintaan ke rute /combine_names
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/combine_names');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Mengirim data dalam format JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$response = curl_exec($ch);
$result = json_decode($response, true);
$full_name = $result['result'];
$char_count = $result['char_count'];

echo "Nama lengkap: " . $full_name . "<br>";
echo "Jumlah karakter: " . $char_count . "<br>";

// Permintaan ke rute /add_gmail
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/add_gmail');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data2));  // Mengirim data dalam format JSON
$response2 = curl_exec($ch);
$result2 = json_decode($response2, true);
$modified_text = $result2['result'];

echo "Teks yang telah dimodifikasi: " . $modified_text . "<br>";

// Permintaan ke rute /add_gmail
curl_setopt($ch, CURLOPT_URL, 'http://localhost:5000/umurnya');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data3));  // Mengirim data dalam format JSON
$response3 = curl_exec($ch);
$result3 = json_decode($response3, true);
$umurnya = $result3['result'];

echo $umurnya . "<br>";

curl_close($ch);
?>
