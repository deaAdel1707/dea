<?php
  include 'koneksi.php';
  session_start();
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($koneksi, "SELECT * FROM pembeli where username='$username' and password='$password'");
    
 if($data = mysqli_fetch_array($query)){
      $_SESSION['id'] = $data['id_pembeli'];
      header("location: index.php");
    }else{
      header("location: login.php");
    }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <style>
        body{
    min-height: 100vh;
    width: 100%;
    background-image: url(https://image.freepik.com/free-photo/flat-lay-ice-cream-cones-collection-white-background-sweets-menu-design_35641-364.jpg);
}
    </style>
    <title>login pelanggan</title>
</head>
<body>
    <center>
    <div class="container">
        <h6>Login</h6>
    <form action="" method="POST">
    <label>Username</label>
    <input type="text" name="username">

    <label>Password</label>
    <input type="password" name="password">

  <button type="submit" name="submit" class="btn btn-primary mb-4">Login</button>
</form>
</div>  
</center>


</body>
</html>