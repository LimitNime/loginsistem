<?php
session_start();
include_once("inc/inc_koneksi.php");
include_once("inc/inc_fungsi.php");
?>
<?php 
if($_SESSION['members_email'] == ''){ //dia belum login
    header("location:login.php");
    exit();
}
?>
<div style="background-color: red;font-size:large;padding:50px;color:#FFFFFF;text-align:center">
Selamat datang <?php echo $_SESSION['members_nama_lengkap']?> di halaman rahasia. Hanya yang sudah login yang bisa akses halaman ini.
</div>