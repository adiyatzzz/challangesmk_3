<?php
$anggota = query("SELECT * FROM anggota");
$get_buku = query("SELECT * FROM buku");

if (isset($_POST["tambah"])) {
    $nama = $_POST["nama"];
    $buku = $_POST["buku"];
    $tgl_pinjam = date('Y-m-d');
    $tgl_kembali = date('Y-m-d', strtotime('+1 week'));

    if (tambah_pinjam($nama, $buku, $tgl_pinjam, $tgl_kembali) > 0) {
        echo "
            <script>
            alert('Data peminjaman telah di input')
            window.location.href = '?page=pinjam';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal di input')
            window.location.href = '?page=tambah_pinjam';
            </script>
        ";
    }
}

?>
<div class="container">

    <div class="row mt-5">
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">Tambah Pinjam</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="nama">Select Anggota</label>
                        <select class="form-control" id="nama" name="nama">
                            <option>Select nama</option>
                            <?php foreach ($anggota as $d) : ?>
                                <option value="<?= $d["no_anggota"] ?>"><?= $d["nama"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buku">Select Buku</label>
                        <select class="form-control" id="buku" name="buku">
                            <option>Select Buku</option>
                            <?php foreach ($get_buku as $d) : ?>
                                <option value="<?= $d["no_buku"] ?>"><?= $d["judul"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>