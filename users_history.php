<?php
include 'db.php';

// Ambil riwayat pemesanan dari tabel orders
$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        /* Header Section */
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .header img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 15px;
        }

        .header .text {
            display: flex;
            flex-direction: column;
        }

        .header h2 {
            font-size: 24px;
            color: #000;
            margin: 0;
        }

        /* Pembatas Hijau */
        .separator {
            margin: 10px 0 20px 0;
            border-top: 4px solid #2ecc71;
            border-radius: 2px;
        }

        /* Judul Riwayat Pemesanan */
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Table Section */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        thead th {
            background-color: #2ecc71;
            color: white;
            padding: 12px;
            text-align: left;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="header">
    <img src="assets/imgs/avatar.png" alt="Ndrella Agro Distribution Logo">
    <div class="text">
        <h2>PT. Ndrella Agro Distribution</h2>
    </div>
</div>

<!-- Pembatas Hijau -->
<div class="separator"></div>

<!-- Title Section -->
<div class="title">Riwayat Pemesanan</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Alamat Pengiriman</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Provider Pengiriman</th>
                <th>Nomor Resi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['shipping_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td>Rp<?php echo number_format($row['item_price'], 2, ',', '.'); ?></td>
                    <td><?php echo $row['item_quantity']; ?></td>
                    <td>Rp<?php echo number_format($row['total_price'], 2, ',', '.'); ?></td>
                    <td class="status-<?php echo strtolower($row['payment_status']); ?>">
                        <?php echo $row['payment_status']; ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['shipping_provider'] ?: '-'); ?></td>
                    <td><?php echo htmlspecialchars($row['tracking_number'] ?: '-'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Tidak ada riwayat pemesanan.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
