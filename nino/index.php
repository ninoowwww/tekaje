<?php
include 'koneksi.php';

$query = "SELECT * FROM tb_siswa;";
$sql = mysqli_query($sconn, $query);
$no = 0;

$per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 5;

// Hitung total data
$query_count = "SELECT COUNT(*) as total FROM tb_siswa";
$result_count = mysqli_query($sconn, $query_count);
$total_data = mysqli_fetch_assoc($result_count)['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $per_page);

// Ambil nomor halaman yang diminta (default: halaman pertama)
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung offset
$offset = ($current_page - 1) * $per_page;

// Query data dengan batasan
$query_data = "SELECT * FROM tb_siswa LIMIT $offset, $per_page";
$result_data = mysqli_query($sconn, $query_data);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">    

    <title>Ninoooooo</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> 
                DATA SEKOLAH
            </a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-4"> Data Siswa </h1>
        <figure>
        <blockquote class="blockquote">
        <p>Data Yang Telah Disimpan Di Database.</p>
        </blockquote>
        <figcaption class="blockquote-footer">
        CRUD <cite title="Source Title">Create, Read, Update, Delete</cite>
        </figcaption>
        </figure>    
        <a href="kelola.php" type="button" class="btn btn-primary mb-3 ">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
            Tambah Data
        </a>    
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th><center>No.</center></th>
                        <th>NISN</th>    
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Email Adress</th>
                        <th>Alamat</th>
                        <th>Foto</th> 
                        <th>Aksi</th>
                    </tr>    
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo ++$no; ?>.
                            </td>
                            <td>
                                <?php echo $result['nisn']; ?>
                            </td>
                            <td>
                                <?php echo $result['nama_siswa']; ?>
                            </td>
                            <td>
                                <?php echo $result['jenis_kelamin']; ?>
                            </td>
                            <td>
                                <?php echo $result['email_address']; ?>
                            </td>
                            <td>
                                <?php echo $result['alamat']; ?>
                            </td>
                            <td>
												    <?php
												    if ($result['foto_siswa']) {
												        echo '<img src="img/' . $result['foto_siswa'] . '" alt="Foto Siswa" style="max-width: 100px; max-height: 100px;">';
												    } else {
												        echo 'Tidak Ada Foto';
												    }
												    ?>
													</td>
														<td>
                                <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                  <i class="fa fa-pencil" aria-hidden="true"></i>
                                  Ubah
                                </a>
                                <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda yakin ingin menghapus tanda tersebut???')">
                                  <i class="fa fa-trash" aria-hidden="true"></i>
                                  Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>      
</body>
</html>
