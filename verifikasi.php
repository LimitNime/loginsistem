<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php
$err = "";
$sukses = "";

if (!isset($_GET['email']) or !isset($_GET['kode'])) {
    $err = "Data yang diperlukan untuk verifikasi tidak tersedia.";
} else {
    $email = $_GET['email'];
    $kode = $_GET['kode'];

    $sql1 = "select * from members where email = '$email'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    if ($r1['status'] == $kode) {
        $sql2 = "update members set status = '1' where email = '$email'";
        mysqli_query($koneksi, $sql2);
        $sukses = "Akun telah aktif. Silakan login di halaman <a href='" . url_dasar() . "/login.php'>login</a>.";
    } else {
        $err = "Kode tidak valid";
    }
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
                            <h4 class="card-title">Halaman Verifikasi</h4>
                            <?php if ($err) {
                                echo
                                    "<div class='alert alert-warning alert-dismissible fade show' role='alert'><ul>$err</ul><button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                            } ?>
                            <?php if ($sukses) {
                                echo
                                    "<div class='alert alert-warning alert-dismissible fade show' role='alert'><ul>$sukses</ul><button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                            } ?>

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