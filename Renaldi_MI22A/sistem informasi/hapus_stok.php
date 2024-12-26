<?php  
    $id = $_GET['id'];

    include 'db.php';

    $sql = "DELETE FROM m_stok WHERE id = '$id';";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        header('location: stok.php');

    } else {
        echo "Gagal Hapus Barang";
    }
?>