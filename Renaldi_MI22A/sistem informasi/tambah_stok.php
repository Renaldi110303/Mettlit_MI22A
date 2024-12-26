<?php
include 'db.php';

if (isset($_POST['tambah'])) {
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    $keterangan = $_POST['keterangan'];

    // Tanggal diisi otomatis dengan CURRENT_DATE
    $query = "
        INSERT INTO m_stok (jumlah, satuan, keterangan)
        VALUES ('$jumlah', '$satuan', '$keterangan')
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'stok.php';
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
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container border">
        <h1>Tambah Data Stok</h1>
        <form method="POST">
            <label>jumlah :</label><br>
            <input type="text" name="jumlah" required><br>
            <label>Satuan :</label><br>
            <input type="text" name="satuan" required><br>
            <label>Keterangan :</label><br>
            <input type="text" name="keterangan" required><br>
            <button type="submit" name="tambah">Tambah</button>
            <br>
            <br>
        </form>
        <a href="stok.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
