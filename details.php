<?php
// Simulasi pengambilan data dari database
$nomor_resi = $_GET['nomor_resi'] ?? '123456';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    <link rel="stylesheet" href="assets/css/detailpengirimanstyles.css">
</head>
<body>
    <div class="container">
        <h1>Detail Pemesanan</h1>
        <table>
            <tr><th>Nomor Resi</th><td><?php echo htmlspecialchars($nomor_resi); ?></td></tr>
            <tr><th>Status</th><td>Dalam Pengiriman</td></tr>
        </table>

        <h2>Lokasi Pengiriman</h2>
        <div class="map">
            <iframe 
                width="100%" 
                height="400" 
                style="border: 0;" 
                loading="lazy" 
                allowfullscreen 
                referrerpolicy="no-referrer-when-downgrade" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126918.55815137133!2d106.68943047885612!3d-6.229728265276231!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e7b6d765d9%3A0x401577dd2fed200!2sJakarta!5e0!3m2!1sid!2sid!4v1633957624732!5m2!1sid!2sid">
            </iframe>
        </div>

        <a href="pengiriman.php" class="button">Kembali</a>
    </div>
</body>
</html>
