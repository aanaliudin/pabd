<?php
function koneksi()
{
    return mysqli_connect('localhost', 'root', '123456', 'pabd');
}

function query($query)
{
    $conn = koneksi();
    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    $conn = koneksi();
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = htmlspecialchars($data['gambar']);

    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
        return 'nophoto.jpg';
    }

    //cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
        echo "<script>
        alert('yang anda pilih bukan gambar');
        </script>";
        return false;
    }

    //cek tipe file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
        echo "<script>
        alert('yang anda pilih bukan gambar');
        </script>";
        return false;
    }

    //cek ukuran file
    // maksimal 5Mb = 5000000
    if ($ukuran_file > 5000000) {
        echo "<script>
        alert('Ukuran terlalu besar. Maksimal ukuran file
        adalah 5MB.');
        </script>";
        return false;
    }

    //lolos pengecekan
    //siap upload file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    $query = "INSERT INTO
    mahasiswa
    VALUES ('', '$nama', '$nim', '$email', '$jurusan',
    '$nama_file_baru')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    $conn = koneksi();
    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $email = htmlspecialchars($data['email']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar_lama = $data['gambar_lama'];
    
    // Cek apakah gambar baru diupload
    if ($_FILES['gambar']['error'] === 4) {
        // Tidak ada gambar baru, gunakan gambar lama
        $gambar = $gambar_lama;
    } else {
        // Ada gambar baru, upload dan gunakan gambar baru
        $gambar = upload();
        
        // Jika upload gagal, gunakan gambar lama
        if (!$gambar) {
            $gambar = $gambar_lama;
        }
    }

    $query = "UPDATE mahasiswa SET
    nama = '$nama',
    nim = '$nim',
    email = '$email',
    jurusan = '$jurusan',
    gambar = '$gambar'
    WHERE id ='$id'
    ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim
    LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function login($data)
{
    $conn = koneksi();
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    if (query("SELECT * FROM user WHERE username = '$username' && password =
    '$password'")) {
        //set session
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    } else {
        return [
        'error' => true,
        'pesan' => 'Username / Password Salah!'
        ];
    }
}

function registrasi($data)
{
    $conn = koneksi();
    $username = htmlspecialchars(strtolower($data['username']));
    $password1 = mysqli_real_escape_string($conn, $data['password1']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    //jika username / password kosong
    if (empty($username) || empty($password1) || empty($password2)) {
        echo "<script>
        alert('username / password tidak boleh kosong!!');
        document.location.href = 'registrasi.php';
        </script>";
        return false;
    }
    // jika username sudah ada
    if (query("SELECT * FROM user WHERE username = '$username'")) {
        echo "<script>
        alert('username sudah terdaftar!');
        document.location.href = 'registrasi.php';
        </script>";
        return false;
    }
    //jika konfirmasi password tidak sesuai
    if ($password1 !== $password2) {
        echo "<script>
        alert('Konfirmasi password tidak sesuai!');
        document.location.href = 'registrasi.php';
        </script>";
        return false;
    }
    //jika password lebih kecil dari 4 digit
    if (strlen($password1) < 4) {
        echo "<script>
        alert('Password terlalu pendek!');
        document.location.href = 'registrasi.php';
        </script>";
        return false;
    }
    //jika username dan password sudah sesuai
    //enkripsi password
    $password_baru = password_hash($password1, PASSWORD_DEFAULT);
    //insert ke tabel user
    $query = "INSERT INTO user
    VALUES
    (null, '$username', '$password_baru')
    ";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function upload()
{
    $nama_file = $_FILES['gambar']['name'];
    $tipe_file = $_FILES['gambar']['type'];
    $ukuran_file = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    if ($error == 4) {
    return 'nophoto.jpg';
    }

    //cek ekstensi file
    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));
    if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
    alert('yang anda pilih bukan gambar');
    </script>";
    return false;
    }

    //cek tipe file
    if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
    alert('yang anda pilih bukan gambar');
    </script>";
    return false;
    }

    //cek ukuran file
    // maksimal 5Mb = 5000000
    if ($ukuran_file > 5000000) {
    echo "<script>
    alert('Ukuran terlalu besar. Maksimal ukuran file
    adalah 5MB.');
    </script>";
    return false;
    }

    //lolos pengecekan
    //siap upload file
    // generate nama file baru
    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
    return $nama_file_baru;
}

