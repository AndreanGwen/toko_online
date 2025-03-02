<!-- ini untuk koneksi ke dalam database id atau mengambil id -->
<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<body>
    <!-- requier disini untuk memunculkan navbar diatas -->
    <?php require "navbar.php" ?>

    <div class="container mt-4">
        <h2>Detail Kategori</h2>
        <div class="">

            <form action="" method="POST">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control"
                        value="<?php echo $data['nama']; ?>">
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <button type="submit" class="btn btn-success" name="editBtn">Edit</button>
                    <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
                </div>
            </form>

            <?php
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);
                if ($data['nama'] == $kategori) {
                    ?>
                    <meta http-equiv="refresh" content="0;url=kategori.php" />
                    <?php
                } else {
                    $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama = '$kategori'");
                    $jumlahadata = mysqli_num_rows($query);

                    if ($jumlahadata > 0) {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Kategori Tersedia, silahkan isi dengan kategori lainnya
                        </div>
                        <?php
                    } else {
                        $querysimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id = '$id'");
                        if ($querysimpan) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                Kategori berhasil diupdate
                            </div>

                            <!-- ini untuk halaman reffresh, content disini untuk berapa detik waktunya akan refresh -->
                            <meta http-equiv="refresh" content="3;url=kategori.php" />

                            <?php
                        } else {
                            echo mysqli_error($con);
                        }
                    }
                }
            }


            if (isset($_POST['deleteBtn'])) {
                $querydelete = mysqli_query($con, "DELETE FROM kategori WHERE id='$id'");

                if ($querydelete) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Kategori berhasil dihapus
                    </div>

                    <meta http-equiv="refresh" content="3;url=kategori.php" />
                    <?php
                } else {
                    echo mysqli_error($con);
                }
            }
            ?>
        </div>
    </div>


    <!-- tag script disini untuk mengambil js dalam bootstrap yang digunakan untuk hamburger menu -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- tag script ini digunakan untuk mengkoneksikan logo fontawesome -->
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>