<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">Register your account</h5>
             <form action="" method="POST">
                <table>
                    <tr>
                        <td width="120"> Username </td>
                        <td> <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" type="name" name="Nama"> </td>
                    </tr>
                    <tr>
                        <td> Email </td>
                        <td> <input  class="form-control" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping" type="email" name="Email"> </td>
                    </tr>
                    <tr>
                        <td> Password </td>
                        <td> <input class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" type="password" name="Password"> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input  class="btn btn-primary" type="submit" name="Regis" value="Regis"> </td>
                    </tr>
                </table>
                </form>
        </div>
    </div>
</body>

</html>
<?php
include "koneksi.php";

$nama     = "";
$email    = "";
$Password  = "";

if (isset($_POST['Regis'])) {
    $nama = $_POST['Nama'];
    $email = $_POST['Email'];
    $Password = $_POST['Password'];
    if ($email && $Password && $nama) {
        // query untuk mencari nilai yang sama
        $login = array("SELECT * FROM users WHERE email = '$email'", "SELECT * FROM users WHERE password = '$Password'", "SELECT * FROM users WHERE name = '$nama'");

        // memeriksa apakah hasilnya ditemukan
        if (mysqli_num_rows(mysqli_query($koneksi, $login[0])) > 0 && mysqli_num_rows(mysqli_query($koneksi, $login[1])) > 0 && mysqli_num_rows(mysqli_query($koneksi, $login[2])) > 0) {
            echo "Masukan nama lain";
            header("Location: register.php");
        } else {
            echo "Data barang baru telah tersimpan";
            mysqli_query($koneksi, "INSERT into users set  
            name = '$_POST[Nama]',
            email = '$_POST[Email]',
            password = '$_POST[Password]'
            ");
            header("Location: login.php");
        }
    }
}

if(isset($_SESSION["email"])){
    header("Location: index.php");
}
?>