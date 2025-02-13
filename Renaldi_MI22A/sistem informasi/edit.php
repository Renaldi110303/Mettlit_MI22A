<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    

    $query = "SELECT * FROM tbl_pelangan WHERE id = '$id'";
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
    $nama_toko = $_POST['Nama_toko'];
    $alamat = $_POST['Alamat'];
    $pemilik = $_POST['Pemilik'];
    $no_telpon = $_POST['No_Telpon'];
   

    // Tanggal tidak diubah
    $query = "
        UPDATE tbl_pelangan 
        SET Nama_toko = '$nama_toko', Alamat = '$alamat', Pemilik = '$pemilik', 
            No_Telpon = '$no_telpon' 
        WHERE id = $id
    ";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'pelanggan.php';
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
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="container border">
    <h1>Edit Data</h1>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">
        <label>Nama Toko:</label><br>
        <input type="text" name="Nama_toko" value="<?= htmlspecialchars($data['Nama_toko']) ?>"><br>
        <label>Alamat:</label><br>
        <input type="text" name="Alamat" value="<?= htmlspecialchars($data['Alamat']) ?>"><br>
        <label>Pemilik:</label><br>
        <input type="text" name="Pemilik" value="<?= htmlspecialchars($data['Pemilik']) ?>"><br>
        <label>No Telepon:</label><br>
        <input type="text" name="No_Telpon" value="<?= htmlspecialchars($data['No_Telpon']) ?>"><br>
        <button type="submit" name="update">Update</button>
        <br>
        <br>
    </form>
    <br>
    <a href="pelanggan.php" class="btn btn-primary">Kembali</a>
    
    </div>
</body>
</html>
