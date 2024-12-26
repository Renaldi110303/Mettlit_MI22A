<?php
include 'db.php';

// Validasi ID dari GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengamankan ID dengan intval

    // Mengambil data berdasarkan ID
    $query = "SELECT * FROM m_stok WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>
                alert('Data tidak ditemukan!');
                window.location.href = 'stok.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'stok.php';
          </script>";
    exit;
}

// Proses Update Data
if (isset($_POST['update'])) {
    $id = intval($_POST['id']); // ID harus disertakan dalam POST
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    // Query update data
    $query = "
        UPDATE m_stok
        SET jumlah = '$jumlah', satuan = '$satuan', keterangan = '$keterangan'
        WHERE id = $id
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'stok.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data: " . mysqli_error($koneksi) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Stok</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container border">
        <h1>Edit Data Stok</h1>
        <form action="edit_stok.php?id=<?= htmlspecialchars($data['id']) ?>" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>"> <!-- Menyimpan ID -->

            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" id="jumlah" name="jumlah" value="<?= htmlspecialchars($data['jumlah']) ?>" required>
            </div>

            <div class="form-group">
                <label for="satuan">Satuan:</label>
                <input type="text" id="satuan" name="satuan" value="<?= htmlspecialchars($data['satuan']) ?>" required>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" rows="4" required><?= htmlspecialchars($data['keterangan']) ?></textarea>
            </div>

            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="stok.php" class="btn btn-primary">Kembali</a>
        </form>
    </div>
</body>
</html>
