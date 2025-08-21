-- Buat user global
CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;

-- Grant untuk user laragon
GRANT ALL PRIVILEGES ON perkebunan.* TO 'laragon'@'%';

--- Membuat database
CREATE DATABASE IF NOT EXISTS perkebunan;
USE perkebunan;
-- Tabel pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from users;
-- Tabel pengajuan konsultasi
CREATE TABLE submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    location TEXT NOT NULL,
    size FLOAT NOT NULL,
    crops TEXT,
    consultation VARCHAR(50) NOT NULL,
    time DATETIME NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from submissions;
-- Tabel bahan baku
CREATE TABLE bahan_baku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

-- Tabel pesanan
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    company_name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    shipping_address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    additional_message TEXT,
    item_name VARCHAR(255) NOT NULL,
    item_price DECIMAL(10,2) NOT NULL,
    item_quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    bahan_id INT NOT NULL,
    payment_proof VARCHAR(255),
    payment_status ENUM('Pending', 'Paid') DEFAULT 'Pending',
    shipping_provider VARCHAR(100),
    tracking_number VARCHAR(100),
    FOREIGN KEY (bahan_id) REFERENCES bahan_baku(id)
);
CREATE TABLE shipping_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_number VARCHAR(100) NOT NULL UNIQUE,
    status VARCHAR(100) NOT NULL DEFAULT 'Diproses',
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select * from shipping_tracking;
-- Data awal bahan baku
INSERT INTO bahan_baku (nama, harga, gambar)
VALUES
    ('Durian Musang King', 150000, 'assets/imgs/produk/durian_musang_king.png'),
    ('Durian Montong', 120000, 'assets/imgs/produk/durian_montong.png'),
    ('Mangga Arumanis', 50000, 'assets/imgs/produk/mangga_arumanis.png'),
    ('Mangga Harum Manis', 55000, 'assets/imgs/produk/mangga_harum_manis.png'),
    ('Kelengkeng Kristal', 80000, 'assets/imgs/produk/kelengkeng_kristal.png'),
    ('Jeruk Keprok', 35000, 'assets/imgs/produk/jeruk_keprok.png'),
    ('Jeruk Santang', 40000, 'assets/imgs/produk/jeruk_santang.png'),
    ('Alpukat Mentega', 60000, 'assets/imgs/produk/alpukat_mentega.png'),
    ('Alpukat Hass', 75000, 'assets/imgs/produk/alpukat_hass.png'),
    ('Anggur Merah', 70000, 'assets/imgs/produk/anggur_merah.png'),
    ('Anggur Hijau', 80000, 'assets/imgs/produk/anggur_hijau.png'),
    ('Nangka Mini', 60000, 'assets/imgs/produk/nangka_mini.png'),
    ('Pisang Cavendish', 20000, 'assets/imgs/produk/pisang_cavendish.png'),
    ('Pisang Raja', 25000, 'assets/imgs/produk/pisang_raja.png'),
    ('Sirsak', 30000, 'assets/imgs/produk/sirsak.png'),
    ('Apel Malang', 40000, 'assets/imgs/produk/apel_malang.png'),
    ('Delima Merah', 45000, 'assets/imgs/produk/delima_merah.png'),
    ('Jambu Air Citra', 35000, 'assets/imgs/produk/jambu_air_citra.png'),
    ('Jambu Kristal', 40000, 'assets/imgs/produk/jambu_kristal.png'),
    ('Rambutan Rapiah', 30000, 'assets/imgs/produk/rambutan_rapiah.png');

select * from orders;
CREATE TABLE bahan_bakubibit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    gambar VARCHAR(255) NOT NULL
);
CREATE TABLE orders_bibit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    company_name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    shipping_address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    additional_message TEXT,
    item_name VARCHAR(255) NOT NULL,
    item_price DECIMAL(10,2) NOT NULL,
    item_quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    bahan_id INT NOT NULL,
    payment_proof VARCHAR(255),
    payment_status ENUM('Pending', 'Paid') DEFAULT 'Pending',
    shipping_provider VARCHAR(100),
    tracking_number VARCHAR(100),
    FOREIGN KEY (bahan_id) REFERENCES bahan_bakubibit(id)
);

INSERT INTO bahan_bakubibit (nama, harga, gambar)
VALUES
    ('Bibit Durian Musang King', 150000, 'assets/imgs/produk/bibit_durian_musang_king.png'),
    ('Bibit Durian Montong', 120000, 'assets/imgs/produk/bibit_durian_montong.png'),
    ('Bibit Mangga Arumanis', 50000, 'assets/imgs/produk/bibit_mangga_arumanis.png'),
    ('Bibit Mangga Harum Manis', 55000, 'assets/imgs/produk/bibit_mangga_harum_manis.png'),
    ('Bibit Kelengkeng Kristal', 80000, 'assets/imgs/produk/bibit_kelengkeng_kristal.png'),
    ('Bibit Jeruk Keprok', 35000, 'assets/imgs/produk/bibit_jeruk_keprok.png'),
    ('Bibit Jeruk Santang', 40000, 'assets/imgs/produk/bibit_jeruk_santang.png'),
    ('Bibit Alpukat Mentega', 60000, 'assets/imgs/produk/bibit_alpukat_mentega.png'),
    ('Bibit Alpukat Hass', 75000, 'assets/imgs/produk/bibit_alpukat_hass.png'),
    ('Bibit Anggur Merah', 70000, 'assets/imgs/produk/bibit_anggur_merah.png'),
    ('Bibit Anggur Hijau', 80000, 'assets/imgs/produk/bibit_anggur_hijau.png'),
    ('Bibit Nangka Mini', 60000, 'assets/imgs/produk/bibit_nangka_mini.png'),
    ('Bibit Pisang Cavendish', 20000, 'assets/imgs/produk/bibit_pisang_cavendish.png'),
    ('Bibit Pisang Raja', 25000, 'assets/imgs/produk/bibit_pisang_raja.png'),
    ('Bibit Sirsak', 30000, 'assets/imgs/produk/bibit_sirsak.png'),
    ('Bibit Apel Malang', 40000, 'assets/imgs/produk/bibit_apel_malang.png'),
    ('Bibit Delima Merah', 45000, 'assets/imgs/produk/bibit_delima_merah.png'),
    ('Bibit Jambu Air Citra', 35000, 'assets/imgs/produk/bibit_jambu_air_citra.png'),
    ('Bibit Jambu Kristal', 40000, 'assets/imgs/produk/bibit_jambu_kristal.png'),
    ('Bibit Rambutan Rapiah', 30000, 'assets/imgs/produk/bibit_rambutan_rapiah.png');
