# Keyboard Catalogue – Dokumentasi Proyek

> Platform e-commerce keyboard mekanik dengan fitur admin management, user authentication, order management, dan top-up system.

## 📋 Daftar Isi
- [Ringkasan Proyek](#ringkasan-proyek)
- [Fitur Utama](#fitur-utama)
- [Struktur Proyek](#struktur-proyek)
- [Teknologi](#teknologi)
- [Setup & Instalasi](#setup--instalasi)
- [Database Schema](#database-schema)
- [Panduan Penggunaan](#panduan-penggunaan)

---

## 📌 Ringkasan Proyek

**Keyboard Katalog** adalah aplikasi web Laravel yang menyediakan katalog keyboard mekanik lengkap dengan sistem e-commerce. Pengguna dapat browsing keyboard, melakukan pembelian dengan sistem balance, dan admin dapat mengelola inventory, pesanan, serta top-up request dari pengguna.

### Target Users
- **Admin**: Mengelola katalog keyboard, menerima/menolak top-up, tracking order
- **Guest (Pembeli)**: Browsing keyboard, membeli dengan saldo, request top-up saldo
- **Visitor**: Melihat katalog tanpa harus login

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Profil
- Registrasi dan login pengguna
- Update profil (nama, email, foto, alamat)
- Ubah password
- Sistem role (Admin/Guest)

### 🛒 Katalog & Pembelian
- **Browsing Keyboard**: Filter by brand, connection, layout, price range
- **Detail Produk**: Informasi lengkap + zoom hover pada gambar
- **Pembelian**: Dengan sistem balance/saldo pengguna
- **Tracking Stok**: Real-time stock availability

### 👨‍💼 Admin Management
- **Keyboard Management**: CRUD keyboard dengan upload gambar
- **Order Management**: Lihat semua order, update status (Pending → Processing → Shipped → Delivered)
- **User Management**: Kelola daftar user, hapus user
- **Top-Up Management**: Approve/reject request top-up dari user

### 💳 Top-Up & Balance
- User dapat request top-up saldo
- Admin dapat approve/reject request
- Track riwayat top-up

### 📦 Order Management
- User dapat tracking pesanan
- Admin dapat update status order
- Notifikasi status perubahan
- Disable update button untuk order yang sudah delivered/cancelled

---

## 📁 Struktur Proyek

```
KeyboardKatalaog/
├── app/
│   ├── Keyboard.php              # Model Keyboard
│   ├── User.php                  # Model User
│   ├── Order.php                 # Model Order
│   ├── TopUp.php                 # Model TopUp
│   ├── Notification.php          # Model Notification
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── KeyboardController.php
│   │   │   ├── UserController.php
│   │   │   ├── OrderController.php
│   │   │   ├── TopUpController.php
│   │   │   ├── VisitorController.php
│   │   │   └── NotificationController.php
│   │   ├── Kernel.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Console/
│   │   └── Kernel.php
│   ├── Exceptions/
│   │   └── Handler.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2025_11_01_122850_create_keyboards_table.php
│   │   ├── 2025_12_15_143814_add_role_to_users_table.php
│   │   ├── 2025_12_15_194523_add_balance_and_address_to_users_table.php
│   │   ├── 2025_12_15_194536_create_topups_table.php
│   │   ├── 2025_12_15_194545_create_orders_table.php
│   │   ├── 2025_12_15_194551_create_notifications_table.php
│   │   └── 2025_12_17_121014_add_stock_to_keyboards_table.php
│   ├── factories/
│   │   ├── KeyboardFactory.php
│   │   └── UserFactory.php
│   └── seeds/
│       ├── DatabaseSeeder.php
│       ├── KeyboardSeeder.php
│       └── UserSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── keyboards/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   ├── edit.blade.php
│   │   │   └── show.blade.php
│   │   ├── orders/
│   │   │   ├── index.blade.php
│   │   │   ├── admin-index.blade.php
│   │   │   └── show.blade.php
│   │   ├── topups/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── admin-index.blade.php
│   │   ├── users/
│   │   │   └── index.blade.php
│   │   ├── profile/
│   │   │   ├── edit.blade.php
│   │   │   └── password.blade.php
│   │   └── home.blade.php
│   ├── js/
│   └── sass/
├── routes/
│   ├── web.php
│   ├── api.php
│   ├── channels.php
│   └── console.php
├── storage/
│   ├── app/
│   └── logs/
├── tests/
│   ├── Feature/
│   └── Unit/
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── storage/ (symlink)
├── config/
├── bootstrap/
├── vendor/
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🛠 Teknologi

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Backend | Laravel | 6.x |
| Frontend | Bootstrap | 4.5 |
| Database | MySQL | 5.7+ |
| PHP | PHP | 7.4+ |
| JavaScript | jQuery + DataTables | - |
| Icons | Bootstrap Icons | 1.x |

---

## 🚀 Setup & Instalasi

### Prasyarat
- PHP 7.4+
- MySQL 5.7+

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd KeyboardKatalaog
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   - Edit `.env` dan atur koneksi MySQL
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=keyboard_katalog
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrasi & Seed Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Server**
   ```bash
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000`

### Akun Demo
- **Admin**: `admin@example.com` / `password`
- **Guest**: `user@example.com` / `password`

---

## 🗄 Database Schema

### Tabel Users
```sql
id, name, email, password, role (admin/guest), foto, alamat, balance, created_at, updated_at
```

### Tabel Keyboards
```sql
id, name, brand, switch_type, layout, connection, price, stock, 
release_date, image_url, hot_swappable, description, created_at, updated_at
```

### Tabel Orders
```sql
id, user_id, keyboard_id, quantity, total_price, status, notes, created_at, updated_at
```

### Tabel TopUps
```sql
id, user_id, amount, status (pending/approved/rejected), created_at, updated_at
```

### Tabel Notifications
```sql
id, user_id, type, message, read_at, created_at, updated_at
```

---

## 📖 Panduan Penggunaan

### Untuk Admin

1. **Kelola Keyboard**
   - Login sebagai admin
   - Navigasi ke `/keyboards`
   - Klik "+ Tambah Keyboard" untuk menambah produk baru
   - Edit atau hapus keyboard dari list

2. **Kelola Pesanan**
   - Navigasi ke `/admin/orders`
   - Lihat semua order dari customer
   - Update status order: Pending → Processing → Shipped → In Distribution → Delivered
   - Tombol update akan disable untuk order yang sudah delivered/cancelled

3. **Kelola Top-Up**
   - Navigasi ke `/admin/topups`
   - Review request top-up dari user
   - Approve atau reject request

4. **Kelola User**
   - Navigasi ke `/users`
   - Lihat daftar semua user
   - Hapus user jika perlu

### Untuk Guest (Pengguna)

1. **Registrasi & Login**
   - Klik Register untuk membuat akun baru
   - Login dengan email dan password

2. **Browse Keyboard**
   - Di halaman katalog, gunakan filter untuk mencari keyboard
   - Filter by: Brand, Connection, Layout, Price Range
   - Klik keyboard untuk lihat detail lengkap

3. **Beli Keyboard**
   - Pilih keyboard
   - Tentukan jumlah
   - Klik "Beli Sekarang"
   - Saldo akan berkurang sesuai total harga

4. **Request Top-Up**
   - Navigasi ke `/topups`
   - Klik "Request Top-Up"
   - Masukkan jumlah saldo yang ingin ditambah
   - Tunggu approval dari admin

5. **Tracking Pesanan**
   - Navigasi ke `/orders`
   - Lihat status semua pesanan Anda
   - Lihat detail pesanan dengan klik order number

---

## 🎨 Fitur UI/UX

- **Image Zoom**: Hover pada gambar keyboard untuk zoom 1.5x
- **Responsive Design**: Optimized untuk mobile, tablet, dan desktop
- **Data Tables**: Search, sort, dan pagination untuk list keyboard & order
- **Flash Messages**: Notifikasi sukses/error setelah aksi
- **Form Validation**: Server-side validation dengan error messages

---

## 📝 Format Penamaan File

- **Controller**: `{Entity}Controller.php` (contoh: `KeyboardController.php`)
- **Model**: `{Entity}.php` (contoh: `Keyboard.php`)
- **View**: `{entity}/{action}.blade.php` (contoh: `keyboards/index.blade.php`)
- **Migration**: `{YYYY_MM_DD_HHMMSS}_{description}.php`
- **Route**: Gunakan resource routes atau named routes

---

## 🔒 Middleware & Authorization

- **Admin Middleware**: Hanya admin yang bisa akses `/keyboards/create`, `/admin/orders`, dll
- **Auth Middleware**: Hanya user yang login bisa akses `/orders`, `/topups`
- **Guest Middleware**: Hanya user yang belum login bisa akses `/login`, `/register`

---

## 🐛 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| "Column not found" error | Jalankan `php artisan migrate:fresh --seed` |
| Gambar tidak tampil | Jalankan `php artisan storage:link` |
| 404 Not Found | Pastikan route sudah didefinisikan di `routes/web.php` |
| Permission denied | Ubah permission folder storage: `chmod -R 755 storage/` |

---


**Last Updated**: December 17, 2025
