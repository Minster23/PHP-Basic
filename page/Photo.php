<?php
require('../koneksi.php');
// require('koneksi.php');
?>

<form method="post" action="ppupdate.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" aria-label="With textarea">
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>