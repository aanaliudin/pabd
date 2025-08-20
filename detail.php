<?php
require 'functions.php';

// Cek apakah ID ada di URL
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

#ambil id dari URL
$id = $_GET['id'];

#query mahasiswa berdasarkan ID
$result = query("SELECT * FROM mahasiswa WHERE id = $id");

// Cek apakah data ditemukan
if (empty($result)) {
    echo "<script>
    alert('Data mahasiswa tidak ditemukan!');
    document.location.href = 'index.php';
    </script>";
    exit;
}

// Ambil data mahasiswa (elemen pertama dari array)
$m = $result[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initialscale=1.0">
<title>Detail Mahasiswa</title>
</head>
<body>
<h3>Detail Mahasiswa</h3>
<ul>
<li><img width="150px" src="img/<?= $m['gambar']; ?>"></li>
<li>NIM : <?= $m['nim']; ?></li>
<li>Nama : <?= $m['nama']; ?></li>
<li>Email : <?= $m['email']; ?></li>
<li>Jurusan : <?= $m['jurusan']; ?></li>
<li><a href="ubah.php?id=<?php echo $m['id']; ?>">Ubah</a> | <a href="hapus.php?id=<?php echo $m['id']; ?>">Hapus</a></li>
<li><a href="index.php">Kembali ke Daftar Mahasiswa</a></li>
</ul>
</body>
</html>