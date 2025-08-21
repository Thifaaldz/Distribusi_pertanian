<?php
session_start();
session_destroy(); // Menghapus semua sesi
header("Location: signin.php"); // Kembali ke halaman login
exit();
?>
