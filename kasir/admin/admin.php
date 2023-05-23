<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruangan admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <?php
                        $menuItems = array(
                            'menu1' => 'Buat menu',
                            'pesanan' => 'Pesanan',
                        );

                        foreach ($menuItems as $key => $value) {
                            echo '<li class="nav-item">';
                            echo '<a class="nav-link" href="?menu=' . $key . '">' . $value . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-9">
                <div id="content">
                    <?php
                    $defaultPage = 'main.php';
                    $menu = $_GET['menu'] ?? '';

                    if (!empty($menu) && file_exists('page/' . $menu . '.php')) {
                        require 'page/' . $menu . '.php';
                    } elseif (file_exists('page/' . $defaultPage)) {
                        require 'page/' . $defaultPage;
                    } else {
                        echo 'Page not found!';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    .sidebar {
        background-color: #f8f9fa;
    }
</style>

<?php

// Cek nilai sesi
if(isset($_SESSION['role']) && $_SESSION['role'] == 'pembeli') {
    // Jika sesi sama dengan "admin", arahkan ke halaman admin
    header("Location: login.php");
    exit();
}elseif(isset($_SESSION['role']) && $_SESSION['role'] == ''){
    header("Location: login.php");
    exit();
}
?>