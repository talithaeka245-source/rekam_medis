<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_dokter  = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);

    $simpan = mysqli_query($koneksi, "INSERT INTO dokter (nama_dokter, spesialisasi) VALUES ('$nama_dokter', '$spesialisasi')");

    if ($simpan) {
        echo "<script>window.location.href='dokter.php?pesan=simpan';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dokter - MedCare UI</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
    <div class="sidebar">
        <div class="brand">🏥 MedCare UI</div>
        <ul class="sidebar-menu">
            <li><a href="index.php">📊 Dashboard</a></li>
            <li><a href="pasien.php">👤 Data Pasien</a></li>
            <li><a href="dokter.php" class="active">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat.php">💊 Data Obat</a></li>
            <li><a href="rekam_medis.php">📋 Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-nav">
            <h1>Tambah Data Dokter</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Dokter Baru</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Dokter & Gelar</label>
                    <input type="text" name="nama_dokter" class="form-control" placeholder="Contoh: dr. Budi Santoso, Sp.PD" required>
                </div>

                <div class="form-group">
                    <label>Spesialisasi</label>
                    <input type="text" name="spesialisasi" class="form-control" placeholder="Contoh: Spesialis Penyakit Dalam" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="simpan" class="btn-primary">Simpan Data</button>
                    <a href="dokter.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>