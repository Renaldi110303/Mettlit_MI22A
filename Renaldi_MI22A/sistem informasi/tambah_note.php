<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah_barang = intval($_POST['Jumlah']); // Jumlah barang yang akan dikeluarkan
    $harga_satuan = floatval($_POST['Harga_Per_Unit']); // Harga satuan
    $keterangan = $_POST['Keterangan']; // Keterangan transaksi

    // Hitung sisa stok saat ini
    $query_total_stok = "SELECT SUM(jumlah) AS total_stok FROM m_stok";
    $result_total_stok = mysqli_query($koneksi, $query_total_stok);
    $total_stok = 0;
    if ($row_stok = mysqli_fetch_assoc($result_total_stok)) {
        $total_stok = $row_stok['total_stok'];
    }

    $query_total_dikeluarkan = "SELECT SUM(jumlah) AS total_dikeluarkan FROM t_catatan_transaksi";
    $result_total_dikeluarkan = mysqli_query($koneksi, $query_total_dikeluarkan);
    $total_dikeluarkan = 0;
    if ($row_transaksi = mysqli_fetch_assoc($result_total_dikeluarkan)) {
        $total_dikeluarkan = $row_transaksi['total_dikeluarkan'];
    }

    $sisa_stok = $total_stok - $total_dikeluarkan;

    // Validasi: cek apakah stok mencukupi
    if ($jumlah_barang > $sisa_stok) {
        echo "<script>alert('Stok tidak mencukupi! Sisa stok hanya $sisa_stok.');</script>";
        echo "<script>window.location.href='catatan_transaksi.php';</script>";
        exit; // Hentikan proses jika stok tidak mencukupi
    }

    // Jika stok mencukupi, lanjutkan proses transaksi
    $query = "INSERT INTO t_catatan_transaksi (jumlah, harga_satuan, keterangan) VALUES ($jumlah_barang, $harga_satuan, '$keterangan')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Transaksi berhasil ditambahkan!');</script>";
        echo "<script>window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
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
