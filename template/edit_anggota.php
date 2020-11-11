<?php
    $id = $_GET["id"];
    // get data by id
    $data = query("SELECT * FROM anggota WHERE no_anggota = $id");
    $data = $data[0];

    if(isset($_POST['edit'])){

        $nama 		= $_POST['nama'];
        $jurusan 	= $_POST['jurusan'];
        $alamat 	= $_POST['alamat'];
        $tgl_lahir 	= $_POST['tgl_lahir'];
        $jml_denda	= $_POST['jml_denda'];

        mysqli_query($conn, "UPDATE anggota SET nama = '$nama', jurusan = '$jurusan', alamat = '$alamat', tgl_lahir = '$tgl_lahir', jml_denda = '$jml_denda' WHERE no_anggota = '$id'");

        if (mysqli_affected_rows($conn) > 0){
            echo "
                <script>
                alert('Data Anggota telah di edit')
                window.location.href ='?page=anggota';
                </script>
            ";
        } else {
            echo "
                <script>
                alert('Data gagal di edit')
                window.location.href ='?page=edit_anggota&id=$id';
                </script>
            ";
        }
    }

?>
<div class="container">

    <div class="row mt-5">
        <div class="card col-md-6">
            <div class="card-body">
                <h5 class="card-title">Edit Anggota</h5>
                <form action="" method="POST">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" id="" name="nama" value="<?= $data['nama'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Jurusan</label>
                    <input type="text" class="form-control" id="" name="jurusan" value="<?= $data['jurusan'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" id="" name="alamat" value="<?= $data['alamat'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>">
                </div>
                <div class="form-group">
                    <label for="">Jumlah Denda</label>
                    <input type="text" class="form-control" id="" name="jml_denda" value="<?= $data['jml_denda'] ?>">
                </div>
                <button type="submit"  class="btn btn-primary" name="edit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>