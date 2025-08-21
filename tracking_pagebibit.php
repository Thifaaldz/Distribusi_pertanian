<?php
include 'db.php';


// Ambil nomor resi dari query string
$tracking_number = $_GET['tracking_number'] ?? '';

$status = null; // Variabel untuk menyimpan status pengiriman
$order_details = null; // Variabel untuk menyimpan informasi pengirim dan penerima
$error_message = null; // Variabel untuk menyimpan pesan kesalahan

if ($tracking_number) {
    // Query ke tabel shipping_tracking berdasarkan nomor resi
    $stmt = $conn->prepare("SELECT st.tracking_number, st.status, st.last_updated, o.full_name AS sender_name, o.company_name AS receiver_name, o.shipping_address, o.city, o.province FROM shipping_tracking st JOIN orders_bibit o ON st.tracking_number = o.tracking_number WHERE st.tracking_number = ?");
    $stmt->bind_param("s", $tracking_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $status = $result->fetch_assoc();
    } else {
        $error_message = "Nomor resi tidak ditemukan. Pastikan nomor resi Anda benar.";
    }
} else {
    $error_message = "Nomor resi tidak diberikan.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tracking Pengiriman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .tracking-info {
            margin-bottom: 20px;
        }
        .tracking-info strong {
            display: block;
            margin-bottom: 5px;
        }
        .steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .step {
            text-align: center;
            flex: 1;
            position: relative;
        }
        .step:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e9ecef;
            z-index: 0;
        }
        .step-icon {
            background-color: #28a745;
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 1;
        }
        .step.completed .step-icon {
            background-color: #007bff;
        }
        .step:last-child:before {
            display: none;
        }
        .error {
            color: red;
            text-align: center;
            margin: 20px 0;
        }
        .back-button {
            display: block;
            text-align: center;
            margin: 20px 0;
        }
        .back-button a {
            color: white;
            text-decoration: none;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
        iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 8px;
            margin-top: 20px;
        }
        .print-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pelacakan Pengiriman</h1>
            <span>Resi: <?php echo htmlspecialchars($tracking_number); ?></span>
        </div>

        <?php if ($status): ?>
            <div class="tracking-info">
                <strong>Nama Pengirim:</strong>
                <?php echo htmlspecialchars($status['sender_name']); ?>
            </div>
            <div class="tracking-info">
                <strong>Nama Penerima:</strong>
                <?php echo htmlspecialchars($status['receiver_name']); ?>
            </div>
            <div class="tracking-info">
                <strong>Status Pengiriman:</strong>
                <?php echo htmlspecialchars($status['status']); ?>
            </div>
            <div class="tracking-info">
                <strong>Terakhir Diperbarui:</strong>
                <?php echo htmlspecialchars($status['last_updated']); ?>
            </div>

            <div class="steps">
                <?php 
                    $steps = ['Barang Dikemas', 'Pusat Sortir', 'Sedang Dikirim', 'Barang Diterima'];
                    $current_status = array_search($status['status'], $steps);
                    foreach ($steps as $index => $step):
                ?>
                    <div class="step <?php echo $index <= $current_status ? 'completed' : ''; ?>">
                        <div class="step-icon">✔</div>
                        <div><?php echo htmlspecialchars($step); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <iframe 
                src="https://maps.google.com/maps?q=Jakarta,Indonesia&z=15&output=embed"
                allowfullscreen>
            </iframe>
        <?php elseif ($error_message): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <div class="back-button">
            <a href="index.php">Kembali ke Halaman Utama</a>
            <button class="print-button" onclick="window.print();">Cetak</button>
        </div>
    </div>
</body>
</html>
