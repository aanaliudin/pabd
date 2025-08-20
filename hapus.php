<?php
require 'functions.php';

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
