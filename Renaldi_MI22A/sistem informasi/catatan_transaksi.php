<?php
include 'db.php';
include 'menu.php';

// Query untuk mengambil semua data transaksi
$query = "
SELECT id, tanggal_transaksi, nama_barang, jumlah, harga_per_unit, total_harga, jenis_transaksi, 
jenis_layanan, nama_toko, keterangan 
FROM t_catatan_transaksi
";

// Menjalankan query
$results = mysqli_query($koneksi, $query);

// Cek jika query berhasil dijalankan
if (!$results) {
    die("Query gagal: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Catatan Transaksi</h1>
    <a href="tambah_note.php" class="btn btn-primary">Tambah Catatan</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Per Unit</th>
                <th>Total Harga</th>
                <th>Jenis Transaksi</th>
                <th>Jenis Layanan</th>
                <th>Nama Toko</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($results) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($results)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_transaksi']) ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['jumlah']) ?></td>
                        <td><?= htmlspecialchars($row['harga_per_unit']) ?></td>
                        <td><?= htmlspecialchars($row['total_harga']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_transaksi']) ?></td>
                        <td><?= htmlspecialchars($row['jenis_layanan']) ?></td>
                        <td><?= htmlspecialchars($row['nama_toko']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td>
                            <a href="edit_note.php?op=edit&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm">Edit</a>
                            <br><br>
                            <a href="hapus_note.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Yakin mau menghapus data?')" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Tidak ada data ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Menutup koneksi database setelah penggunaan
mysqli_close($koneksi);
?>
