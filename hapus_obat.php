<?php
include 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat='$id'");
}
header("Location: obat.php?pesan=hapus");
exit;
?>