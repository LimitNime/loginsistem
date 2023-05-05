<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php

$err = "";
$sukses = "";
$email = "";

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	if ($email == '') {
		$err = "Silakan masukkan email";
	} else {
		$sql1 = "select * from members where email = '$email'";
		$q1 = mysqli_query($koneksi, $sql1);
		$n1 = mysqli_num_rows($q1);

		if ($n1 < 1) {
			$err = "Email: <b>$email</b> tidak ditemukan";
		}
	}

	if (empty($err)) {
		$token_ganti_password = md5(rand(0, 1000));
		$judul_email = "Ganti Password";
		$isi_email = "Seseorang meminta untuk melakukan perubahan password. Silakan klik link di bawah ini:<br/>";
		$isi_email .= url_dasar() . "/ganti_password.php?email=$email&token=$token_ganti_password";
		kirim_email($email, $email, $judul_email, $isi_email);

		$sql1 = "update members set token_ganti_password = '$token_ganti_password' where email = '$email'";
		mysqli_query($koneksi, $sql1);
		$sukses = "Link ganti password sudah dikirimkan ke email anda.";
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
							<h4 class="card-title">Forgot Password</h4>
							<form method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="<?php echo $email ?>" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
	
	<script src="js/my-login.js"></script>
</body>
</html>