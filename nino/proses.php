<?php
include 'koneksi.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add" || $_POST['aksi'] == "edit") {
        if (isset($_POST['nisn'], $_POST['nama_siswa'], $_POST['jenis_kelamin'], $_POST['email_address'], $_POST['alamat'])) {
            $nisn = $_POST['nisn'];
            $nama_siswa = $_POST['nama_siswa'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $email_address = $_POST['email_address'];
            $alamat = $_POST['alamat'];
            $foto_siswa = $_POST['foto_siswa'];

            // Handle image upload
            $foto_siswa = '';
            // ...

                if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $foto_siswa = $_FILES['foto']['name'];
                $image_tmp = $_FILES['foto']['tmp_name'];
                $image_ext = pathinfo($foto_siswa, PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png', 'JPG'];

                if (in_array($image_ext, $allowed_extensions)) {
                    // Generate a unique image name
                    $foto_siswa = uniqid() . '.' . $image_ext;

                    // Move the uploaded image to the 'uploads' folder
                    move_uploaded_file($image_tmp, 'img/' . $foto_siswa);
                } else {
                    // Handle invalid file extensions
                    echo "Hanya file dengan ekstensi JPG, JPEG, GIF, atau PNG yang diizinkan.";
                }
            } else {
                // Handle errors during file upload
                echo "Terjadi kesalahan saat mengunggah file.";
            }


            // ...
if ($_POST['aksi'] == "add") {
    $query = "INSERT INTO tb_siswa (nisn, nama_siswa, jenis_kelamin, email_address, alamat, foto_siswa) VALUES ('$nisn', '$nama_siswa', '$jenis_kelamin', '$email_address', '$alamat', '$foto_siswa')";
} else {  // For editing
    $id = $_POST['id'];
    $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', email_address='$email_address', alamat='$alamat', foto_siswa='$foto_siswa' WHERE id_siswa='$id'";
}
// ...


            $sql = mysqli_query($sconn, $query);

            if ($sql) {
                header("location: index.php");
                exit;
            } else {
                echo "Gagal " . ($_POST['aksi'] == "add" ? "menambahkan" : "mengedit") . " data siswa.";
            }
        } else {
            echo "Tidak semua data POST diatur.";
        }
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id'";
    $sql = mysqli_query($sconn, $query);

    if ($sql) {
        header("location: index.php");
    } else {
        echo "Gagal menghapus data siswa.";
    }
}
?>
