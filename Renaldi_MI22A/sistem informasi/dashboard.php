<?php
include 'menu.php';
include 'db.php';

$data_users = mysqli_query($koneksi,"SELECT * FROM users");
$data_pelangan= mysqli_query($koneksi,"SELECT * FROM tbl_pelangan");
$data_transaksi = mysqli_query($koneksi,"SELECT * FROM t_catatan_transaksi");

// Menghitung jumlah stok
$query_total_stok = "SELECT SUM(jumlah) AS total_stok FROM m_stok";
$result_total_stok = mysqli_query($koneksi, $query_total_stok);
$total_stok = 0;
if ($row_stok = mysqli_fetch_assoc($result_total_stok)) {
    $total_stok = $row_stok['total_stok'];
}

// Menghitung total stok yang dikeluarkan berdasarkan transaksi
$query_total_dikeluarkan = "SELECT SUM(jumlah) AS total_dikeluarkan FROM t_catatan_transaksi";
$result_total_dikeluarkan = mysqli_query($koneksi, $query_total_dikeluarkan);
$total_dikeluarkan = 0;
if ($row_transaksi = mysqli_fetch_assoc($result_total_dikeluarkan)) {
    $total_dikeluarkan = $row_transaksi['total_dikeluarkan'];
}

// Menghitung sisa stok
$sisa_stok = $total_stok - $total_dikeluarkan;

// Menghitung total harga transaksi (misalnya menggunakan harga_satuan dan jumlah)
$query_total_harga = "
    SELECT SUM(jumlah * harga_per_unit) AS total_harga 
    FROM t_catatan_transaksi
";
$result_total_harga = mysqli_query($koneksi, $query_total_harga);
$total_harga = 0;
if ($row_harga = mysqli_fetch_assoc($result_total_harga)) {
    $total_harga = $row_harga['total_harga'];
}

// Menghitung data lainnya
$jumlah_users = mysqli_num_rows($data_users);
$jumlah_pelangan = mysqli_num_rows($data_pelangan);
$jumlah_transaksi = mysqli_num_rows($data_transaksi);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .main {
        display: flex;
    }
    .content {
        width: 1500px;
        padding: 20px;
    }
    .content a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: black;
        margin-bottom: 10px;
    }
    .header {
        margin-bottom: 20px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
    }
    .cards {
        display: flex;
        gap: 20px;
    }
    .card {
        flex: 1;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(12, 12, 12, 0.1);
        text-align: center;
    }
    .card h2 {
        margin: 0;
        font-size: 18px;
        font-weight: normal;
    }
    .card p {
        font-size: 24px;
        margin: 10px 0 0 0;
    }
    </style>
</head>
<body>
    <main class="main">
        <div class="content">
            <div class="header">
                <h1>SELAMAT DATANG</h1>
            </div>    
            <div class="cards">
                <div class="card">
                    <h2>User</h2>
                    <p><?php echo $jumlah_users; ?></p>
                </div>
                <div class="card">
                    <h2>Stok Awal</h2>
                    <p><?php echo $total_stok; ?></p>
                    <a href="stok.php">Show-></a>
                </div>
                <div class="card">
                    <h2>Pelanggan</h2>
                    <p><?php echo $jumlah_pelangan; ?></p>
                    <a href="pelanggan.php">Show-></a>
                </div>
                <div class="card">
                    <h2>Catatan Transaksi</h2>
                    <p><?php echo $jumlah_transaksi; ?></p>
                    <a href="catatan_transaksi.php">Show-></a>
                </div>
                <div class="card">
                    <h2>Sisa Stok</h2>
                    <p><?php echo $sisa_stok; ?></p>
                </div>
                <div class="card">
                    <h2>Total Harga Transaksi</h2>
                    <p><?php echo number_format($total_harga, 2); ?></p> <!-- Format ke 2 desimal -->
                </div>
            </div>    
        </div>
    </main>
</body>
</html>
