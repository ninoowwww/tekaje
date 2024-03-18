<?php
include 'koneksi.php';

$id = '';
$nisn = '';
$nama_siswa = '';
$jenis_kelamin = '';
$email_address = '';
$alamat = '';
$foto_siswa = '';

// Periksa apakah ada parameter "ubah" yang dikirimkan dari halaman sebelumnya
if (isset($_GET['ubah'])) {
    $id = $_GET['ubah'];

    // Query data berdasarkan id yang diterima
    $query = "SELECT * FROM tb_siswa WHERE id_siswa='$id'";
    $result = mysqli_query($sconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $nisn = $data['nisn'];
        $nama_siswa = $data['nama_siswa'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $email_address = $data['email_address'];
        $alamat = $data['alamat'];
        $foto_siswa = $data['foto_siswa'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Edit Data</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangani pengiriman formulir
            document.querySelector("form").addEventListener("submit", function(event) {
                // Dapatkan nilai dari input email
                var emailInput = document.querySelector("#email");
                var emailValue = emailInput.value;
                // Validasi: pastikan email berakhir dengan "@gmail.com"
                if (!emailValue.endsWith("@gmail.com")) {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    alert("Email Address harus berakhir dengan '@gmail.com'");
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
           <div class="mb-3 row">
                <label for="NISN" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input required type="number" name="nisn" class="form-control" id="NISN" placeholder="Ex: 12345678910" value="<?php echo $nisn; ?>" min="0">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="Nama" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="Nama" placeholder="Ex:Lintang" value="<?php echo $nama_siswa; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Jenis Kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select required id="Jenis Kelamin" name="jenis_kelamin" class="form-select">
                        <option value="Laki-Laki" <?php if ($jenis_kelamin === 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?php if ($jenis_kelamin === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email Adress</label>
                <div class="col-sm-10">
                    <input required type="text" name="email_address" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $email_address; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea required class="form-control" id="alamat" name="alamat" rows="3"><?php echo $alamat; ?></textarea>
                </div>
            </div>
            <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" name="foto" id="foto">
            </div>
            </div>

            <div class="mb-3 row mt-4">
                <div class="col">
                    <?php if (isset($_GET['ubah'])): ?>
                    <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Simpan Perubahan
                    </button>
                    <?php else: ?>
                    <button type="submit" name="aksi" type="add" value="add" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Tambahkan
                    </button>
                    <?php endif; ?>
                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-reply" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
