<?php
include "koneksi.php";
session_start();

$id = $_GET['id_produk'];
$_SESSION['id_produk'] = $id;

if (isset($_SESSION['keranjang'][$id])) {
    $_SESSION['keranjang'][$id] += 1;
    header("Location: index.php");
} else {
    $_SESSION['keranjang'][$id] = 1;
    header("Location: index.php");
}
?>