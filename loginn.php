<?php
include 'koneksi.php';
session_start();
if(isset($_POST['loginn'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

if($username!="" &&$password!=""){
    $query=mysqli_query($koneksi, "select * from pembeli where username='$username' and password='$password'");
    if($data = mysqli_fetch_array($query)){
        $_SESSION['username']=$data['username'];
        $_SESSION['password']=$data['password'];
        header('location:index.php');
    }
}
}
?>
<?php
include 'koneksi.php';
if(isset($_POST['loginn'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
if($username!="" && $password!=""){
    $query=mysqli_query($koneksi, "select * from pembeli where username='$username' and password='$password'");
    if(mysqli_num_rows($query)>0){
$_SESSION['username'];
$_SESSION['password'];
        header("Location: index.php");
    }else{
        header("Location: loginn.php");
    }
}
}
if(isset($_POST['daftar'])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $queryy = mysqli_query($koneksi, "select * from pembeli where username='$username'");
    $cek_login = mysqli_num_rows($queryy);

    if($cek_login > 0){
        echo "<script>
        alert('username telah digunakan');
        window.location = 'loginn.php';
        </script>";
    }else{
        if ($password != $password){
            echo"<script>
            alert('konfirmasi password tidak sesuai');
            window.localtion = 'loginn.php';
            </script>";
        }else{
            mysqli_query($koneksi,"INSERT INTO pembeli(email, password, username) VALUE('$email','$password','$username')");
             echo "<script>
alert('data berhasil dikirim');
window.location = 'index.php';
</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="baru.css">
    <style>
        body{
    min-height: 100vh;
    width: 100%;
    background-image: url(https://image.freepik.com/free-photo/flat-lay-ice-cream-cones-collection-white-background-sweets-menu-design_35641-364.jpg);
}
    </style>
</head>
<body>
   <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
         <header>login to iCREAM</header>
         <form action="loginn.php" method="post">
            <input type="text" placeholder="username" name="username">
            <input type="password" placeholder="Masukan password" name="password">
            <a href="#">Lupa password?</a>
            <input type="submit" value="login" name="loginn" class="submit">
         </form>
         <div class="signup">
            <span class="signup">Belum punya akun?
            <label for="check">Daftar</label>
            </span>
         </div>
    </div>
    <div class="registration form">
        <header>register form</header>
            <form action="loginn.php" method="post">
                <input type="text" placeholder="email" name="email">
                <input type="text" placeholder="username" name="username">
                <input type="password" placeholder="Masukan password" name="password">
                <input type="password" placeholder="Masukan ulang password" name="password">
                <input type="submit" value="daftar" name="daftar" class="submit">
            </form>
            <div class="signup">
                <span class="signup">Sudah punya akun?
                    <label for="check">Login</label>
                </span>
            </div>
    </div>
</div>
</body>
</html>