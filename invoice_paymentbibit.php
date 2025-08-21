<?php
// Koneksi ke database
include 'db.php';


$upload_status = '';
$upload_dir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_proof'])) {
    $file = $_FILES['payment_proof'];
    $file_name = basename($file['name']);
    $target_file = $upload_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
    if (!in_array($file_type, $allowed_types)) {
        $upload_status = "Tipe file tidak valid. Hanya JPG, JPEG, PNG, atau PDF yang diizinkan.";
    } elseif ($file['size'] > 5000000) {
        $upload_status = "Ukuran file terlalu besar. Maksimal 5MB.";
    } else {
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $upload_status = "Bukti pembayaran berhasil diunggah.";

            $order_id = $_POST['order_id'];
            $payment_method = $_POST['payment_method'];
            $shipping_cost = $_POST['shipping_cost'];

            // Generate nomor resi
            $tracking_number = "TRK" . strtoupper(uniqid());

            // Update data pesanan
            $stmt = $conn->prepare("UPDATE orders_bibit  SET payment_proof = ?, payment_status = 'Paid', tracking_number = ? WHERE id = ?");
            $stmt->bind_param("ssi", $file_name, $tracking_number, $order_id);
            $stmt->execute();

            // Tambahkan entri ke tabel tracking
            $stmt_tracking = $conn->prepare("INSERT INTO shipping_tracking (tracking_number, status) VALUES (?, 'Diproses')");
            $stmt_tracking->bind_param("s", $tracking_number);
            $stmt_tracking->execute();

            // Redirect ke halaman sukses pembayaran
            header("Location: payment_success.php?tracking_number=$tracking_number");
            exit();
        } else {
            $upload_status = "Gagal mengunggah bukti pembayaran.";
        }
    }
}

// Ambil data dari POST
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : null;
$total_bill = isset($_POST['total_bill']) ? $_POST['total_bill'] : null;
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
$shipping_cost = isset($_POST['shipping_cost']) ? $_POST['shipping_cost'] : null;

// Validasi input
$missing_data = [];
if (!$order_id) $missing_data[] = "Order ID";
if (!$total_bill) $missing_data[] = "Total Tagihan";
if (!$payment_method) $missing_data[] = "Metode Pembayaran";
if (!$shipping_cost) $missing_data[] = "Ongkos Kirim";

if (!empty($missing_data)) {
    echo "<h1>Data Tidak Lengkap</h1>";
    echo "<p>Silakan lengkapi data berikut:</p><ul>";
    foreach ($missing_data as $missing) echo "<li>$missing</li>";
    echo "</ul>";
    exit();
}

// Ambil detail order berdasarkan order_id
$stmt = $conn->prepare("SELECT o.*, b.nama AS item_name, b.harga AS item_price FROM orders_bibit o JOIN bahan_bakubibit b ON o.bahan_id = b.id WHERE o.id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Order tidak ditemukan!");
}
$order = $result->fetch_assoc();

// Hitung total harga
$subtotal = $order['item_price'] * $order['item_quantity'];
$protection_cost = 450000; // Biaya tetap proteksi
$app_fee = 1500;           // Biaya aplikasi
$grand_total = $subtotal + $shipping_cost + $protection_cost;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Ndrella Agro Distribution</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 20px;
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
            margin: 0;
            font-size: 24px;
            color: #4CAF50;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info div {
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 20px;
            font-size: 14px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .summary p {
            margin: 5px 0;
        }
        .summary .total {
            font-weight: bold;
            font-size: 16px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .upload-container {
            text-align: center;
            margin: 20px 0;
        }
        .custom-upload-button {
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .custom-upload-button:hover {
            background-color: #45a049;
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
            <img src="assets/imgs/avatar.png" alt="Logo Ndrella Agro Distribution">
            <h1>Invoice</h1>
        </div>

        <div class="info">
            <div>
                <strong>DITERBITKAN OLEH:</strong><br>
                Ndrella Agro Distribution
            </div>
            <div>
                <strong>UNTUK:</strong><br>
                <?php echo htmlspecialchars($order['shipping_address']); ?>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Perkilo</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($order['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['item_quantity']); ?> kg</td>
                    <td>Rp <?php echo number_format($order['item_price'], 0, ',', '.'); ?></td>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="summary">
            <p>Subtotal Harga Barang: Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></p>
            <p>Diskon: -</p>
            <p>Ongkos Kirim: Rp <?php echo number_format($shipping_cost, 0, ',', '.'); ?></p>
            <p>Proteksi Barang: Rp <?php echo number_format($protection_cost, 0, ',', '.'); ?></p>
            <p class="total">Grand Total: Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></p>
            <p>Biaya Jasa Aplikasi: Rp <?php echo number_format($app_fee, 0, ',', '.'); ?></p>
            <h3 class="total">TOTAL TAGIHAN: Rp <?php echo number_format($total_bill, 0, ',', '.'); ?></h3>
        </div>

        <div class="footer">
            <p>Metode Pembayaran: <?php echo htmlspecialchars($payment_method); ?></p>
            <p>Transfer via <?php echo htmlspecialchars($payment_method); ?></p>
            <p>A/C: 164-077-017</p>
            <p>A/N: PT. Ndrella Agro Distribution</p>
        </div>

        <div class="upload-section">
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="payment_proof" class="custom-upload-button">Unggah Bukti Pembayaran</label>
                <input type="file" name="payment_proof" id="payment_proof" style="display:none;"required>
                <input type="hidden" name="order_id" value="<?php echo $_POST['order_id']; ?>">
                <input type="hidden" name="payment_method" value="<?php echo $_POST['payment_method']; ?>">
                <input type="hidden" name="shipping_cost" value="<?php echo $_POST['shipping_cost']; ?>">
                <button type="submit" class="custom-upload-button">Kirim</button>
            </form>
            <?php if ($upload_status): ?>
                <p><?php echo htmlspecialchars($upload_status); ?></p>
            <?php endif; ?>
        </div>

        <button class="print-button" onclick="window.print();">Cetak</button>
    </div>
</body>
</html>
