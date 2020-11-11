<?php

    if(isset($_POST['tambah'])){

    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $thn_terbit = $_POST['thn_terbit'];
    $penerbit = $_POST['penerbit'];
    $jns_buku = $_POST['jns_buku'];

    mysqli_query($conn, "INSERT INTO buku VALUES('','$judul','$pengarang','$thn_terbit','$penerbit','$jns_buku')");

    if (mysqli_affected_rows($conn) > 0){
        echo "
            <script>
            alert('Data Buku telah di input')
            window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal di input')
            window.location.href = 'template/tambah_buku.php';
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
                    <label for="">Judul</label>
                    <input type="text" class="form-control" id="" name="judul">
                </div>
                <div class="form-group">
                    <label for="">Pengarang</label>
                    <input type="text" class="form-control" id="" name="pengarang">
                </div>
                <div class="form-group">
                    <label for="">Tahun Terbit</label>
                    <input type="text" class="form-control" id="" name="thn_terbit">
                </div>
                <div class="form-group">
                    <label for="">Penerbit</label>
                    <input type="text" class="form-control" id="" name="penerbit">
                </div>
                <div class="form-group">
                    <label for="">Jenis Buku</label>
                    <input type="text" class="form-control" id="" name="jns_buku">
                </div>
                <button type="submit"  class="btn btn-primary" name="tambah">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>