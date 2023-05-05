<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php
if ($_SESSION['members_email'] == '') { //dia belum login
    header("location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="img/logo.jpg" alt="bootstrap 4 login page">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Halaman Rahasia</h4>
                            <div
                                style="background-color: green;font-size:large;padding:50px;color:#FFFFFF;text-align:center">
                                Selamat datang
                                <?php echo $_SESSION['members_nama_lengkap'] ?> di halaman rahasia. Hanya yang sudah
                                login yang bisa akses halaman
                                ini.
                            </div>
                            <div class="form-group mt-4">
                                <a type="submit" href="logout.php" class="btn btn-primary btn-block">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2023 &mdash; Your Company
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>

</html>