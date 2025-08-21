<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Konsultasi Pertanian</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('assets/imgs/headers.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        /* Header Styling */
        .header {
            background-color: #93a51b42;
            backdrop-filter: blur(10px);
            
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header img {
            height: 50px;
            display: block;
            margin: 0 auto 10px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        /* Form Container Styling */
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background: #93a51b42;
            backdrop-filter: blur(10px);
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-container h2 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            color: #fff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color:rgb(255, 255, 255);
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }
        .form-group textarea {
            resize: none;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<!-- Header Section -->
<div class="header">
    <img src="assets/imgs/avatar.png" alt="Logo Konsultasi Pertanian">
    <h1>Konsultasi Pertanian Ahli</h1>
</div>

<!-- Form Container -->
<div class="form-container">
    <h2>Form Permintaan Konsultasi</h2>
    <form action="procesformconsul.php" method="post">
        <!-- Informasi Pribadi -->
        <div class="form-group">
            <label for="name">Nama Lengkap:</label>
            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <div class="form-group">
            <label for="contact">Nomor Kontak:</label>
            <input type="text" id="contact" name="contact" placeholder="Masukkan nomor telepon/WhatsApp" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
        </div>

        <!-- Informasi Pertanian -->
        <div class="form-group">
            <label for="location">Alamat Pertanian:</label>
            <input type="text" id="location" name="location" placeholder="Masukkan alamat lokasi lahan Anda" required>
        </div>

        <div class="form-group">
            <label for="size">Luas Lahan (hektar):</label>
            <input type="number" id="size" name="size" placeholder="Contoh: 2.5" step="0.1" required>
        </div>

        <div class="form-group">
            <label for="crops">Jenis Tanaman yang Dibudidayakan:</label>
            <textarea id="crops" name="crops" rows="3" placeholder="Contoh: Padi, Jagung, Gandum"></textarea>
        </div>

        <!-- Jenis Konsultasi -->
        <div class="form-group">
            <label for="consultation">Jenis Konsultasi yang Dibutuhkan:</label>
            <select id="consultation" name="consultation" required>
                <option value="yield">Optimalisasi Hasil Panen</option>
                <option value="soil">Kesehatan Tanah</option>
                <option value="pest">Pengelolaan Hama dan Penyakit</option>
                <option value="irrigation">Manajemen Air dan Irigasi</option>
                <option value="other">Lainnya</option>
            </select>
        </div>

        <!-- Waktu Konsultasi -->
        <div class="form-group">
            <label for="time">Waktu yang Diinginkan:</label>
            <input type="datetime-local" id="time" name="time" required>
        </div>

        <!-- Catatan Tambahan -->
        <div class="form-group">
            <label for="notes">Catatan Tambahan:</label>
            <textarea id="notes" name="notes" rows="4" placeholder="Tambahkan informasi penting lainnya (opsional)"></textarea>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <button type="submit">Kirim Permintaan Konsultasi</button>
        </div>
    </form>
</div>

</body>
</html>
