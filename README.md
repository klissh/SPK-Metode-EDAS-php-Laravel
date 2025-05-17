<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>


## 🧠 Sistem Pendukung Keputusan Metode EDAS

Aplikasi berbasis Laravel untuk membantu pengambilan keputusan menggunakan **metode EDAS (Evaluation Based on Distance from Average Solution)**. Proyek ini mendukung:
- Multi jenis analisis (misalnya pekerjaan, laptop, dll).
- Kriteria bertipe **Benefit** dan **Cost**.
- Penggunaan **sub-kriteria** untuk mewakili bobot kriteria.

---

## 🖼️ Tampilan Proyek SPK EDAS

### 1. Data Alternatif
![Data Alternatif](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/data-alternatif.png)

### 2. Data Kriteria
![Data Kriteria](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/data-kriteria.png)

### 3. Sub Kriteria
![Sub Kriteria](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/sub-kriteria.png)

### 4. Nilai Alternatif
![Nilai Alternatif](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/nilai-alternatif.png)

### 5. Hasil Perhitungan EDAS
![Hasil Perhitungan](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/hasil-perhitungan.png)

### 6. Jenis Analisis
![Jenis Analisis](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/jenis_analisis.png)

### 7. Login
![Login](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/login.png)

### 8. Register
![Register](https://raw.githubusercontent.com/klissh/SPK-Metode-EDAS-php-Laravel/main/img/register.png)

---

## ⚙️ Cara Menggunakan Proyek Laravel Ini

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini secara lokal:

### 1. Clone Repository
```bash
git clone https://github.com/klissh/SPK-Metode-EDAS-php-Laravel.git
cd SPK-Metode-EDAS-php-Laravel 
```
### 2. Install Dependency
Pastikan Composer dan Node.js telah terinstall. Jalankan perintah berikut untuk menginstal dependency PHP dan JavaScript:
```bash
composer install
npm install && npm run dev
```
### 3. Setup Environment
Salin file .env.example menjadi .env lalu generate application key:
```bash
cp .env.example .env
php artisan key:generate
```
### 4. Atur Database
Buat database baru di MySQL/MariaDB, misalnya: spk_edas
Edit file .env sesuai konfigurasi:
```bash
DB_DATABASE=spk_edas
DB_USERNAME=root
DB_PASSWORD=your_password
```
### 5. Jalankan Migrasi & Seeder (opsional)
Lakukan migrasi untuk membuat struktur tabel dan isi data awal (jika ada seeder):
```bash
php artisan migrate
php artisan db:seed
```
### 6. Jalankan Server Lokal
Mulai server Laravel lokal:
```bash
php artisan serve
```
### 7. Akses Aplikasi
Buka browser dan kunjungi alamat berikut:
```bash
http://127.0.0.1:8000
```