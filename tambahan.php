<?php
    include 'koneksi.php';
    if(isset($_GET['aksi'])){
        if($_GET['aksi']=="edit"){
            $result = mysqli_query($koneksi,"SELECT * FROM pembeli where id_pembeli='$_GET[id_pembeli]'");
            while ($data = mysqli_fetch_array($result)){
                $username = $data['username'];
                $password = $data['password'];
                $foto = $data['foto'];
            }
        }else if($_GET['aksi']=="hapus"){
                $hapus = mysqli_query($koneksi,"DELETE FROM pembeli where id_pembeli='$_GET[id_pembeli]'");
               if($hapus){
                header("Location: tambahan.php");
               }
            }
       }   
           ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="login.php">kembali ke home</a><br><br>
    <form action="" method="post" enctype="multipart/form-data">
    <table width="25%" border=0>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" value=<?=@$username?> ></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" value=<?=@$password?> ></td>
        </tr>
        <tr>
            <td>Foto</td>
            <td><input type="file" name="foto" value=<?=@$foto?> ></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="tambah"></td>
        </tr>
    </table>
    </form>
   <table border="1">
   <thead>
    <th>No</th>
    <th>Username</th>
    <th>Password</th>
    <th>Foto</th>
    <th>Aksi</th>
    </thead>
<?php
include 'koneksi.php';
$no=1;
$query = mysqli_query($koneksi, "SELECT * FROM pembeli");
while($data=mysqli_fetch_array($query)){
    echo "<tr>";
    echo "<td>".$no; $no++."</td";
    echo "<td>".$data['username']."</td>";
    echo "<td>".$data['password']."</td>";
    echo "<td><img src='img/".$data['foto']."'style='width: 100px;'></td>";
    ?>
    <td><a href="tambahan.php?aksi=edit&id_pembeli=<?=$data['id_pembeli']?>">Edit</a>
    <a href="tambahan.php?aksi=hapus&id_pembeli=<?=$data['id_pembeli']?>">Hapus</a></td>
    </tr>
<?php } ?>
   </table>
   <?php
    include 'koneksi.php';
    if(isset($_POST['submit'])){
        if(isset($_GET['aksi'])){
            $id_pembeli = $_GET['id_pembeli'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $foto = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp,'img/'.$foto);
            $edit = mysqli_query($koneksi, "UPDATE pembeli set id_pembeli='$id_pembeli',username='$username',password='$password',foto='$foto' where id_pembeli='$id_pembeli'");
        if ($edit > 0){
            header("location: tambahan.php");
        }
        }else{
            $username = $_POST['username'];
            $password = $_POST['password'];
            $foto = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp,'img/'.$foto);
            $result = mysqli_query($koneksi, "INSERT INTO pembeli(username,password,foto) VALUES ('$username','$password','foto')");
            if($result > 0){
                header("location: tambahan.php");
               }
        }
    }
   ?>
</body>
</html>