<?php

$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'db_psb';



$conn = mysqli_connect($host, $user, $pass, $db);

$gagal = "";
$berhasil = "";

if ($conn) {
    $berhasil = "Berhasil connect DB";
} else {
    $gagal = "gagal";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <?php
    if ($gagal) {
    ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                Gagal connect
            </div>
        </div>

    <?php
    }
    ?>

    <?php
    if ($berhasil) {
    ?>
        <div id="sukses" class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                <?php echo $berhasil; ?>
            </div>
            <button id="clButton" type="button" class="btn-close" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

</body>

</html>

<script>
    var button = document.getElementById("clButton");
    button.addEventListener("click", function() {
        var div = document.getElementById("sukses");
        div.remove();
    });

</script>