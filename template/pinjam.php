<?php

if (isset($_GET['act']) == 'hapus_pinjam') {
    $id = $_GET['id'];
    if (hapus_pinjam($id) > 0) {
        echo "
            <script>
            alert('Data berhasil di hapus')
            window.location.href = '?page=pinjam';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal di hapus')
            window.location.href = '?page=pinjam';
            </script>
        ";
    }
}

?>
<div class="container">
    <div class="row mt-3">
        <h3>Pinjam Buku</h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="?page=tambah_pinjam" class="btn btn-primary">Tambah Pinjam</a>
        </div>
        <div class="col-md-6">
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
    <div class="row mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Anggota</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Tarif</th>
                    <th scope="col">Jenis Denda</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST["search"])) {
                    $keyword = $_POST["keyword"];
                    $query = "SELECT `pinjam_buku`.*, `anggota`.`nama`, `buku`.`judul`, `denda`.`tarif_denda`, `denda`.`jns_denda`
                            FROM pinjam_buku
                            INNER JOIN `anggota` ON `pinjam_buku`.`no_anggota` = `anggota`.`no_anggota`
                            INNER JOIN `buku` ON `pinjam_buku`.`no_buku` = `buku`.`no_buku`
                            INNER JOIN `denda` ON `pinjam_buku`.`kode_pinjam` = `denda`.`kode_pinjam`
                            WHERE `anggota`.`nama` LIKE '%$keyword%' OR
                                  `buku`.`judul` LIKE '%$keyword%' OR
                                  `pinjam_buku`.`tgl_pinjam` LIKE '%$keyword%' OR
                                  `pinjam_buku`.`tgl_kembali` LIKE '%$keyword%' OR
                                  `denda`.`tarif_denda` LIKE '%$keyword%' OR
                                  `denda`.`jns_denda` LIKE '%$keyword%'
                                  ";
                } else {
                    $query = "SELECT `pinjam_buku`.*, `anggota`.`nama`, `buku`.`judul`, `denda`.`tarif_denda`, `denda`.`jns_denda`
                            FROM pinjam_buku
                            INNER JOIN `anggota` ON `pinjam_buku`.`no_anggota` = `anggota`.`no_anggota`
                            INNER JOIN `buku` ON `pinjam_buku`.`no_buku` = `buku`.`no_buku`
                            INNER JOIN `denda` ON `pinjam_buku`.`kode_pinjam` = `denda`.`kode_pinjam`";
                }

                $data = query($query);
                $no = 1;

                foreach ($data as $d) :
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $d['nama'] ?></td>
                        <td><?= $d['judul'] ?></td>
                        <td><?= $d['tgl_pinjam'] ?></td>
                        <td><?= $d['tgl_kembali'] ?></td>
                        <td><?= $d['tarif_denda'] ?></td>
                        <td><?= $d['jns_denda'] ?></td>
                        <td>
                            <a href="?page=denda&id=<?= $d['kode_pinjam'] ?>" class=" btn btn-warning">Denda</a>
                            <a href="?page=edit_pinjam&id=<?= $d['kode_pinjam'] ?>" class="btn btn-success">Edit</a>
                            <a href="?page=pinjam&act=hapus_pinjam&id=<?= $d['kode_pinjam'] ?>" class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>