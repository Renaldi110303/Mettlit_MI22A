<?php

 include 'db.php';
 include 'menu.php';

// Query untuk mendapatkan semua data
$query = "
    SELECT id, Nama_toko, Alamat, Pemilik, No_Telpon 
    FROM tbl_pelangan
";

$results = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Data Pelanggan</h1>
    <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Toko</th>
                <th>Alamat</th>
                <th>Pemilik</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['Nama_toko']) ?></td>
                    <td><?= htmlspecialchars($row['Alamat']) ?></td>
                    <td><?= htmlspecialchars($row['Pemilik']) ?></td>
                    <td><?= htmlspecialchars($row['No_Telpon']) ?></td>
                    <td>
                        <a href="edit.php?op=edit&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm">Edit</a>
                        <br>
                        <br>
                        <a href="hapus.php?id=<?= htmlspecialchars($row['id']) ?>" onclick="return confirm('Yakin mau menghapus data?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>

                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Tidak ada data ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
