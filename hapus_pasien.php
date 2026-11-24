<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien='$id'");
}
header("Location: pasien.php?pesan=hapus");
exit;
?>