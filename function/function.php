<?php

$conn = mysqli_connect('localhost', 'root', '', 'perpustakaan');

// function untuk select
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah_pinjam($nama, $buku, $tgl_pinjam, $tgl_kembali)
{
    global $conn;
    // insert data ke table pinjam_buku
    mysqli_query($conn, "INSERT INTO pinjam_buku VALUES(NULL, '$nama', '$buku', '$tgl_pinjam', '$tgl_kembali')");

    /*
    - ambil kolom kode_pinjam yang terbaru, untuk menyingkat query saya menggunakan MAX()
    - insert data ke tabel denda
    */
    $kode_pinjam = mysqli_query($conn, "SELECT MAX(kode_pinjam) AS `kode_pinjam` FROM pinjam_buku");
    $kode = mysqli_fetch_assoc($kode_pinjam);
    $kode_pinjam = $kode['kode_pinjam'];
    mysqli_query($conn, "INSERT INTO denda VALUES(NULL, $kode_pinjam, '$nama', '$tgl_pinjam', '-', '-')");

    return mysqli_affected_rows($conn);
}

function hapus_pinjam($id)
{
    global $conn;
    // hapus baris di tabel denda
    mysqli_query($conn, "DELETE FROM denda WHERE kode_pinjam = $id");

    // hapus baris di tabel pinjam_buku
    mysqli_query($conn, "DELETE FROM pinjam_buku WHERE kode_pinjam = $id");
    return mysqli_affected_rows($conn);
}

function edit_pinjam($kode_pinjam, $nama, $buku, $tgl_pinjam, $tgl_kembali)
{
    global $conn;
    // edit tabel pinjam_buku
    mysqli_query($conn, "UPDATE pinjam_buku SET no_anggota = '$nama', no_buku = '$buku', tgl_pinjam = '$tgl_pinjam', tgl_kembali = '$tgl_kembali' WHERE kode_pinjam = $kode_pinjam");

    // edit tabel denda
    mysqli_query($conn, "UPDATE denda SET no_anggota = '$nama', tgl_pinjam = '$tgl_pinjam' WHERE kode_pinjam = '$kode_pinjam'");
    return mysqli_affected_rows($conn);
}

function denda($kode_pinjam, $tarif, $jns_denda)
{
    global $conn;

    if (is_numeric($tarif)) {
        mysqli_query($conn, "UPDATE denda SET tarif_denda = '$tarif', jns_denda = '$jns_denda' WHERE kode_pinjam = $kode_pinjam");
    } else {
        echo "
            <script>
            alert('Tarif denda harus berupa angka!')
            window.location.href = '?page=denda&id=$kode_pinjam';
            </script>
        ";
    }


    return mysqli_affected_rows($conn);
}
