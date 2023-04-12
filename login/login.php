<?php
require('koneksi.php');
$error = "";
$error_email = "";
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    if ($email && $password) {
        // query untuk mencari nilai yang sama
        $login = array("SELECT * FROM users WHERE email = '$email'", "SELECT * FROM users WHERE password = '$password'");

        // $result = mysqli_query($koneksi, $login[1]);

        // memeriksa apakah hasilnya ditemukan
        if (mysqli_num_rows(mysqli_query($koneksi, $login[1])) > 0 && mysqli_num_rows(mysqli_query($koneksi, $login[0])) > 0) {
            session_start();
            $_SESSION["email"] = $_POST["Email"]; // didapatkan dari input Username
            $_SESSION["pass"] = $_POST["Password"]; // didapatkan dari input Password
            header("Location: index.php");
        } else {
            header("refresh:1;url=login.php");
            $error_email = "Input error";
        }
    } else {
        $error = "Masukan Input";
    }
}

if(isset($_SESSION["email"])){
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="mx-auto">
        <div class="card position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
            <div class="card-body'">
                <form action="" method="POST">
                    <div>
                        <?php
                        if ($error) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error ?>
                            </div>
                        <?php
                            header("refresh:5;url=index.php");
                        }
                        ?>

                        <?php
                        if ($error_email) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error_email ?>
                            </div>
                        <?php
                            header("refresh:5;url=index.php");
                        }
                        ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Masukan Email</label>
                            <input type="email" class="form-control" id="nama" name="Email" value="<?php ?>">
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Masukan Password</label>
                            <input type="password" class="form-control" id="alamat" name="Password" value="<?php ?>">
                        </div>
                    </div>
                    <div class="col12">
                        <input type="submit" name="login" value="Masuk" class="btn btn-primary">
                        <a href="./register.php">register</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>