<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM pasien");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pasien - MedCare UI</title>
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
            <h1>Data Pasien</h1>
            <div class="user-profile">
                <div class="user-avatar">A</div>
                <span style="font-size: 14px; font-weight: 600;">Admin Rekam Medis</span>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <h2>Daftar Pasien Terdaftar</h2>
                <a href="tambah_pasien.php" class="btn-primary">+ Tambah Pasien</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>JK</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    if ($query && mysqli_num_rows($query) > 0) {
                        while($d = mysqli_fetch_array($query)){ 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><span class="badge-tag"><?php echo $d['no_rm']; ?></span></td>
                        <td><strong><?php echo $d['nama_pasien']; ?></strong></td>
                        <td><?php echo $d['jenis_kelamin']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($d['tanggal_lahir'])); ?></td>
                        <td><?php echo $d['alamat']; ?></td>
                        <td>
                            <a href="edit_pasien.php?id=<?php echo $d['id_pasien']; ?>" class="btn-edit">Edit</a>
                            <a href="hapus_pasien.php?id=<?php echo $d['id_pasien']; ?>" class="btn-delete" onclick="bukaModalHapus(event, this.href)">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                    ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #a3aed0; padding: 20px;">Belum ada data pasien.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalKonfirmasiHapus" class="lkpd-overlay">
        <div class="lkpd-modal">
            <div class="lkpd-icon-warning">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="#dc2626">
                    <path d="M12 2L1 21h22L12 2zm1 15h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
            </div>
            <h3 class="lkpd-title-warning">Yakin Hapus?</h3>
            <p class="lkpd-text">Data pasien ini akan dihapus permanen!</p>
            <div class="lkpd-btn-group">
                <a id="btnLinkYaHapus" href="#" class="lkpd-btn-ya">Ya, Hapus!</a>
                <button type="button" class="lkpd-btn-batal" onclick="tutupModalHapus()">Batal</button>
            </div>
        </div>
    </div>

    <!-- Modal Notifikasi Berhasil (Simpan / Edit / Hapus) -->
    <?php if (isset($_GET['pesan'])) : ?>
        <?php
            $teks_pesan = "";
            if ($_GET['pesan'] == 'simpan') $teks_pesan = "Data Pasien Berhasil Disimpan!";
            elseif ($_GET['pesan'] == 'edit') $teks_pesan = "Data Pasien Berhasil Diperbarui!";
            elseif ($_GET['pesan'] == 'hapus') $teks_pesan = "Data Pasien Berhasil Dihapus!";
        ?>
        <?php if ($teks_pesan != "") : ?>
        <div id="modalBerhasilHapus" class="lkpd-overlay" style="display: flex;">
            <div class="lkpd-modal">
                <div class="lkpd-icon-success">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="lkpd-title-success">Berhasil!</h3>
                <p class="lkpd-text"><?php echo $teks_pesan; ?></p>
                <div class="lkpd-btn-group">
                    <button type="button" class="lkpd-btn-ya" onclick="tutupModalBerhasil()">OK</button>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endif; ?>

    <script>
        function bukaModalHapus(event, url) {
            event.preventDefault();
            document.getElementById('btnLinkYaHapus').href = url;
            document.getElementById('modalKonfirmasiHapus').style.display = 'flex';
        }
        function tutupModalHapus() {
            document.getElementById('modalKonfirmasiHapus').style.display = 'none';
        }
        function tutupModalBerhasil() {
            document.getElementById('modalBerhasilHapus').style.display = 'none';
            window.history.replaceState(null, null, window.location.pathname);
        }
    </script>
</body>
</html>