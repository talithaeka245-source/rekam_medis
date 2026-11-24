<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $no_rm         = $_POST['no_rm'];
    $nama_pasien   = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = $_POST['alamat'];

    $simpan = mysqli_query($koneksi, "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) 
        VALUES ('$no_rm', '$nama_pasien', '$jenis_kelamin', '$tanggal_lahir', '$alamat')");

    if ($simpan) {
        header("Location: pasien.php?pesan=simpan");
        exit;
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pasien - MedCare UI</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
    <div class="sidebar">
        <div class="brand">🏥 MedCare UI</div>
        <ul class="sidebar-menu">
            <li><a href="index.php">📊 Dashboard</a></li>
            <li><a href="pasien.php" class="active">👤 Data Pasien</a></li>
            <li><a href="dokter.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat.php">💊 Data Obat</a></li>
            <li><a href="rekam_medis.php">📋 Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-nav">
            <h1>Tambah Data Pasien</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Pasien Baru</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>No Rekam Medis (No RM)</label>
                    <input type="text" name="no_rm" class="form-control" placeholder="Contoh: RM 006" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan nama pasien" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L">Laki-laki (L)</option>
                        <option value="P">Perempuan (P)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" name="simpan" class="btn-primary">Simpan Data</button>
                    <a href="pasien.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>