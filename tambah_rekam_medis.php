<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $tanggal_periksa = mysqli_real_escape_string($koneksi, $_POST['tanggal_periksa']);
    $id_pasien       = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $id_dokter       = mysqli_real_escape_string($koneksi, $_POST['id_dokter']);
    $keluhan         = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosa        = mysqli_real_escape_string($koneksi, $_POST['diagnosa']);
    $tindakan        = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $id_obat         = mysqli_real_escape_string($koneksi, $_POST['id_obat']);
    $resep           = mysqli_real_escape_string($koneksi, $_POST['resep']);

    $simpan = mysqli_query($koneksi, "INSERT INTO rekam_medis (tanggal_periksa, id_pasien, id_dokter, keluhan, diagnosa, tindakan, id_obat, resep) 
        VALUES ('$tanggal_periksa', '$id_pasien', '$id_dokter', '$keluhan', '$diagnosa', '$tindakan', '$id_obat', '$resep')");

    if ($simpan) {
        echo "<script>window.location.href='rekam_medis.php?pesan=simpan';</script>";
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
    <title>Tambah Rekam Medis - MedCare UI</title>
    <link rel="stylesheet" href="style.css?v=5">
</head>
<body>
    <div class="sidebar">
        <div class="brand">🏥 MedCare UI</div>
        <ul class="sidebar-menu">
            <li><a href="index.php">📊 Dashboard</a></li>
            <li><a href="pasien.php">👤 Data Pasien</a></li>
            <li><a href="dokter.php">👨‍⚕️ Data Dokter</a></li>
            <li><a href="obat.php">💊 Data Obat</a></li>
            <li><a href="rekam_medis.php" class="active">📋 Rekam Medis</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="top-nav">
            <h1>Tambah Rekam Medis</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Pemeriksaan Pasien</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Tanggal Periksa</label>
                    <input type="date" name="tanggal_periksa" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <select name="id_pasien" class="form-control" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php
                        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                        while ($p = mysqli_fetch_array($pasien)) {
                            echo "<option value='{$p['id_pasien']}'>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Dokter Pemeriksa</label>
                    <select name="id_dokter" class="form-control" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php
                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                        while ($dok = mysqli_fetch_array($dokter)) {
                            echo "<option value='{$dok['id_dokter']}'>{$dok['nama_dokter']} ({$dok['spesialisasi']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" placeholder="Masukkan keluhan pasien" required></textarea>
                </div>

                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="text" name="diagnosa" class="form-control" placeholder="Masukkan hasil diagnosa" required>
                </div>

                <div class="form-group">
                    <label>Tindakan Medis</label>
                    <input type="text" name="tindakan" class="form-control" placeholder="Contoh: Pemeriksaan Fisik & Pemberian Resep" required>
                </div>

                <div class="form-group">
                    <label>Obat</label>
                    <select name="id_obat" class="form-control" required>
                        <option value="">-- Pilih Obat --</option>
                        <?php
                        $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                        while ($o = mysqli_fetch_array($obat)) {
                            echo "<option value='{$o['id_obat']}'>{$o['nama_obat']} ({$o['satuan']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Aturan Pakai / Resep</label>
                    <input type="text" name="resep" class="form-control" placeholder="Contoh: 3x1 tablet sesudah makan" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="simpan" class="btn-primary">Simpan Data</button>
                    <a href="rekam_medis.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>