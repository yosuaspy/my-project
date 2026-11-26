CREATE DATABASE IF NOT EXISTS db_sarpras;
USE db_sarpras;

CREATE TABLE IF NOT EXISTS laporan (
    id_laporan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelapor VARCHAR(50),
    lokasi_ruang VARCHAR(125),
    fasilitas VARCHAR(50),
    tingkat_kerusakan ENUM("Ringan", "Sedang", "Berat"),
    tanggal_laporan DATE
)