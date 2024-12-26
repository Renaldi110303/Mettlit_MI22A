<?php  
    $id = $_GET['id'];

    include 'db.php';

    $sql = "DELETE FROM t_catatan_transaksi WHERE id = '$id';";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header('location: catatan_transaksi.php');

    } else {
        echo "Gagal Hapus Barang";
    }
?>