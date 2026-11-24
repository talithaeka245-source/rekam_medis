<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama_dokter  = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);

    $update = mysqli_query($koneksi, "UPDATE dokter SET nama_dokter='$nama_dokter', spesialisasi='$spesialisasi' WHERE id_dokter='$id'");

    if ($update) {
        echo "<script>window.location.href='dokter.php?pesan=edit';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Dokter - MedCare UI</title>
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
            <h1>Edit Data Dokter</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Perubahan Data Dokter</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Dokter & Gelar</label>
                    <input type="text" name="nama_dokter" class="form-control" value="<?php echo $data['nama_dokter']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Spesialisasi</label>
                    <input type="text" name="spesialisasi" class="form-control" value="<?php echo $data['spesialisasi']; ?>" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="update" class="btn-primary">Simpan Perubahan</button>
                    <a href="dokter.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>