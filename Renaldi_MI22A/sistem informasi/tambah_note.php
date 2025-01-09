<?php
include 'db.php';

if (isset($_POST['tambah'])) {
    $nama_barang = $_POST['Nama_Barang'];
    $jumlah = $_POST['Jumlah'];
    $harga_per_unit = $_POST['Harga_Per_Unit'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $jenis_layanan = $_POST['Jenis_Layanan'];
    $nama_toko = $_POST['nama_toko']; // ID pelanggan yang akan dipilih
    $keterangan = $_POST['Keterangan'];

    // Menghitung total harga
    $total_harga = $jumlah * $harga_per_unit;

    // Query untuk menambahkan data transaksi ke tabel catatan_transaksi
    $query = "
        INSERT INTO t_catatan_transaksi (nama_barang, jumlah, harga_per_unit, total_harga, jenis_transaksi, jenis_layanan, nama_toko, keterangan)
        VALUES ('$nama_barang', '$jumlah', '$harga_per_unit', '$total_harga', '$jenis_transaksi', '$jenis_layanan', '$nama_toko', '$keterangan')
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'catatan_transaksi.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan data.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container border">
        <h1>Tambah Data Transaksi</h1>
        <form method="POST">
            <label>Nama Barang:</label><br>
            <input type="text" name="Nama_Barang" required><br>
            
            <label>Jumlah:</label><br>
            <input type="number" name="Jumlah" required><br>
            
            <label>Harga Per Unit:</label><br>
            <input type="number" name="Harga_Per_Unit" step="0.01" required><br>
            
            <label>Jenis Transaksi:</label><br>
            <input type="text" name="jenis_transaksi" required><br>
            </select><br>
            
            <label>Jenis Layanan:</label><br>
            <input type="text" name="Jenis_Layanan" required><br>
            
            <label>Nama Toko:</label><br>
            <input type="text" name="nama_toko" required><br>
            
            <label>Keterangan:</label><br>
            <textarea name="Keterangan" rows="4" required></textarea><br>

            <button type="submit" name="tambah">Tambah</button>
        </form>
        <br>
        <a href="catatan_transaksi.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
