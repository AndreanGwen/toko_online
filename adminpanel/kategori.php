<?php
    require "session.php";
    require "../koneksi.php";

    $querykategori = mysqli_query($con, "SELECT * FROM kategori");
    $jumlahkategori = mysqli_num_rows($querykategori);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <!-- tag php disini untuk mengkoneksikan ke halaman navbar -->
    <?php require "navbar.php"; ?>
        <div class="container mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <!-- text muted untuk menghilangkan warna biru pada link -->
                        <a href="../adminpanel" class="no-decoration text-muted"> 
                            <i class="fa-solid fa-house"></i> Home</a>
                    </li>


                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fa-solid fa-align-justify"></i> Kategori
                    </li>
                </ol>
            </nav>





            <!-- KONEKSI UNTUK MENAMBAHKAN KATEGORI DIDALAM PHP -->
            <div class="my-5 col-12 col-md-6">
                <h4>Tambah Kategori</h4>

                <form action="" method="post">
                    <div>
                        <label for="kategori">Kategori</label>
                        <input type="text" id="kategori" name="kategori" placeholder="Input nama kategori" class="form-control">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success" type="submit" name="simpan_kategori">Save</button>
                    </div>
                </form>

                <?php if (isset($_POST['simpan_kategori'])) {
                    $kategori = htmlspecialchars($_POST['kategori']);

                    $queryexist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                    $jumlahdatakategoribaru = mysqli_num_rows($queryexist);

                    if ($jumlahdatakategoribaru > 0) {
                        ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                Kategori Tersedia, silahkan isi dengan kategori lainnya
                            </div>
                        <?php
                    } else {
                        $querysimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                        if ($querysimpan) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Kategori berhasil ditambahkan
                        </div>
                        <?php
                        } else {
                        echo mysqli_error($con);
                        }
                    }
                }
                ?>
            </div>





            <div class="mt-3">
                <h3>List Kategori</h3>

                <div class="table-responsive mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            if ($jumlahkategori==0) {
                            ?>
                                <tr>
                                    <td colspan=3 class="text-center">Tidak ada data dalam kategori</td>
                                </tr>
                            <?php
                                }
                                else $jumlah = 1;
                                    while ($data = mysqli_fetch_array($querykategori)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah++; ?></td>
                                    <td colspan="3"><?php echo $data['nama']; ?></td>
                                </tr>
                            <?php
                            }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    <!-- tag script disini untuk mengambil js dalam bootstrap yang digunakan untuk hamburger menu -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- tag script ini digunakan untuk mengkoneksikan logo fontawesome -->
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>