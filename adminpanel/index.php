<?php
require "session.php";
require "../koneksi.php";

$querykategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryproduk = mysqli_query($con, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak {
        border: solid;
    }

    .summary-kategori {
        background-color: #016a55;
        border-radius: 15px;
    }

    .summary-produk {
        background-color: #3579a7;
        border-radius: 15px;
    }

    .no-decoration {
        text-decoration: none;
    }

    .no-decoration:hover {
        text-decoration: underline;
    }
</style>



<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-house"></i> Home
                </li>
            </ol>
        </nav>

        <!-- tag php disini untnuk mengkoneksikan username kedalam database -->
        <h2>Halo <?php echo $_SESSION['username'] ?></h2>


        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-kategori p-3">
                        <div class="row">
                            <div class="col-6">
                                <!-- ini untuk menambah logo nama logonya fa-align-justify -->
                                <i class="fa-solid fa-align-justify fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 fs-2 text>Kategori</h3>
                                <p fs-4 text><?php echo $jumlahkategori; ?> Kategori</p>
                                <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-produk p-3">
                        <div class="row">
                            <div class="col-6">
                                <!-- ini untuk menambah logo nama logonya fa-align-justify -->
                                <i class="fa-solid fa-bag-shopping fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 fs-2 text>Produk</h3>
                                <p fs-4 text><?php echo $jumlahproduk; ?> Produk</p>
                                <p><a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- tag script disini untuk mengambil js dalam bootstrap yang digunakan untuk hamburger menu -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- tag script ini digunakan untuk mengkoneksikan logo fontawesome -->
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>