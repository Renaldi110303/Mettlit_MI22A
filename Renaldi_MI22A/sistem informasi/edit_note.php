<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data pelanggan berdasarkan id
    $query = "SELECT * FROM t_catatan_transaksi WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} 

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_barang = $_POST['Nama_Barang'];
    $jumlah = $_POST['Jumlah'];
    $harga_per_unit = $_POST['Harga_Per_Unit'];
    $jenis_transaksi = $_POST['jenis_transaksi'];
    $jenis_layanan = $_POST['Jenis_Layanan'];
    $nama_toko = $_POST['nama_toko']; // ID pelanggan yang akan dipilih
    $keterangan = $_POST['Keterangan'];

    // Update data transaksi
    $query = "
        UPDATE t_catatan_transaksi 
        SET nama_barang = '$nama_barang', 
            jumlah = '$jumlah', 
            harga_per_unit = '$harga_per_unit', 
            jenis_transaksi = '$jenis_transaksi',
            jenis_layanan = '$jenis_layanan',
            nama_toko = '$nama_toko',
            keterangan = '$keterangan'
        WHERE id = $id
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'catatan_transaksi.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container border">
        <h1>Edit Data Transaksi</h1>
        <form action="edit_note.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

            <label>Nama Barang:</label><br>
            <input type="text" name="Nama_Barang" value="<?= htmlspecialchars($data['nama_barang']) ?>"><br>
            
            <label>Jumlah:</label><br>
            <input type="number" name="Jumlah" value="<?= htmlspecialchars($data['jumlah']) ?>"><br>
            
            <label>Harga per Unit:</label><br>
            <input type="number" name="Harga_Per_Unit" value="<?= htmlspecialchars($data['harga_per_unit']) ?>" step="0.01"><br>
            
            <label>Jenis Transaksi:</label><br>
            <input type="text" name="jenis_transaksi" value="<?= htmlspecialchars($data['jenis_transaksi']) ?>"><br>
            
            <label>Jenis Layanan:</label><br>
            <input type="text" name="Jenis_Layanan" value="<?= htmlspecialchars($data['jenis_layanan']) ?>"><br>
            
            <label>Nama Toko:</label><br>
            <input type="text" name="nama_toko" value="<?= htmlspecialchars($data['nama_toko']) ?>"><br>
            
            <label>Keterangan:</label><br>
            <textarea name="Keterangan"><?= htmlspecialchars($data['keterangan']) ?></textarea><br>

            <button type="submit" name="update">Update</button>
            <br><br>
        </form>
        <br>
        <a href="catatan_transaksi.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
