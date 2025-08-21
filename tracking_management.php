<?php
include 'db.php';

// Fungsi untuk mengambil semua data tracking
function getAllTracking($conn) {
    $sql = "SELECT st.id, st.tracking_number, st.status, st.last_updated, o.full_name AS sender_name, o.company_name AS receiver_name FROM shipping_tracking st JOIN orders o ON st.tracking_number = o.tracking_number";
    $result = $conn->query($sql);
    $trackings = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $trackings[] = $row;
        }
    }
    return $trackings;
}

// Fungsi untuk memperbarui status tracking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tracking_id = $_POST['tracking_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE shipping_tracking SET status = ?, last_updated = NOW() WHERE id = ?");
    $stmt->bind_param("si", $status, $tracking_id);

    if ($stmt->execute()) {
        $message = "Status berhasil diperbarui.";
    } else {
        $message = "Gagal memperbarui status.";
    }
}

$trackings = getAllTracking($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tracking</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .header img {
            height: 60px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table th, table td {
            border: 1px solid #e0e0e0;
            padding: 12px 10px;
            text-align: center;
        }
        table th {
            background-color: #f5f5f5;
            color: #333;
            font-weight: bold;
        }
        table tbody tr:hover {
            background-color: #f9f9f9;
        }
        .status {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .status select {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tracking Management</h1>
            <img src="assets/imgs/avatar.png" alt="Logo">
        </div>

        <?php if (isset($message)): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Nomor Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Status</th>
                    <th>Terakhir Diperbarui</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trackings as $tracking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($tracking['tracking_number']); ?></td>
                        <td>PT. Ndrella Agro Distribution</td>
                        <td><?php echo htmlspecialchars($tracking['receiver_name']); ?></td>
                        <td><?php echo htmlspecialchars($tracking['status']); ?></td>
                        <td><?php echo htmlspecialchars($tracking['last_updated']); ?></td>
                        <td>
                            <form method="POST" class="status">
                                <input type="hidden" name="tracking_id" value="<?php echo htmlspecialchars($tracking['id']); ?>">
                                <select name="status">
                                    <option value="Diproses" <?php echo $tracking['status'] === 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                                    <option value="Dikemas" <?php echo $tracking['status'] === 'Dikemas' ? 'selected' : ''; ?>>Dikemas</option>
                                    <option value="Dikirim" <?php echo $tracking['status'] === 'Dikirim' ? 'selected' : ''; ?>>Dikirim</option>
                                    <option value="Diterima" <?php echo $tracking['status'] === 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
