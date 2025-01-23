# PANDUAN INSTALASI PROYEK LARAVEL DENGAN BREEZE

## Persyaratan Sistem
- PHP versi 8.1 atau lebih tinggi
- Composer (Manajer paket PHP)
- Node.js dan npm
- Database MySQL/MariaDB
- XAMPP/Laragon (Opsional)

## Langkah Instalasi Proyek

### 1. Prasyarat Awal
- Pastikan PHP, Composer, dan Node.js sudah terinstal
- Buka terminal/command prompt

### 2. Kloning Proyek
```bash
git clone

```

### 3. Instalasi Dependensi
```bash
# Instalasi dependensi PHP
composer install

# Instalasi dependensi Node.js
npm install
```

### 4. Konfigurasi Lingkungan
```bash
# Salin file environment
cp .env.example .env

# Generate kunci aplikasi
php artisan key:generate
```

### 5. Konfigurasi Database
- Buka file `.env`
- Sesuaikan pengaturan database:
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=nama_database
  DB_USERNAME=username
  DB_PASSWORD=password
  ```
- Buat database baru di MySQL

### 6. Migrasi Database
```bash
# Jalankan migrasi
php artisan migrate
```

### 7. Instalasi Breeze (Autentikasi)
```bash
# Instal Laravel Breeze
composer require laravel/breeze --dev

# Instal frontend dengan Blade
php artisan breeze:install blade

# Kompilasi aset
npm install
npm run build
```

### 8. Buat Symlink Penyimpanan
```bash
# Buat tautan simbolik untuk penyimpanan file
php artisan storage:link
```

### 9. Jalankan Server Pengembangan
```bash
# Jalankan server Laravel
php artisan serve

# Jalankan server pengembangan Node.js (di terminal terpisah)
npm run dev
```

```
