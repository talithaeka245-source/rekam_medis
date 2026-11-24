<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $no_rm         = $_POST['no_rm'];
    $nama_pasien   = $_POST['nama_pasien'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat        = $_POST['alamat'];

    $update = mysqli_query($koneksi, "UPDATE pasien SET 
        no_rm='$no_rm',
        nama_pasien='$nama_pasien',
        jenis_kelamin='$jenis_kelamin',
        tanggal_lahir='$tanggal_lahir',
        alamat='$alamat'
        WHERE id_pasien='$id'");

    if ($update) {
        header("Location: pasien.php?pesan=edit");
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
    <title>Edit Pasien - MedCare UI</title>
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
            <h1>Edit Data Pasien</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Perubahan Data Pasien</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>No Rekam Medis (No RM)</label>
                    <input type="text" name="no_rm" class="form-control" value="<?php echo $data['no_rm']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" value="<?php echo $data['nama_pasien']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="L" <?php if ($data['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki (L)</option>
                        <option value="P" <?php if ($data['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan (P)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?php echo $data['alamat']; ?></textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" name="update" class="btn-primary">Simpan Perubahan</button>
                    <a href="pasien.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>