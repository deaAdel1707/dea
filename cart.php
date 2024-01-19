<?php
session_start();
 include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>iCREAM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-primary py-3 d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white pr-3" href="">FAQs</a>
                        <span class="text-white">|</span>
                        <a class="text-white px-3" href="">Help</a>
                        <span class="text-white">|</span>
                        <a class="text-white pl-3" href="">Support</a>
                    </div>
                </div>
                <div class="col-md-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-white px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-white px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-white pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-white navbar-light shadow p-lg-0">
                <a href="index.html" class="navbar-brand d-block d-lg-none">
                    <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>CREAM</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link active"></a>
                        <a href="about.php" class="nav-item nav-link">home</a>
                        <a href="product.php" class="nav-item nav-link">Product</a>
                    </div>
                    <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                        <h1 class="m-0 display-4 text-primary"><span class="text-secondary">i</span>CREAM</h1>
                    </a>
                    <div class="navbar-nav mr-auto py-0">
                        <a href="service.php" class="nav-item nav-link">service</a>
                        <a href="gallery.php" class="nav-item nav-link">Gallery</a>
                        <a href="contact.php" class="nav-item nav-link">contact</a>
                        <a href="logout.php" class="nav-item nav-link">Log out</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

<div class="content-wrapper">
<form action="" method="POST" enctype="multipart/form-data">
    <!-- main content -->
    <div class="content mt-4">
        <div class="container-fluid">
            <div class="row">
             <div class="col-lg-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="class-body">
                           <?php
                           if(empty($_SESSION['keranjang']) | !isset($_SESSION['keranjang'])){
                           ?>
                           <center>
                            <img src="img/cart_empty.png" width="200px" alt="">
                            <h2>anda belum menambah apapun kedalam keranjang :)</h2>
                           </center>
                           <?php }else{ ?>
                            <div class="row">
                                <div class="col-md-9">
                                    <?php foreach ($_SESSION['keranjang'] as $prod => $jumlah): ?>
                                    <?php
                                    $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$prod'");
                                    $pecah = $data->fetch_assoc();
                                    $sub = $pecah['harga']*$jumlah;    
                                    ?>
                                    <center>
                                     <div class="row">
                                        <div class="col-md-7">
                                        <div class="card-body border-2">
                                         <h5 class="card-title"><?php echo $pecah['nama_produk']; ?></h5>
                                         <p class="card-text text-left">Qty:</p>

                                         <div class="row">
                                            <div class="col-md-3">
                                                <input type="hidden" name="update" value="1">
                                                <input type="number" min="1" name="updatee" value="<?php echo $jumlah; ?>" style="width: 8rem;">
                                            </div>
                                            <div class="col-md-2 offset-2">
                                                <a type="submit" href="cart.php?ubah=1" class="btn btn-success"><i class="fa fa-arrow-up" aria-hidden="true"></i></i></a>
                                            </div>
                                            <div class="col-md-2">
                                                <a type="submit" id="del" href="hapus.php?hapus=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Remove product from the cart')"><i class="fas fa-trash"></i></a>
                                            </div>
                                         </div>
                                        </div>
                                        </div>
                                     </div>
                                     <?php endforeach; ?>   
                                    </center><a href="index.php" class="btn btn secondary d-block btn-sm">Continue shopping</a>
                                    <?php }?>
                                </div>
                              <div class="col-md-3">
                              <div class="card shadow">
                              <?php $grand=0; ?>
                              <?php foreach ($_SESSION['keranjang'] as $prod => $jumlah):
                              $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = $prod");
                              $pecah = $data->fetch_assoc();
                              $sub = $pecah['harga']*$jumlah;  
                              ?>
                              <li class="list-group-item d-flex justify-content-between lh-sm border-1">
                                <div>
                                <h6><strong><?php echo $pecah['nama_produk']; ?></strong></h6>
                                <small class="text-body-secondary">Quantity: <?php echo $jumlah; ?>x</small>
                                </div>
                                <span class="text-body-secondary">Rp.<?php echo number_format($sub); ?>,-</span>
                              </li>
                              <?php $grand=$grand+$sub; endforeach ?>

                              <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-6"><h6><strong>Grand total: </strong></h6></div>
                                    <div class="col-md-6">
                                        <span class="text-body-secondary">Rp.<?php echo number_format($grand); ?>,-</span>
                                        </div>
                                    </div>
                                    <a href="check.php" class="btn btn-primary d-blok btn-sm">Checkout</a>
                                </div>
                              </li>
                              </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
        </div>
    </div>
</form>
</div>