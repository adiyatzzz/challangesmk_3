<?php
$id = $_GET["id"];
$data = query("SELECT `pinjam_buku`.*, `anggota`.`nama`, `buku`.`judul`, `denda`.`tarif_denda`, `denda`.`jns_denda`
                FROM pinjam_buku
                INNER JOIN `anggota` ON `pinjam_buku`.`no_anggota` = `anggota`.`no_anggota`
                INNER JOIN `buku` ON `pinjam_buku`.`no_buku` = `buku`.`no_buku`
                INNER JOIN `denda` ON `pinjam_buku`.`kode_pinjam` = `denda`.`kode_pinjam`
                WHERE `pinjam_buku`.`kode_pinjam` = $id");

if (isset($_POST["submit"])) {
    $tarif = $_POST["tarif"];
    $jenis = $_POST["jenis"];

    if (denda($id, $tarif, $jenis) > 0) {
        echo "
            <script>
            alert('Denda Anggota telah di input')
            window.location.href = '?page=pinjam';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Denda gagal di input')
            window.location.href = '?page=denda&id=$id';
            </script>
        ";
    }
}

?>
<div class="container">
    <div class="row mt-5">
        <div class="card col-md-6">
            <div class="card-body">
                <?php foreach ($data as $d) : ?>
                    <h5 class="card-title">Denda</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Nama : <?= $d["nama"] ?></h6>
                    <h6 class="card-subtitle mb-2 text-muted">Buku : <?= $d["judul"] ?></h6>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="tarif">Tarif Denda</label>
                            <input type="text" class="form-control" id="tarif" name="tarif" value="<?= $d["tarif_denda"] ?>">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Denda</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?= $d["jns_denda"] ?>">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>