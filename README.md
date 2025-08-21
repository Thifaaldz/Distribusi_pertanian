# Distribusi Pertanian

Sebuah aplikasi berbasis web untuk mendukung distribusi produk pertanian, termasuk pemesanan bibit, konsultasi pertanian, dan manajemen pembayaran.

## Fitur Utama

* **Pemesanan Bibit**: Pengguna dapat memesan bibit tanaman secara online.
* **Konsultasi Pertanian**: Fasilitas bagi pengguna untuk berkonsultasi mengenai pertanian.
* **Manajemen Pembayaran**: Pengelolaan transaksi pembayaran untuk pembelian bibit dan layanan konsultasi.

## Teknologi yang Digunakan

* **PHP**: Bahasa pemrograman utama untuk backend.
* **MySQL**: Database untuk menyimpan data pengguna, pesanan, dan transaksi.
* **Docker**: Untuk containerization aplikasi dan database.

## Struktur Direktori

* `assets/`: File pendukung seperti gambar dan stylesheet.
* `uploads/`: Tempat penyimpanan file yang diunggah pengguna.
* `vendor/`: Dependensi PHP yang digunakan dalam proyek.
* `mysql-init/`: Script untuk inisialisasi database.
* `dockerfile`: File konfigurasi untuk membangun image Docker aplikasi.
* `docker-compose.yml`: File konfigurasi untuk menjalankan aplikasi dan database menggunakan Docker Compose.
* `db.php`: Script untuk koneksi ke database.
* `index.php`: Halaman utama aplikasi.
* `login.php`: Halaman login pengguna.
* `login_karyawan.php`: Halaman login untuk karyawan.
* `form_bibit.php`: Formulir untuk pemesanan bibit.
* `form_pesanan.php`: Formulir untuk detail pesanan.
* `formconsul.php`: Formulir untuk konsultasi pertanian.
* `invoice_payment.php`: Halaman untuk pembayaran tagihan.
* `footer.php`: Bagian footer dari halaman web.
* `header.php`: Bagian header dari halaman web.

## Instalasi

1. Clone repositori ini ke mesin lokal Anda.
2. Jalankan perintah berikut untuk membangun dan menjalankan aplikasi menggunakan Docker:

   ```bash
   docker-compose up --build
   ```
3. Akses aplikasi melalui browser di `http://localhost`.

## Kontribusi

Kontribusi sangat diterima! Silakan fork repositori ini, buat cabang baru, dan ajukan pull request dengan deskripsi perubahan yang Anda buat.
