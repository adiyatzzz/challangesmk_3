<?php

if (isset($_GET['act']) == 'hapus_anggota') {
  $id = $_GET['id'];
  if (hapus_anggota($id) > 0) {
    echo  "
            <script>
            alert ('Data berhasil di hapus')
            window.location.href ='?page=anggota';
            </script>
        ";
  } else {
    hapus_data_anggota($id);
    echo  "
            <script>
            alert ('Data berhasil di hapus')
            window.location.href ='?page=anggota';
            </script>
        ";
  }
}

?>

<div class="container">
  <div class="row mt-3">
    <h3>Anggota</h3>
  </div>
  <div class="row mt-3">
    <div class="col-md-6 p-0">
      <a href="?page=tambah_anggota" class="btn btn-primary">Tambah Anggota</a>
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

  $jml_denda = query("SELECT no_anggota, COUNT(no_anggota) AS jml_denda 
                      FROM denda
                      WHERE tarif_denda != '-' AND jns_denda != '-'
                      GROUP BY no_anggota");

  if (isset($_POST['search'])) {
    $cari = $_POST['keyword'];
    echo "Hasil Pencarian : $cari";
    $data = query("SELECT * FROM anggota WHERE 
                                      nama LIKE '%$cari%' OR
                                      jurusan LIKE '%$cari%' OR
                                      alamat LIKE '%$cari%' OR
                                      tgl_lahir LIKE '%$cari%'
                                            ");
  } else {
    $data = query("SELECT * FROM anggota");
  }

  ?>



  <div class="row mt-3">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Alamat</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Jumlah Denda</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;

        foreach ($data as $d) :
        ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $d["nama"] ?></td>
            <td><?= $d["jurusan"] ?></td>
            <td><?= $d["alamat"] ?></td>
            <td><?= $d["tgl_lahir"] ?></td>
            <td class="denda">
              <?php
              foreach ($jml_denda as $denda) {
                if ($d["no_anggota"] == $denda["no_anggota"]) {
                  echo $denda["jml_denda"];
                }
              }
              ?>
            </td>
            <td>
              <a href="?page=edit_anggota&id=<?= $d['no_anggota'] ?>" class="btn btn-success">Edit</a>
              <a href="?page=anggota&act=hapus_anggota&id=<?= $d['no_anggota'] ?>" class="btn btn-danger" onclick="return confirm('Yakin?, Seluruh data peminjaman buku dan denda akan terhapus.')">Hapus</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>