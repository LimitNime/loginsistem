<?php
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php
if (isset($_SESSION['members_email']) != '') {
	header("location:index.php");
	exit();
}

$err = "";
$sukses = "";

$email = $_GET['email'];
$token = $_GET['token'];

if ($token == '' or $email == '') {
	$err .= "Link tidak valid. Email dan token tidak tersedia.";
} else {
	$sql1 = "select * from members where email = '$email' and token_ganti_password = '$token'";
	$q1 = mysqli_query($koneksi, $sql1);
	$n1 = mysqli_num_rows($q1);

	if ($n1 < 1) {
		$err .= "Link tidak valid. Email dan token tidak sesuai";
	}
}

if (isset($_POST['submit'])) {
	$password = $_POST['password'];
	$konfirmasi_password = $_POST['konfirmasi_password'];

	if ($password == '' or $konfirmasi_password == '') {
		$err .= "Silakan masukkan password serta konfirmasi password";
	} elseif ($konfirmasi_password != $password) {
		$err .= "Konfirmasi password tidak sesuai dengan password";
	} elseif (strlen($password) < 6) {
		$err .= "Jumlah karakter yang diperbolehkan untuk password minimal 6 karakter";
	}

	if (empty($err)) {
		$sql1 = "update members set token_ganti_password = '',password=md5('$password') where email = '$email'";
		mysqli_query($koneksi, $sql1);
		$sukses = "Password berhasil diganti. Silakan <a href='" . url_dasar() . "/login.php'>login</a>.";
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
			<div class="row justify-content-md-center align-items-center h-100">
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
							<h4 class="card-title">Reset Password</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="new-password">New Password</label>
									<input id="new-password" type="password" class="form-control" name="password" required autofocus
										data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
									<div class="form-text text-muted">
										Make sure your password is strong and easy to remember
									</div>
								</div>

								<div class="form-group">
									<label for="new-password">Konfirmasi Password</label>
									<input id="new-password" type="password" class="form-control" name="konfirmasi_password" required
										autofocus data-eye>
								</div>

								<div class="form-group m-0">
									<button type="submit" name="submit" class="btn btn-primary btn-block">
										Reset Password
									</button>
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

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
</body>

</html>