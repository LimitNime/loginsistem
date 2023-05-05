<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php
if (isset($_SESSION['members_email']) != '') { //sudah dalam keadaan login
	header("location:index.php");
	exit();
}
?>
<?php
$email = "";
$nama_lengkap = "";
$err = "";
$sukses = "";

if (isset($_POST['simpan'])) {
	$email = $_POST['email'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$password = $_POST['password'];
	$konfirmasi_password = $_POST['konfirmasi_password'];

	if ($email == '' or $nama_lengkap == '' or $konfirmasi_password == '' or $password == '') {
		$err .= "<li>Silakan masukkan semua isian.</li>";
	}

	//cek di bagian db, apakah email sudah ada atau belum
	if ($email != '') {
		$sql1 = "select email from members where email = '$email'";
		$q1 = mysqli_query($koneksi, $sql1);
		$n1 = mysqli_num_rows($q1);
		if ($n1 > 0) {
			$err .= "<li>Email yang kamu masukkan sudah terdaftar.</li>";
		}

		//validasi email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$err .= "<li>Email yang kamu masukkan tidak valid.</li>";
		}
	}

	//cek kesesuaian password & konfirmasi password
	if ($password != $konfirmasi_password) {
		$err .= "<li>Password dan Konfirmasi Password tidak sesuai.</li>";
	}
	if (strlen($password) < 6) {
		$err .= "<li>Panjang karakter yang diizinkan untuk password paling tidak 6 karakter.</li>";
	}

	if (empty($err)) {
		$status = md5(rand(0, 1000));
		$judul_email = "Halaman Konfirmasi Pendaftaran";
		$isi_email = "Akun yang kamu miliki dengan email <b>$email</b> telah siap digunakan.<br/>";
		$isi_email .= "Sebelumnya silakan melakukan aktifasi email di link di bawah ini:<br/>";
		$isi_email .= url_dasar() . "/verifikasi.php?email=$email&kode=$status";

		kirim_email($email, $nama_lengkap, $judul_email, $isi_email);

		$sql1 = "insert into members(email,nama_lengkap,password,status) values ('$email','$nama_lengkap',md5('$password'),'$status')";
		$q1 = mysqli_query($koneksi, $sql1);
		if ($q1) {
			$sukses = "Proses Berhasil. Silakan cek email kamu untuk verifikasi.";
		}


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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
							<?php if ($err) {
								echo
									"<div class='alert alert-warning alert-dismissible fade show' role='alert'><ul>$err</ul><button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
							} ?>
							<?php if ($sukses) {
								echo
									"<div class='alert alert-warning alert-dismissible fade show' role='alert'><ul>$sukses</ul><button type='button' class='close' data-dismiss='alert'aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
							} ?>
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="nama_lengkap" required autofocus>
									<div class="invalid-feedback">
										What's your name?
									</div>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<label for="password">Konfirmasi Password</label>
									<input id="password" type="password" class="form-control" name="konfirmasi_password" required data-eye>
									<div class="invalid-feedback">
										Confirmation Password is required
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="simpan" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login.php">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2023 &mdash; Your Company 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>
</html>