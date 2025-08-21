<?php
include 'db.php';

// Ambil data dari formulir
$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$location = $_POST['location'];
$size = $_POST['size'];
$crops = $_POST['crops'];
$consultation = $_POST['consultation'];
$time = $_POST['time'];
$notes = $_POST['notes'];

// SQL untuk menyimpan data
$sql = "INSERT INTO submissions (name, contact, email, location, size, crops, consultation, time, notes) 
        VALUES ('$name', '$contact', '$email', '$location', $size, '$crops', '$consultation', '$time', '$notes')";

// Eksekusi query
if ($conn->query($sql) === TRUE) {
    // Tampilkan halaman sukses
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengisian Berhasil</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
            }
            /* Header Styling */
            .header {
                background-color: #28a745;
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

            /* Success Container Styling */
            .container {
                max-width: 800px;
                margin: 50px auto;
                background: #ffffff;
                padding: 30px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                text-align: center;
            }
            .container h1 {
                font-size: 26px;
                color: #28a745;
                margin-bottom: 20px;
            }
            .container p {
                font-size: 16px;
                color: #555;
                margin-bottom: 20px;
            }
            .button {
                display: inline-block;
                text-decoration: none;
                background-color: #28a745;
                color: #ffffff;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 16px;
                margin: 10px;
                transition: background-color 0.3s ease;
            }
            .button:hover {
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

        <!-- Success Container -->
        <div class="container">
            <h1>Pengisian Berhasil!</h1>
            <p>Terima kasih, ' . htmlspecialchars($name) . ', telah mengisi formulir. Kami akan segera menghubungi Anda.</p>
            <p>Jika Anda membutuhkan bantuan segera, hubungi kami melalui WhatsApp dengan mengklik tombol di bawah:</p>
            <a href="https://wa.me/6282124397545" class="button" target="_blank">Hubungi Kami via WhatsApp</a>
            <a href="index.php" class="button">Kembali Ke Beranda</a>
        </div>
    </body>
    </html>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
