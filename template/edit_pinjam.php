<?php
$id = $_GET["id"];
$anggota = query("SELECT * FROM anggota");
$get_buku = query("SELECT * FROM buku");

$pinjam_buku = query("SELECT `pinjam_buku`.* , `anggota`.`nama`, `buku`.`judul`
                        FROM `pinjam_buku`
                        INNER JOIN `anggota` ON `pinjam_buku`.`no_anggota` = `anggota`.`no_anggota`
                        INNER JOIN `buku` ON `pinjam_buku`.`no_buku` = `buku`.`no_buku`
                        WHERE kode_pinjam = $id");
foreach ($pinjam_buku as $pinjam) {
    $nama = $pinjam["no_anggota"];
    $buku = $pinjam["no_buku"];
    $tgl_pinjam = $pinjam["tgl_pinjam"];
    $tgl_kembali = $pinjam["tgl_kembali"];
}

if (isset($_POST["edit"])) {
    $nama = $_POST["nama"];
    $buku = $_POST["buku"];
    $tgl_pinjam = $_POST["tgl_pinjam"];
    $tgl_kembali = $_POST["tgl_kembali"];

    if (edit_pinjam($id, $nama, $buku, $tgl_pinjam, $tgl_kembali) > 0) {
        echo "
            <script>
            alert('Data peminjaman telah di edit')
            window.location.href = '?page=pinjam';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal di edit')
            window.location.href = '?page=edit_pinjam&id=$id';
            </script>
        ";
    }
}

?>
<div class="container">

    <div class="row mt-5">
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">Edit Pinjam</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Select Anggota</label>
                        <select class="form-control" id="nama" name="nama">
                            <option>Select nama</option>
                            <?php foreach ($anggota as $d) : ?>
                                <option value="<?= $d["no_anggota"] ?>" <?= ($nama == $d["no_anggota"]) ? "selected" : ""; ?>><?= $d["nama"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buku">Select Buku</label>
                        <select class="form-control" id="buku" name="buku">
                            <option>Select Buku</option>
                            <?php foreach ($get_buku as $d) : ?>
                                <option value="<?= $d["no_buku"] ?>" <?= ($buku == $d["no_buku"]) ? "selected" : ""; ?>><?= $d["judul"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input class="form-control" type="date" name="tgl_pinjam" id="tgl_pinjam" value="<?= $tgl_pinjam ?>">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input class="form-control" type="date" name="tgl_kembali" id="tgl_kembali" value="<?= $tgl_kembali ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>