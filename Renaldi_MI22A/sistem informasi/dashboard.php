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
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Dashboard</h1>
    <a href="logout.php" class="btn btn-primary">Logout</a>
</body>
</html>
