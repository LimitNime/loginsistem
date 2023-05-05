<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");

$email = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email == '' or $password == '') {
        $err .= "Silakan masukkan semua isian";
    } else {
        $sql1 = "select * from members where email = '$email'";
        $q1 = mysqli_query($koneksi, $sql1);
        $r1 = mysqli_fetch_array($q1);
        $n1 = mysqli_num_rows($q1);

        if ($n1 > 0 && $r1 != null && $r1['status'] != '1') {
            $err .= "Akun yang kamu miliki belum aktif";
        }

        if ($n1 > 0 && $r1 != null && $r1['password'] != md5($password) && $r1['status'] == '1') {
            $err .= "Password tidak sesuai, Lupa password?klik <a href='lupa_password.php'>Link ini</a>";
        }


        if ($n1 < 1) {
            $err .= "Akun tidak ditemukan";
        }

        if (empty($err)) {
            $_SESSION['members_email'] = $email;
            $_SESSION['members_nama_lengkap'] = $r1['nama_lengkap'];

            header("location:rahasia.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Kodinger" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>My Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/my-login.css" />
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="img/logo.jpg" alt="logo" />
                    </div>
                    <div class="card fat">
                        <?php if ($err) {
                            echo
                                "<div class='alert alert-warning alert-dismissible fade show' role='alert'><ul>$err</ul><button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                        } ?>
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            <form method="POST" class="my-login-validation" novalidate="">
                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="<?php echo $email ?>" autofocus />
                                    <div class="invalid-feedback">Email is invalid</div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password
                                        <a href="lupa_password.php" class="float-right">
                                            Forgot Password?
                                        </a>
                                    </label>
                                    <input id="password" type="password" class="form-control" name="password" required
                                        data-eye />
                                    <div class="invalid-feedback">Password is required</div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember"
                                            class="custom-control-input" />
                                        <label for="remember" class="custom-control-label">Remember Me</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" name="login" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    Don't have an account?
                                    <a href="pendaftaran.php">Create One</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">Copyright &copy; 2023 &mdash; Your Company</div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>

</html>