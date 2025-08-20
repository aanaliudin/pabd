<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Mahasiswa</title>
</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: left;">
    <h3>Daftar Mahasiswa</h3>
    <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">Logout</a>
</div>
<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br>
<form action="" method="POST">
<input type="text" class="keyword" name="keyword" size="45" placeholder="masukkan kata kunci
pencarian..." autocomplete="off" autofocus>
<button class="tombol-cari" type="submit" name="cari">Cari !</button>
</form>

<table class="container" border="1" cellpadding="10" cellspacing="0">
<tr>
<th>#</th>
<th>Gambar</th>
<th>Nama</th>
<th>Aksi</th>
</tr>
<?php
//bila tombol cari di klik
if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}else{
    $mahasiswa = query("SELECT * FROM mahasiswa");
}
?>

<?php if (count($mahasiswa) == 0) : ?>
    <tr>
        <td colspan="4">
            <p style="color: red; font-style:italic">
                Data mahasiswa tidak ditemukan!
            </p>
        </td>
    </tr>
<?php else : ?>
    <?php $i = 1; ?>
    <?php foreach ($mahasiswa as $m) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><img width="120px" src="img/<?= $m['gambar']; ?>"></td>
            <td><?= $m['nama']; ?></td>
            <td><a href="detail.php?id=<?= $m['id']; ?>">Lihat Detail</a></td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>

</table>
</body>
<script src="js/script.js"></script>
</html>