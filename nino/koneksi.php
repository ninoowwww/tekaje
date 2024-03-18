<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sekolah';

$sconn = mysqli_connect($host, $user, $pass, $db);
if (!$sconn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_select_db($sconn, $db);
?>
