<?php
    include 'koneksi.php';

    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM laporan WHERE id='$id_laporan'");

    header('Location: index.php');
?>