<?php  
    $id = $_GET['id'];

    include 'db.php';

    $sql = "DELETE FROM tbl_pelangan WHERE id = '$id';";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header('location: pelanggan.php');

    } else {
        echo "Gagal Hapus Barang";
    }
?>