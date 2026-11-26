
<html>
    <head>
        <title>form</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1 class="header">Tambah Laporan</h1><br>
<?php session_start();?>
<?php if (!empty($_SESSION['errors'])): ?>
    <b>Terjadi Kesalahan:</b>
    <ul>
        <?php foreach ($_SESSION['errors'] as $err):?>
            <li><?php echo $err; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php unset ($_SESSION['errors'], $_SESSION['old_input']); ?>

<form class="form-create" action="aksi_tambah.php" method="post" enctype="multipart/form-data">
    Nama Pelapor : <input type="text" name="nama_pelapor"><br>
    Lokasi Ruang :  <input type="text" name="lokasi_ruang"><br>
    fasilitas :  <input type="text" name="fasilitas"><br>
    <label>Tingkat Kerusakan:</label><br>
    <label><input type="radio" name="tingkat_kerusakan" value="Ringan" required> Ringan</label><br>
    <label><input type="radio" name="tingkat_kerusakan" value="Sedang"> Sedang</label><br>
    <label><input type="radio" name="tingkat_kerusakan" value="Berat"> Berat</label><br>
    
    Tanggal Laporan : <input type="date" name="tanggal_laporan"><br><br>
    <button type="submit" value="simpan">Simpan</button>
    <a class="button-batal" href="index.php">batal</a>
</form><br>

<footer>
    <span>sarpras10sby.id</span>
</footer>
    </body>
</html>


