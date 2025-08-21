<?php
include 'db.php';


$error_message = null; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tracking_number = $_POST['tracking_number'] ?? '';

    if ($tracking_number) {
        // Redirect ke halaman tracking jika nomor resi diberikan
        header("Location: tracking_pagebibit.php?tracking_number=" . urlencode($tracking_number));
        exit;
    } else {
        $error_message = "Nomor resi harus diisi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Tracking</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('assets/imgs/trackingbc.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #FFFFFF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .tracking-container {
            width: 80%;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0); /* Warna overlay hitam transparan */
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0);
        }

        .tracking-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }

        .tracking-container input[type="text"] {
            width: 90%;
            padding: 15px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid white;
            border-radius: 10px;
            background-color: #8B5A2B;
            color: white;
        }

        .tracking-container input[type="text"]::placeholder {
            color: #FFFFFF;
            opacity: 0.8;
        }

        .tracking-container button {
            padding: 15px;
            font-size: 18px;
            background-color: #C1FF00; /* Warna hijau terang */
            color: #333333;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 90%;
        }

        .tracking-container button:hover {
            background-color: #B4E600; /* Hijau lebih gelap */
        }

        .icon-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .icon-container img {
            width: 40px;
            height: 40px;
        }

        .error {
            color: red;
            margin-top: -15px;
        }
    </style>
</head>
<body>
    <div class="tracking-container">
        <div class="icon-container">
            <img src="assets/imgs/location.png" alt="Location">
            <img src="assets/imgs/box.png" alt="Box">
            <img src="assets/imgs/truck.png" alt="Truck">
        </div>
        <h1>Package Tracking</h1>
        <p>Input Receipt Code</p>
        <?php if ($error_message): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="tracking_number" placeholder="Input Receipt Code" required>
            <button type="submit">Track your Package</button>
        </form>
    </div>
</body>
</html>
