# Payroll Approval - Technical Test

Sebuah proyek sistem persetujuan payroll berbasis web yang dibangun menggunakan Laravel sebagai backend framework dan Alpine.js untuk interaktivitas frontend. Proyek ini merupakan bagian dari **technical test**.

## 🚀 Stack Teknologi

- **Laravel** (v10+)
- **Laravel Breeze** (starter kit autentikasi)
- **Alpine.js** (frontend interaktivitas ringan)
- **Tailwind CSS** (melalui Breeze)
- **MySQL** / Database lainnya

## ⚙️ Fitur Utama

- Login & Register (default dari Breeze)
- Tampilan daftar payroll
- Proses pengajuan payroll
- Proses approval atau penolakan payroll
- Notifikasi hasil persetujuan

## 📦 Instalasi

Langkah-langkah untuk menjalankan project ini secara lokal:

### 1. Clone Repository

```bash
git clone https://github.com/aliffadhil28/payroll-approval.git
cd payroll-approval
````

### 2. Install Dependency

```bash
composer install
npm install && npm run dev
```

### 3. Setup Environment

Salin file `.env.example` ke `.env` dan atur konfigurasi database:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrasi dan Seeder

```bash
php artisan migrate --seed
```

### 5. Buat Storage Link

```bash
php artisan storage:link
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses proyek di: `http://localhost:8000`

## ✅ Catatan Tambahan

* Breeze menggunakan Vite untuk asset bundling, pastikan `npm run dev` aktif saat development.
* Login default (dari seeder jika tersedia):

  * Email: `finance@gmail.com`
  * Password: `password`

  * Email: `director@gmail.com`
  * Password: `password`

  * Email: `user@gmail.com`
  * Password: `password`

  * Email: `director@gmail.com`
  * Password: `password`

## 📃 Lisensi

Proyek ini dikembangkan untuk keperluan technical test dan tidak memiliki lisensi khusus.

```
