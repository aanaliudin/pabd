<?php
require 'functions.php';
//cek apaah tombol tambah sudah di klik
if (isset($_POST['tambah'])) {
if (tambah($_POST)) {
echo "<script>
alert ('data berhasil ditambahkan');
document.location.href='index.php';
</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Mahasiswa</title>
</head>
<body>
<h1>Form Tambah Data Mahasiswa</h1>
<form action="" method="POST" enctype="multipart/form-data">
<ul>
<li>
<label>
Nama :
<input type="text" name="nama" autofocus required>
</label>
</li>
<li>
<label>
NIM :
<input type="text" name="nim" required>
</label>
</li>
<li>
<label>
E-mail :
<input type="text" name="email" required>
</label>
</li>
<li>
<label>
Jurusan :
<input type="text" name="jurusan" required>
</label>
</li>
<li>
<label>
Gambar :
<input type="file" class="previewImage" name="gambar" required accept="image/*" onchange="previewImage(this)">
<img src="img/nophoto.jpg" width="120" style="display:block; margin-top: 10px;" class="img-preview"> 
</label>
</li>
<li>
<button type="submit" name="tambah"> Tambah Data! </button>
</li>
</ul>
</form>
<a href="index.php">Kembali ke Daftar Mahasiswa</a>
</body>
<script>
// Image preview function
function previewImage(input) {
    const imgPreview = document.querySelector('.img-preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imgPreview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Wait for DOM to be loaded
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.querySelector('.previewImage');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            previewImage(this);
        });
    }
});
</script>
<script src="js/script.js"></script>
</html>
