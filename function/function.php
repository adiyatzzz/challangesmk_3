<?php

$conn = mysqli_connect('localhost', 'root', '', 'perpustakaan');

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
    mysqli_query($conn, "INSERT INTO pinjam_buku VALUES(NULL, '$nama', '$buku', '$tgl_pinjam', '$tgl_kembali')");

    $kode_pinjam = mysqli_query($conn, "SELECT MAX(kode_pinjam) AS `kode_pinjam` FROM pinjam_buku");
    $kode = mysqli_fetch_assoc($kode_pinjam);
    $kode_pinjam = $kode['kode_pinjam'];
    mysqli_query($conn, "INSERT INTO denda VALUES(NULL, $kode_pinjam, '$nama', '$tgl_pinjam', '-', '-')");

    return mysqli_affected_rows($conn);
}

function hapus_pinjam($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM denda WHERE kode_pinjam = $id");
    mysqli_query($conn, "DELETE FROM pinjam_buku WHERE kode_pinjam = $id");
    return mysqli_affected_rows($conn);
}
