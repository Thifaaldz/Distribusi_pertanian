<?php 
// Include file koneksi database
include 'db.php';

// Variabel untuk menyimpan pesan error atau sukses
$error = '';
$success = '';

// Proses jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi password dan confirm password
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Query insert data ke tabel users
        $query = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $fullname, $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now login.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registrasi.css">
    <title>Register | Ndrella Agro Distribution</title>

    <!-- Tambahkan CSS untuk pop-up dan animasi -->
    <style>
        /* Pop-up CSS */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
            z-index: 1000;
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        /* Efek animasi pop-up muncul */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .popup.active {
            display: block;
        }

        .popup p {
            margin: 10px 0;
        }

        .popup .close-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        /* Animasi overlay */
        .overlay.active {
            animation: fadeOverlay 0.3s forwards;
        }

        @keyframes fadeOverlay {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Tambahkan styling untuk logo berhasil */
        .popup img {
            width: 50px;
            margin-bottom: 15px;
        }
    </style>

</head>
<body>
    <div class="register-container">
        <!-- Left Section -->
        <div class="left-section">
            <div class="logo">
                <img src="assets/imgs/avatar.png" alt="Ndrella Agro Logo">
            </div>
            <h1>Ndrella Agro Distribution</h1>
            <p>Start Growing with Us</p>
            <img class="promo-image" src="assets/imgs/field1.jpg" alt="Farming Image">
            <div class="social-links">
                <a href="#"><img src="assets/imgs/instagramw.png" alt="Instagram"></a>
                <a href="#"><img src="assets/imgs/xw.png" alt="Twitter"></a>
                <a href="#"><img src="assets/imgs/linkedinw.png" alt="LinkedIn"></a>
            </div>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h2>REGISTER PAGE</h2>

            <!-- Tampilkan pesan error atau sukses -->
            <?php if (!empty($error)) { ?>
                <p style="color: red;"><?= $error; ?></p>
            <?php } ?>
            <?php if (!empty($success)) { ?>
                <p style="color: green;"><?= $success; ?></p>
            <?php } ?>

            <form method="POST" action="">
                <input type="text" name="fullname" placeholder="Full Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit">Sign Up</button>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>

    <!-- Pop-up dan Overlay -->
    <div class="overlay" id="overlay"></div>
    <div class="popup" id="popup">
        <img src="assets/imgs/testt.png" alt="Success Icon"> <!-- Logo berhasil -->
        <p id="popup-message"><?= $success ? $success : ''; ?></p>
        <button class="close-btn" id="close-btn">Close</button>
    </div>

    <!-- JavaScript untuk menampilkan pop-up -->
    <script>
        <?php if (!empty($success)) { ?>
            // Tampilkan pop-up jika sukses
            document.getElementById('popup').classList.add('active');
            document.getElementById('overlay').classList.add('active');
        <?php } ?>

        // Fungsi untuk menutup pop-up
        document.getElementById('close-btn').addEventListener('click', function() {
            document.getElementById('popup').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });
    </script>

</body>
</html>
