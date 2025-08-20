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

//ambil id dari url
$id = $_GET['id'];

$hapus = hapus($id);

if ($hapus){
    echo "<script>alert('Berhasil hapus !')</script>";
    header("Location: index.php");
    exit;
}else{
    echo "<script>alert('Gagal hapus !')</script>";
    header("Location: index.php");
    exit;
}
