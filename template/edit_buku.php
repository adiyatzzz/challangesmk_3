<?php
  
  $no = $_GET['no_buku'];

  
  $data = mysqli_query($conn, "SELECT * FROM buku WHERE no_buku = $no");

  
  while($buku = mysqli_fetch_assoc($data)) {
    $no          = $buku['no_buku'];
    $judul        = $buku['judul'];
    $pengarang      = $buku['pengarang'];
    $thn_terbit    = $buku['thn_terbit'];
    $penerbit      = $buku['penerbit'];
    $jns_buku    = $buku['jns_buku'];

    if(isset($_POST['simpan'])){
      $judul        = htmlspecialchars($_POST['judul']);
      $pengarang      = htmlspecialchars($_POST['pengarang']);
      $thn_terbit    = htmlspecialchars($_POST['thn_terbit']);
      $penerbit      = htmlspecialchars($_POST['penerbit']);
      $jns_buku    = htmlspecialchars($_POST['jns_buku']);

    mysqli_query($conn, "UPDATE buku SET judul='$judul',pengarang='$pengarang',thn_terbit='$thn_terbit',penerbit='$penerbit',jns_buku='$jns_buku' WHERE no_buku = '$no'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
            alert('Data Buku telah di input')
            window.location.href = 'index.php';
            </script>";

      }else { 
        echo "
            <script>
            alert('Data gagal di input')
            window.location.href = 'index.php';
            </script>";
      }

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
                    <label for="">Judul</label>
                    <input type="text" class="form-control" id="" value="<?php echo $judul; ?>" name="judul">
                </div>
                <div class="form-group">
                    <label for="">Pengarang</label>
                    <input type="text" class="form-control" id="" value="<?php echo $pengarang; ?>" name="pengarang">
                </div>
                <div class="form-group">
                    <label for="">Tahun Terbit</label>
                    <input type="text" class="form-control" id="" value="<?php echo $thn_terbit; ?>" name="thn_terbit">
                </div>
                <div class="form-group">
                    <label for="">Penerbit</label>
                    <input type="text" class="form-control" id="" value="<?php echo $penerbit; ?>" name="penerbit">
                </div>
                <div class="form-group">
                    <label for="">Jenis Buku</label>
                    <input type="text" class="form-control" id="" value="<?php echo $jns_buku; ?>" name="jns_buku">
                </div>
                <button type="submit"  class="btn btn-primary" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>