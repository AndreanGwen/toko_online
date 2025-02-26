<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<style>
    .main {
        height: 100vh;
        z-index: 99999;
        background-image: url('../image/loginnnn.png');
        background-size: cover;
    }

    .login-box {
        width: 500px;
        height: 300px;
        box-sizing: border-box;
        border-radius: 10px;
    }

    .divcontact {
        width: 300px;
        height: 40px;
        box-sizing: border-box;
        border-radius: 10px;
    }

    .form-control {
        border-radius: 10px;
    }

    input::placeholder {
        font-size: 15px;
    }

    img {
        position: absolute;
        width: 450px;
        height: 300px;
        top: 59.5%;
        right: 70%;
    }

    .user {
        position: absolute;
        top: 37%;
        left: 61.5%;
    }

    .lock {
        position: absolute;
        top: 45.8%;
        left: 61.5%;
    }
</style>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div>
            <!-- koneksi kedalam database -->
            <?php
                if (isset($_POST['loginbtn'])) {
                    $username = htmlspecialchars($_POST ['username']);
                    $password = htmlspecialchars($_POST ['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);
                    
                    if ($countdata > 0) {
                        if (password_verify($password, $data['password'])) {
                            $_SESSION ['username'] = $data['username'];
                            $_SESSION ['login'] = true;
                            header('location:../adminpanel');
                        }
                        else {
                            ?>
                            <div class="alert alert-warning" role="alert" style="width: 500px">
                                Password Salah
                            </div>
                            <?php
                        }
                    } else {
                            ?>
                            <div class="alert alert-warning" role="alert" style="width: 500px">
                                Akun tidak ditemukan
                            </div>
                            <?php
                    }
                }
            ?>
            </div>

            <div class="login-box p-5 shadow">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Ketikkan username-mu">
                        <i class="user"data-feather="user"></i>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="...">
                        <i class="lock"data-feather="lock"></i>
                    </div>
                    <div>
                        <button class="btn btn-primary form-control mt-3" type="submit" name="loginbtn">Login</button>
                    </div>
                </form>
            </div>

            <div class="divcontact d-flex mt-4 shadow justify-content-center align-items-center gap-3">
                <a href="https://www.instagram.com/andrstry_gwn/"><i data-feather="instagram"></i></a>
                <a href="#"><i data-feather="facebook"></i></a>
                <a href="#"><i data-feather="twitter"></i></a>
                <a href="https://github.com/AndreanGwen"><i data-feather="github"></i></a>
            </div>
            <!-- <img src="../image/loginn.jpg" alt="gambarlogin"> -->
    </div>
    

<script>
    feather.replace();
</script>
</body>
</html>