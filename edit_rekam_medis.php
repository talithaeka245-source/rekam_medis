<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM rekam_medis WHERE id_rekam='$id'");
$data = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $tanggal_periksa = mysqli_real_escape_string($koneksi, $_POST['tanggal_periksa']);
    $id_pasien       = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $id_dokter       = mysqli_real_escape_string($koneksi, $_POST['id_dokter']);
    $keluhan         = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosa        = mysqli_real_escape_string($koneksi, $_POST['diagnosa']);
    $tindakan        = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $id_obat         = mysqli_real_escape_string($koneksi, $_POST['id_obat']);
    $resep           = mysqli_real_escape_string($koneksi, $_POST['resep']);

    $update = mysqli_query($koneksi, "UPDATE rekam_medis SET 
        tanggal_periksa='$tanggal_periksa',
        id_pasien='$id_pasien',
        id_dokter='$id_dokter',
        keluhan='$keluhan',
        diagnosa='$diagnosa',
        tindakan='$tindakan',
        id_obat='$id_obat',
        resep='$resep'
        WHERE id_rekam='$id'");

    if ($update) {
        echo "<script>window.location.href='rekam_medis.php?pesan=edit';</script>";
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
    <title>Edit Rekam Medis - MedCare UI</title>
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
            <h1>Edit Rekam Medis</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="form-card">
            <div class="table-header">
                <h2>Form Perubahan Rekam Medis</h2>
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Tanggal Periksa</label>
                    <input type="date" name="tanggal_periksa" class="form-control" value="<?php echo $data['tanggal_periksa']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Nama Pasien</label>
                    <select name="id_pasien" class="form-control" required>
                        <?php
                        $pasien = mysqli_query($koneksi, "SELECT * FROM pasien");
                        while ($p = mysqli_fetch_array($pasien)) {
                            $selected = ($p['id_pasien'] == $data['id_pasien']) ? "selected" : "";
                            echo "<option value='{$p['id_pasien']}' $selected>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Dokter Pemeriksa</label>
                    <select name="id_dokter" class="form-control" required>
                        <?php
                        $dokter = mysqli_query($koneksi, "SELECT * FROM dokter");
                        while ($dok = mysqli_fetch_array($dokter)) {
                            $selected = ($dok['id_dokter'] == $data['id_dokter']) ? "selected" : "";
                            echo "<option value='{$dok['id_dokter']}' $selected>{$dok['nama_dokter']} ({$dok['spesialisasi']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" required><?php echo $data['keluhan']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Diagnosa</label>
                    <input type="text" name="diagnosa" class="form-control" value="<?php echo $data['diagnosa']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Tindakan Medis</label>
                    <input type="text" name="tindakan" class="form-control" value="<?php echo $data['tindakan']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Obat</label>
                    <select name="id_obat" class="form-control" required>
                        <?php
                        $obat = mysqli_query($koneksi, "SELECT * FROM obat");
                        while ($o = mysqli_fetch_array($obat)) {
                            $selected = ($o['id_obat'] == $data['id_obat']) ? "selected" : "";
                            echo "<option value='{$o['id_obat']}' $selected>{$o['nama_obat']} ({$o['satuan']})</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Aturan Pakai / Resep</label>
                    <input type="text" name="resep" class="form-control" value="<?php echo $data['resep']; ?>" required>
                </div>

                <div class="btn-group">
                    <button type="submit" name="update" class="btn-primary">Simpan Perubahan</button>
                    <a href="rekam_medis.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>