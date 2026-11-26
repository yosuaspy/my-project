<?php
include 'koneksi.php';

$cari = isset($_GET['cari']) && is_string($_GET['cari']) ? $_GET['cari'] : '';
$kata_kunci = '%' . $cari . '%';

$query = mysqli_prepare(
    $koneksi,
    'SELECT * FROM laporan WHERE nama_pelapor LIKE ? OR lokasi_ruang LIKE ?'
);
mysqli_stmt_bind_param($query, 'ss', $kata_kunci, $kata_kunci);
mysqli_stmt_execute($query);
$hasil = mysqli_stmt_get_result($query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Sarpras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h1>DATA SARPRAS</h1>
        <nav>
            <form method="get">
                <input type="text" name="cari" placeholder="Cari nama pelapor atau lokasi ruang..."
                    value="<?= htmlspecialchars($cari, ENT_QUOTES, 'UTF-8') ?>">
                <button type="submit">Search</button>
            </form>
            <a href="tambah.php" class="button-c">create</a>
        </nav>
    </div>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID Laporan</th>
            <th>Nama Pelapor</th>
            <th>Lokasi Ruang</th>
            <th>Fasilitas Rusak</th>
            <th>Tingkat Kerusakan</th>
            <th>Tanggal Laporan</th>
            <th>Aksi</th>
        </tr>
        <?php if (mysqli_num_rows($hasil) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($hasil)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_laporan'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['nama_pelapor'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['lokasi_ruang'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['fasilitas'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['tingkat_kerusakan'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($row['tanggal_laporan'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><a href="hapus.php?id=<?= urlencode($row['id_laporan']) ?>">Hapus</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">Data tidak ditemukan</td></tr>
        <?php endif; ?>
    </table>

    <footer><span>sarpras10sby.id</span></footer>
</body>
</html>
<?php mysqli_stmt_close($query); ?>
