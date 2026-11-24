<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama_obat = $_POST['nama_obat'];
    $satuan    = $_POST['satuan'];
    $stok      = $_POST['stok'];

    $simpan = mysqli_query($koneksi, "INSERT INTO obat (nama_obat, satuan, stok) VALUES ('$nama_obat', '$satuan', '$stok')");

    if ($simpan) {
        header("Location: obat.php?pesan=simpan");
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
    <title>Tambah Obat - MedCare UI</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
    <div class="sidebar">
        <div class="brand">🏥 MedCare UI</div>
        <ul class="sidebar-menu">
            <li><a href="index.php">📊 Dashboard</a></li>
            <li><a href="pasien.php">👤 Data Pasien</a></li>
            <li><a href="dokter.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat.php" class="active">💊 Data Obat</a></li>
            <li><a href="rekam_medis.php">📋 Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-nav">
            <h1>Tambah Data Obat</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Obat Baru</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" placeholder="Contoh: Paracetamol" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <select name="satuan" class="form-control" required>
                        <option value="">-- Pilih Satuan --</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Kaplet">Kaplet</option>
                        <option value="Botol">Botol</option>
                        <option value="Strip">Strip</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok Awal</label>
                    <input type="number" name="stok" class="form-control" placeholder="Contoh: 50" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="simpan" class="btn-primary">Simpan Data</button>
                    <a href="obat.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>