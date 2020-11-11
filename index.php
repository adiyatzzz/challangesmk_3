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
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Buku <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=anggota">Anggota</a>
                    </li>
                    <li class="nav-item">
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

                <div class="row">

                </div>
            </div>
        <?php } ?>
    </div>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
