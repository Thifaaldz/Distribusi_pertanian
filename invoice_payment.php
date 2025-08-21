<?php
require_once "db.php";

$upload_status = '';
$upload_dir = __DIR__ . "/uploads/";

// Buat folder uploads jika belum ada
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Ambil input aman
$order_id       = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
$total_bill_in  = filter_input(INPUT_POST, 'total_bill', FILTER_VALIDATE_INT);
$payment_method = filter_input(INPUT_POST, 'payment_method', FILTER_UNSAFE_RAW);
$shipping_cost  = filter_input(INPUT_POST, 'shipping_cost', FILTER_VALIDATE_INT);

// Cek request upload file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_proof'])) {
    $file     = $_FILES['payment_proof'];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed  = ['jpg', 'jpeg', 'png', 'pdf'];

    if (!in_array($file_ext, $allowed)) {
        $upload_status = "Tipe file tidak valid.";
    } elseif ($file['size'] > 5 * 1024 * 1024) {
        $upload_status = "Ukuran file maksimal 5MB.";
    } elseif (is_uploaded_file($file['tmp_name'])) {
        // Random nama file
        $new_name   = uniqid("proof_", true) . "." . $file_ext;
        $target_file = $upload_dir . $new_name;

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            chmod($target_file, 0644); // keamanan

            // Nomor resi unik
            $tracking_number = "TRK" . strtoupper(uniqid());

            $conn->begin_transaction();
            try {
                // Update pesanan
                $stmt = $conn->prepare("UPDATE orders 
                    SET payment_proof = ?, payment_status = 'Paid', tracking_number = ? 
                    WHERE id = ?");
                $stmt->bind_param("ssi", $new_name, $tracking_number, $order_id);
                $stmt->execute();

                // Insert tracking log
                $stmt2 = $conn->prepare("INSERT INTO shipping_tracking (tracking_number, status) VALUES (?, 'Diproses')");
                $stmt2->bind_param("s", $tracking_number);
                $stmt2->execute();

                $conn->commit();
                header("Location: payment_success.php?tracking_number=" . urlencode($tracking_number));
                exit;
            } catch (Exception $e) {
                $conn->rollback();
                $upload_status = "DB Error: " . $e->getMessage();
            }
        } else {
            $upload_status = "Upload bukti pembayaran gagal.";
        }
    }
}

// Validasi input wajib
$missing_data = [];
if (!$order_id)       $missing_data[] = "Order ID";
if (!$total_bill_in)  $missing_data[] = "Total Tagihan";
if (!$payment_method) $missing_data[] = "Metode Pembayaran";
if (!$shipping_cost)  $missing_data[] = "Ongkos Kirim";

if ($missing_data) {
    echo "<h1>Data Tidak Lengkap</h1><ul>";
    foreach ($missing_data as $m) echo "<li>" . htmlspecialchars($m) . "</li>";
    echo "</ul>";
    exit;
}

// Ambil detail order
$stmt = $conn->prepare("SELECT o.*, b.nama AS item_name, b.harga AS item_price 
    FROM orders o 
    JOIN bahan_baku b ON o.bahan_id = b.id 
    WHERE o.id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
if (!$order) die("Order tidak ditemukan!");

// Hitung ulang server-side
$subtotal        = $order['item_price'] * $order['item_quantity'];
$protection_cost = 450000;
$app_fee         = 1500;
$grand_total     = $subtotal + $shipping_cost + $protection_cost;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Ndrella Agro Distribution</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 20px auto; background: #fff; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,.1); }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { color: #4CAF50; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table th { background-color: #f2f2f2; }
        .summary { padding: 10px; background: #f9f9f9; border: 1px solid #ddd; margin-top: 20px; }
        .summary .total { font-weight: bold; font-size: 16px; }
        .btn { padding: 10px 20px; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        .btn-upload { background: #4CAF50; }
        .btn-upload:hover { background: #45a049; }
        .btn-print { background: #007BFF; margin-top: 10px; }
        .btn-print:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="assets/imgs/avatar.png" alt="Logo" height="50">
        <h1>Invoice</h1>
    </div>

    <table>
        <tr><th>Produk</th><th>Jumlah</th><th>Harga/Kg</th><th>Total</th></tr>
        <tr>
            <td><?= htmlspecialchars($order['item_name']) ?></td>
            <td><?= htmlspecialchars($order['item_quantity']) ?> kg</td>
            <td>Rp <?= number_format($order['item_price'], 0, ',', '.') ?></td>
            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
        </tr>
    </table>

    <div class="summary">
        <p>Subtotal: Rp <?= number_format($subtotal, 0, ',', '.') ?></p>
        <p>Ongkir: Rp <?= number_format($shipping_cost, 0, ',', '.') ?></p>
        <p>Proteksi: Rp <?= number_format($protection_cost, 0, ',', '.') ?></p>
        <p class="total">Grand Total: Rp <?= number_format($grand_total, 0, ',', '.') ?></p>
        <p>Biaya Aplikasi: Rp <?= number_format($app_fee, 0, ',', '.') ?></p>
        <h3 class="total">TOTAL TAGIHAN: Rp <?= number_format($total_bill_in, 0, ',', '.') ?></h3>
    </div>

    <div class="upload-section" style="margin-top:20px;">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="payment_proof" id="payment_proof" required><br><br>
            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order_id) ?>">
            <input type="hidden" name="payment_method" value="<?= htmlspecialchars($payment_method) ?>">
            <input type="hidden" name="shipping_cost" value="<?= htmlspecialchars($shipping_cost) ?>">
            <input type="hidden" name="total_bill" value="<?= htmlspecialchars($total_bill_in) ?>">
            <button type="submit" class="btn btn-upload">Kirim</button>
        </form>
        <?php if ($upload_status): ?>
            <p><?= htmlspecialchars($upload_status) ?></p>
        <?php endif; ?>
    </div>

    <button class="btn btn-print" onclick="window.print();">Cetak</button>
</div>
</body>
</html>
