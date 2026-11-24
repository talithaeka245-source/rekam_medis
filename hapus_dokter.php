<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter='$id'");
}
header("Location: dokter.php?pesan=hapus");
exit;
?>