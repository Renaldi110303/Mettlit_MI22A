<?php
include 'db.php';
include 'menu.php';

// Query untuk mendapatkan data stok
$query = "
    SELECT id, jumlah, satuan, tanggal_masuk, keterangan
    FROM m_stok
";

$results = mysqli_query($koneksi, $query);
if (!$results) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Query untuk menghitung total jumlah barang
$query_total = "SELECT SUM(jumlah) AS total_barang_masuk FROM m_stok";
$result_total = mysqli_query($koneksi, $query_total);

if (!$result_total) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$total_barang_masuk = 0;
if ($row_total = mysqli_fetch_assoc($result_total)) {
    $total_barang_masuk = $row_total['total_barang_masuk'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Stok</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Stok</h1>
    <a href="tambah_stok.php" class="btn btn-primary">Tambah stok</a>
    <br><br>

    <!-- Tampilkan total barang masuk -->
    <div>
        <h3>Total Barang Masuk</h3>
        <p>Jumlah Total: <?= htmlspecialchars($total_barang_masuk) ?> <?= htmlspecialchars($row['satuan'] ?? '') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($results) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($results)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['jumlah']) ?></td>
                        <td><?= htmlspecialchars($row['satuan']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                        <td>
                            <a href="edit_stok.php?op=edit&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm">Edit</a>
                            <br><br>
                            <a href="hapus_stok.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Yakin mau menghapus data?')" class="btn btn-danger btn-sm">Hapus</a>
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
