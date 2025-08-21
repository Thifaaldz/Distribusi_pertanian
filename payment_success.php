<?php
$tracking_number = $_GET['tracking_number'] ?? 'Tidak tersedia';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 50px;
        }
        .header h1 {
            color: #4CAF50;
            font-size: 24px;
        }
        .content {
            text-align: center;
            font-size: 18px;
            color: #333;
            margin: 20px 0;
        }
        .tracking-info {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }
        .action-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="assets/imgs/avatar.png" alt="Logo Ndrella Agro Distribution">
            <h1>Pembayaran Berhasil!</h1>
        </div>

        <div class="content">
            <p>Terima kasih telah melakukan pembayaran. Pembayaran Anda telah diterima dengan sukses.</p>
            <p class="tracking-info">Nomor Resi Anda: <?php echo htmlspecialchars($tracking_number); ?></p>
            <a href="index.php" class="action-button">Kembali Ke Halaman Utama</a>
        </div>

        <div class="footer">
            <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
            <button class="print-button" onclick="window.print();">Cetak</button>
        </div>
    </div>
</body>
</html>
