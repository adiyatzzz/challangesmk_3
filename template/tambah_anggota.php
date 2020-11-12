<?php

if (isset($_POST['tambah'])) {

    $nama         = $_POST['nama'];
    $jurusan     = $_POST['jurusan'];
    $alamat     = $_POST['alamat'];
    $tgl_lahir     = $_POST['tgl_lahir'];

    mysqli_query($conn, "INSERT INTO anggota VALUES('','$nama','$jurusan','$alamat','$tgl_lahir','0')");

    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
            alert('Data Anggota telah di input')
            window.location.href ='?page=anggota';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal di input')
            window.location.href ='?page=tambah_anggota';
            </script>
        ";
    }
}

?>
<div class="container">

    <div class="row mt-5">
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">Tambah Anggota</h5>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <input type="text" class="form-control" id="" name="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" id="" name="alamat">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="" name="tgl_lahir">
                    </div>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>