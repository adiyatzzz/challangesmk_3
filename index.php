<?php

include('function/function.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Perpustakaan</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item <?= (!isset($_GET["page"])) ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php">Buku <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?= ($_GET["page"] == 'anggota') ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=anggota">Anggota</a>
                    </li>
                    <li class="nav-item <?= ($_GET["page"] == 'pinjam') ? 'active' : ''; ?>">
                        <a class="nav-link" href="?page=pinjam">Pinjam</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'anggota':
                    require_once 'template/anggota.php';
                    break;

                case 'tambah_anggota':
                    require_once 'template/tambah_anggota.php';
                    break;

                case 'edit_anggota':
                    require_once 'template/edit_anggota.php';
                    break;

                case 'pinjam':
                    require_once 'template/pinjam.php';
                    break;
                    /*
                sebelum menambah halaman harap tambahkan case baru
                case dan file haru memiliki nama yang sama
                contoh : 
                case 'page':
                    require_once 'template/page.php';
                    break;
                
                */

                case 'tambah_pinjam':
                    require_once 'template/tambah_pinjam.php';
                    break;

                case 'edit_pinjam':
                    require_once 'template/edit_pinjam.php';
                    break;

                case 'denda':
                    require_once 'template/denda.php';
                    break;

                case 'edit_buku':
                    require_once 'template/edit_buku.php';
                    break;

                case 'tambah_buku':
                    require_once 'template/tambah_buku.php';
                    break;

                default:
                    require_once 'template/notfound.php';
                    break;
            }
        } else {
        ?>
            <div class="container">
                <div class="row mt-3">
                    <h3>Buku</h3>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 p-0">
                        <a href="?page=tambah_buku" class="btn btn-primary">Tambah Buku</a>
                    </div>
                    <div class="col-md-6 p-0">
                        <form action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." name="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" name="search">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php

                if (isset($_POST['search'])) {
                    $cari = $_POST['keyword'];
                    echo "Hasil Pencarian : $cari";
                    $data = mysqli_query($conn, "SELECT * FROM buku WHERE CONCAT(no_buku,judul,pengarang,thn_terbit,penerbit,jns_buku) like '%$cari%' ");
                } else {
                    $data = mysqli_query($conn, "SELECT * FROM buku");
                }

                if (isset($_GET["act"]) == 'hapus_buku') {
                    $id = $_GET["id"];
                    if (hapus_buku($id) > 0) {
                        echo "
                        <script>
                        alert('Data berhasil di hapus')
                        window.location.href = 'index.php';
                        </script>
                        ";
                    } else {
                        echo "
                        <script>
                        alert('Data gagal di hapus')
                        window.location.href = 'index.php';
                        </script>
                        ";
                    }
                }

                ?>
                <div class="row mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Pengarang</th>
                                <th scope="col">Tahun Terbit</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Jenis Buku</th>
                                <th scope="col">Action</th>
                            </tr>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['pengarang']; ?></td>
                                    <td><?php echo $row['thn_terbit']; ?></td>
                                    <td><?php echo $row['penerbit']; ?></td>
                                    <td><?php echo $row['jns_buku']; ?></td>
                                    <td>
                                        <a href="?page=edit_buku&no_buku=<?= $row['no_buku'] ?>" class="btn btn-success">Edit</a>
                                        <a href="?act=hapus_buku&id=<?= $row['no_buku'] ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </div>
<?php } ?>
</div>

<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/myscript.js"></script>
</body>

</html>