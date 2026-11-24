<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id_rekam='$id'");
}
header("Location: rekam_medis.php?pesan=hapus");
exit;
?>