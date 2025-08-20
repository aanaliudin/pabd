<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

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
$data = $result[0];

//cek apakah tombol ubah sudah di klik
if (isset($_POST['ubah'])) {
    if (ubah($_POST)) {
        echo "<script>
        alert ('data berhasil diubah');
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
<title>Ubah Data Mahasiswa</title>
</head>
<body>
<h1>Form Ubah Data Mahasiswa</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <input type="hidden" name="gambar_lama" value="<?php echo $data['gambar']; ?>">
<ul>
<li>
<label>
Nama :
<input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
</label>
</li>
<li>
<label>
NIM :
<input type="text" name="nim" value="<?php echo htmlspecialchars($data['nim']); ?>" required>
</label>
</li>
<li>
<label>
E-mail :
<input type="text" name="email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
</label>
</li>
<li>
<label>
Jurusan :
<input type="text" name="jurusan" value="<?php echo htmlspecialchars($data['jurusan']); ?>" required>
</label>
</li>
<li>
<label>
Gambar :
<input type="file" class="previewImage" name="gambar" accept="image/*" onchange="previewImage(this)">
<p><small>Biarkan kosong jika tidak ingin mengubah gambar</small></p>
<img src="img/<?php echo $data['gambar']; ?>" width="120" style="display:block; margin-top: 10px;" class="img-preview"> 
</label>
</li>
<li>
<button type="submit" name="ubah"> Ubah Data! </button>
</li>
</ul>
</form>
<br>
<a href="index.php" style="text-decoration: none; color: #007bff;">← Kembali ke Daftar Mahasiswa</a>
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
