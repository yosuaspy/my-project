<?php
session_start();
    include 'koneksi.php';

    $nama_pelapor = $_POST['nama_pelapor'];
    $lokasi_ruang = $_POST['lokasi_ruang'];
    $fasilitas = $_POST['fasilitas'];
    $tingkat_kerusakan = $_POST['tingkat_kerusakan'] ?? '';
    $tanggal_laporan = $_POST['tanggal_laporan'];

    $errors = [];

    if (empty($nama_pelapor)) {
        $errors[] = "Pelapor Wajib Diisi";
    } elseif (strlen($nama_pelapor) <3) {
        $errors[] = "Judul minimal 3 karakter";
    } elseif (!preg_match("/^[a-zA-Z ']+$/", $nama_pelapor)) {
        $errors[] = "Pelapor hanya boleh huruf dan spasi";
    }

      if (empty($lokasi_ruang)) {
        $errors[] = "Genre Wajib Diisi";
    }

       if (empty($fasilitas)) {
        $errors[] = "Fasilitas Wajib Diisi";
    }

    $valid_tingkat_kerusakan = ['Ringan', 'Sedang', 'Berat' ];
    if (empty($tingkat_kerusakan)) {
        $errors[] = "Tingkat Kerusakan Wajib Diisi";
    } elseif (!in_array($tingkat_kerusakan, $valid_tingkat_kerusakan)) {
        $errors[] = "Tingkat Kerusakan harus salah satu dari : Ringan, Sedang, Berat";
    }

  if (empty($tanggal_laporan)) {
        $errors[] = "Tanggal laporan wajib Diisi";
    } elseif (strtotime($tanggal_laporan) > time()) {
        $errors [] = "Tanggal Laporan tidak boleh masa depan";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header('Location: tambah.php');
        exit;
    }

    mysqli_query($koneksi, "INSERT INTO laporan (nama_pelapor, lokasi_ruang, fasilitas, tingkat_kerusakan, tanggal_laporan )
    VALUES ('$nama_pelapor', '$lokasi_ruang', '$fasilitas', '$tingkat_kerusakan', '$tanggal_laporan')");
    
    $_SESSION['success'] = "Data Berhasil Ditambah";
    header('Location: index.php');
    exit;
?>