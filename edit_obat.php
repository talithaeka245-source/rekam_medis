<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama_obat = $_POST['nama_obat'];
    $satuan    = $_POST['satuan'];
    $stok      = $_POST['stok'];

    $update = mysqli_query($koneksi, "UPDATE obat SET nama_obat='$nama_obat', satuan='$satuan', stok='$stok' WHERE id_obat='$id'");

    if ($update) {
        header("Location: obat.php?pesan=edit");
        exit;
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Obat - MedCare UI</title>
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
            <h1>Edit Data Obat</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Perubahan Data Obat</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control" value="<?php echo $data['nama_obat']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <select name="satuan" class="form-control" required>
                        <option value="Tablet" <?php if ($data['satuan'] == 'Tablet') echo 'selected'; ?>>Tablet</option>
                        <option value="Kapsul" <?php if ($data['satuan'] == 'Kapsul') echo 'selected'; ?>>Kapsul</option>
                        <option value="Kaplet" <?php if ($data['satuan'] == 'Kaplet') echo 'selected'; ?>>Kaplet</option>
                        <option value="Botol" <?php if ($data['satuan'] == 'Botol') echo 'selected'; ?>>Botol</option>
                        <option value="Strip" <?php if ($data['satuan'] == 'Strip') echo 'selected'; ?>>Strip</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?php echo $data['stok']; ?>" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="update" class="btn-primary">Simpan Perubahan</button>
                    <a href="obat.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>