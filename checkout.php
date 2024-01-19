<?php
session_start();
include 'koneksi.php';
/*if (!isset($_SESSION['user'])) {
  header('Location:login.php');
}*/

$query ="SELECT * FROM produk WHERE id_produk='$_GET[id_produk]'";
$result = mysqli_query($koneksi, $query);
$data= mysqli_fetch_array($result)
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        /* CSS untuk gaya halaman checkout */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #F195B2;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 36px;
        }
        .checkout-form {
            background-color:#F195B2 ;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color: white;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], select {
            width: 97%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php

        include "koneksi.php";
        $mkn = $_GET['id_produk'];
        $query = "SELECT * FROM produk where id_produk='$_GET[id_produk]'";
        $result = mysqli_query($koneksi,$query);
        $data = mysqli_fetch_array($result);

        $user = mysqli_query($koneksi, "SELECT * FROM pembeli where id_pembeli ='$_SESSION[id]'");
        $saya = mysqli_fetch_array($user);
    
    ?>
    <header>
        <h1>Checkout </h1>
    </header>
    <div class="container">
        <div class="checkout-form">
            <h2>Informasi Pengiriman</h2>
            <form action="" method="POST">
                <label for="name">Nama Lengkap:</label>
                <input type="text" id="name" name="nama" value="<?= $saya['username']; ?>"required>
                
                <label for="email">Alamat Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="address">Alamat Pengiriman:</label>
                <input type="text" id="address" name="alamat" required>
                
                <label for="city">Kota:</label>
                <input type="text" id="city" name="kota" required>

                <label for="city">varian:</label>
                <input type="text" id="city" name="varian" value="<?= $data['nama_produk']; ?>" required>

                <label for="city">Harga:</label>
                <input type="text" id="city" name="harga" value="<?= $data['harga']; ?>" required>

                <label for="city">Jumlah Beli:</label>
                <input type="text" id="city" name="jumlah" required>
                
                <hr></hr>
                <h3>Payment</h3>
                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="payment" type="radio" class="form-check-input" value="Credit Card" checked required>
                        <label class="form-check-label" for="credit" >Credit Card</label>
                    </div>
                </div>
                <div class="my-3">
                    <div class="form-check">
                        <input id="debit" name="payment" type="radio" class="form-check-input" value="Ddebit Card" required>
                        <label class="form-check-label" for="debit" >Debit Card</label>
                    </div>
                </div>
                <div class="my-3">
                    <div class="form-check">
                        <input id="paypal" name="payment" type="radio" class="form-check-input" value="ovo" required>
                        <label class="form-check-label" for="paypal" >OVO</label>
                    </div>
                </div>
                
                <br>
                <label for="country">Negara:</label>
                <select id="country" name="negara" required>
                    <option value="indonesia">Indonesia</option>
                    <option value="singapura">Singapura</option>
                    <option value="malaysia">Malaysia</option>
                    <!-- Tambahkan negara lain sesuai kebutuhan -->
                </select>
                <button class="button" type="submit" name="submit">Proses Pembayaran</button>
                <?php
                include 'koneksi.php';
                if(isset($_POST['submit'])){
                    $nama= $_POST['nama'];
                    $email = $_POST ['email'];
                    $alamat = $_POST ['alamat'];
                    $kota = $_POST ['kota'];
                    $varian = $_POST ['varian'];
                    $jumlah = $_POST ['jumlah'];
                    $harga = $data['harga'] * $jumlah;
                    $payment = $_POST['payment'];
                    $negara = $_POST ['negara'];
                    $tanggal = date('Y-m-d');
                    $query2 = mysqli_query($koneksi, "INSERT INTO buynow (id, nama, email,kota, alamat, varian, harga, jumlah, payment, negara, tanggal) values('','$nama','$email','$alamat','$kota','$varian','$harga','$jumlah','$payment','$negara','$tanggal')");
                    $id = mysqli_insert_id($koneksi);
                    echo "<script>
        alert('Berhasil Belanja!')
        window.location = 'setruk.php?id=$id';
        </script>";
                }
                ?>
     
            </form>
        </div>
    </div>
</body>
</html>