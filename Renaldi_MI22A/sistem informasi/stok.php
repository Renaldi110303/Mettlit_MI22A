<?php
include 'db.php';
include 'menu.php';

// Query untuk mengambil semua data transaksi
$query = "
SELECT id, jumlah, satuan, tanggal_masuk, keterangan
FROM m_stok
" ;

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
    <title>Data Stok</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Stok</h1>
    <a href="tambah_stok.php" class="btn btn-primary">Tambah stok</a>
    <br><br>
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
