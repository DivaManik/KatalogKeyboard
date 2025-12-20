# Keyboard Catalogue – Dokumentasi Proyek

> Platform e-commerce keyboard mekanik dengan fitur admin management, user authentication, order management, top-up system, dan real-time notifications.

## 📋 Daftar Isi
- [Ringkasan Proyek](#ringkasan-proyek)
- [Fitur Utama](#fitur-utama)
- [Struktur Proyek](#struktur-proyek)
- [Teknologi](#teknologi)
- [Setup & Instalasi](#setup--instalasi)
- [Database Schema](#database-schema)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Architecture & Best Practices](#architecture--best-practices)

---

## 📌 Ringkasan Proyek

**Keyboard Katalog** adalah aplikasi web Laravel yang menyediakan katalog keyboard mekanik lengkap dengan sistem e-commerce. Pengguna dapat browsing keyboard, melakukan pembelian dengan sistem balance, dan admin dapat mengelola inventory, pesanan, serta top-up request dari pengguna.

### Target Users
- **Admin**: Mengelola katalog keyboard, menerima/menolak top-up, tracking order
- **Guest (Pembeli)**: Browsing keyboard, membeli dengan saldo, request top-up saldo
- **Visitor**: Melihat katalog tanpa harus login (public search)

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Profil
- Registrasi dan login pengguna dengan **bcrypt** password hashing
- Update profil (nama, email, foto, alamat, nomor telepon)
- Ubah password dengan validasi password lama
- Sistem role-based access (Admin/Guest) dengan custom middleware

### 🔍 Search & Browse (Public)
- **Public Search**: Visitor dapat mencari keyboard tanpa login
- **Advanced Search**: Filter by keyword, brand, switch type
- **Search Results**: Tampilan grid dengan preview keyboard
- **Responsive Design**: Mobile-friendly search interface

### 🛒 Katalog & Pembelian
- **Browsing Keyboard**: Filter by brand, connection, layout, price range
- **Detail Produk**: Informasi lengkap + zoom hover pada gambar
- **Pembelian**: Dengan sistem balance/saldo pengguna
- **Tracking Stok**: Real-time stock availability
- **Auto Stock Deduction**: Stok otomatis berkurang saat pembelian

### 👨‍💼 Admin Management
- **Keyboard Management**: CRUD keyboard dengan upload gambar
- **Order Management**: Lihat semua order, update status (Pending → Processing → Shipped → In Distribution → Delivered)
- **User Management**: Kelola daftar user, hapus user
- **Top-Up Management**: Approve/reject request top-up dari user dengan bukti transfer
- **Financial Dashboard**: Tracking revenue dan items sold

### 💳 Top-Up & Balance
- User dapat request top-up saldo dengan upload bukti transfer
- Admin dapat approve/reject request dengan alasan
- Track riwayat top-up dengan status
- Auto refund jika order dibatalkan

### 📦 Order Management
- User dapat tracking pesanan dengan status real-time
- Admin dapat update status order
- Auto refund & stock restoration untuk cancelled orders
- Disable update button untuk order yang sudah delivered/cancelled
- Order numbering system (ORD-YYYYMMDD-XXXXXX)

### 🔔 Notification System
- **Real-time Notifications**: Auto-refresh setiap 30 detik
- **Notification Badge**: Tampil jumlah unread notifications
- **Notification Types**: Order created, status updated, top-up approved/rejected
- **Mark as Read**: Individual atau bulk mark as read
- **Notification History**: Halaman dedicated untuk semua notifikasi

---

## 📁 Struktur Proyek

```
KeyboardKatalaog/
├── app/
│   ├── Keyboard.php              # Model Keyboard
│   ├── User.php                  # Model User dengan custom methods (isAdmin, isGuest)
│   ├── Order.php                 # Model Order dengan relationships
│   ├── TopUp.php                 # Model TopUp
│   ├── Notification.php          # Model Notification
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── KeyboardController.php    # CRUD keyboard + home
│   │   │   ├── UserController.php        # Auth + profile management
│   │   │   ├── OrderController.php       # Order processing & status
│   │   │   ├── TopUpController.php       # Top-up request & approval
│   │   │   ├── VisitorController.php     # Public search
│   │   │   └── NotificationController.php # Notification management
│   │   ├── Kernel.php            # HTTP Middleware stack
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php       # Role-based access control
│   │       ├── Authenticate.php          # Authentication check
│   │       └── VerifyCsrfToken.php       # CSRF protection
│   └── ...
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
│   │   │   ├── app.blade.php      # Layout untuk authenticated users
│   │   │   └── guest.blade.php    # Layout untuk guest/visitor (NEW!)
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── searchView/            # Public search (NEW!)
│   │   │   ├── search.blade.php
│   │   │   └── searchresults.blade.php
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
│   │   │   ├── index.blade.php
│   │   │   └── create.blade.php
│   │   ├── profile/
│   │   │   └── edit.blade.php
│   │   ├── notifications/
│   │   │   └── index.blade.php
│   │   └── home.blade.php
│   ├── js/
│   └── sass/
├── routes/
│   ├── web.php      # Web routes dengan middleware groups
│   ├── channels.php
│   └── console.php
├── storage/
│   ├── app/
│   │   └── public/
│   │       ├── keyboard-images/  # Uploaded keyboard images
│   │       ├── topup-proofs/     # Top-up proof images
│   │       └── user-photos/      # User profile photos
│   └── logs/
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── storage/ (symlink)
└── ...
```

---

## 🛠 Teknologi

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Backend | Laravel | 6.x |
| Frontend | Bootstrap | 4.6 |
| Database | MySQL | 5.7+ |
| PHP | PHP | 7.4+ |
| JavaScript | jQuery + Vanilla JS | 3.5+ |
| Icons | Bootstrap Icons | 1.11+ |
| CSS Framework | Custom CSS + Bootstrap | - |
| Password Hashing | Bcrypt (Laravel Hash) | - |

### Laravel Features Used
- ✅ Eloquent ORM dengan relationships
- ✅ Blade templating dengan layout inheritance
- ✅ Database transactions (ACID compliance)
- ✅ Middleware untuk authorization
- ✅ Request validation
- ✅ File upload handling
- ✅ Flash messages
- ✅ Route model binding
- ✅ Facades (DB, Hash, Auth, Storage)

---

## 🚀 Setup & Instalasi

### Prasyarat
- PHP 7.4+
- MySQL 5.7+
- Composer
- Node.js & NPM (untuk asset compilation)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/yourusername/KeyboardKatalaog.git
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
Setelah seeding, gunakan akun berikut:
- **Admin**: `admin@example.com` / `password`

---

## 🗄 Database Schema

### Tabel Users
```sql
id, name, email, password, role (admin/guest), foto,
address, phone, balance (decimal), created_at, updated_at
```

**Relationships:**
- `hasMany` orders
- `hasMany` topups
- `hasMany` notifications

### Tabel Keyboards
```sql
id, name, brand, switch_type, layout, connection, price (decimal),
stock (integer), release_date, image_path, hot_swappable (boolean),
description, created_at, updated_at
```

**Relationships:**
- `hasMany` orders

### Tabel Orders
```sql
id, user_id, keyboard_id, order_number (unique), quantity,
price_per_item, total_price, shipping_address, phone,
status (enum), notes, created_at, updated_at
```

**Status enum:** `pending`, `processing`, `shipped`, `in_distribution`, `delivered`, `cancelled`

**Relationships:**
- `belongsTo` user
- `belongsTo` keyboard

### Tabel TopUps
```sql
id, user_id, amount (decimal), proof_image, status (enum),
reason, processed_by, created_at, updated_at
```

**Status enum:** `pending`, `approved`, `rejected`

**Relationships:**
- `belongsTo` user
- `belongsTo` processedBy (User)

### Tabel Notifications
```sql
id, user_id, type (string), title, message,
is_read (boolean), created_at, updated_at
```

**Types:** `order_created`, `order_status`, `topup_requested`, `topup_approved`, `topup_rejected`

**Relationships:**
- `belongsTo` user

---

## 📖 Panduan Penggunaan

### Untuk Admin

1. **Kelola Keyboard**
   - Login sebagai admin
   - Navigasi ke **Daftar Keyboard**
   - Klik "+ Tambah Keyboard" untuk menambah produk baru
   - Upload gambar keyboard (max 2MB, format: jpg/png)
   - Edit atau hapus keyboard dari list

2. **Kelola Pesanan**
   - Navigasi ke **Kelola Pesanan**
   - Lihat semua order dari customer dengan detail lengkap
   - Update status order:
     - Pending → Processing → Shipped → In Distribution → Delivered
     - Atau cancel order (auto refund + restore stock)
   - Tombol update akan disable untuk order yang sudah delivered/cancelled

3. **Kelola Top-Up**
   - Navigasi ke **Keuangan** (Top-Up Management)
   - Review request top-up dari user dengan bukti transfer
   - Lihat dashboard revenue dan items sold
   - Approve atau reject request dengan alasan
   - Track semua transaksi top-up

4. **Kelola User**
   - Navigasi ke **Daftar User**
   - Lihat daftar semua user (admin & guest)
   - Tambah user baru dengan role
   - Hapus user jika perlu

### Untuk Guest (Pengguna)

1. **Registrasi & Login**
   - Akses halaman **Register** untuk membuat akun baru
   - Password akan di-hash dengan bcrypt untuk keamanan
   - Login dengan email dan password

2. **Browse Keyboard (Authenticated)**
   - Di halaman **Daftar Keyboard**, gunakan filter:
     - Search by name/brand
     - Filter by connection, layout
     - Sort by price, name, release date
   - Klik keyboard untuk lihat detail lengkap
   - Lihat stok available real-time

3. **Beli Keyboard**
   - Pilih keyboard yang diinginkan
   - Tentukan jumlah (max 10 unit per order)
   - Sistem akan validasi:
     - ✅ Stok mencukupi
     - ✅ Saldo cukup
     - ✅ Alamat & nomor telepon sudah diisi
   - Klik "Beli Sekarang"
   - Saldo akan berkurang, stok akan berkurang otomatis
   - Notifikasi akan muncul

4. **Request Top-Up**
   - Navigasi ke **Top-Up**
   - Klik "Request Top-Up Baru"
   - Masukkan jumlah saldo (min Rp 10.000, max Rp 100.000.000)
   - Upload bukti transfer (max 2MB, format: jpg/png)
   - Submit dan tunggu approval dari admin
   - Track status di halaman Top-Up History

5. **Tracking Pesanan**
   - Navigasi ke **Pesanan Saya**
   - Lihat status semua pesanan dengan color coding:
     - 🟡 Pending
     - 🔵 Processing
     - 🟢 Shipped / In Distribution
     - ✅ Delivered
     - 🔴 Cancelled
   - Klik order untuk lihat detail lengkap

6. **Notifikasi**
   - Klik icon bell 🔔 di navbar untuk lihat notifikasi terbaru
   - Badge merah menunjukkan jumlah unread notifications
   - Klik notifikasi untuk mark as read
   - Atau klik "Tandai semua dibaca"

### Untuk Visitor (Tanpa Login)

1. **Search Keyboard**
   - Akses halaman utama atau **Katalog**
   - Gunakan search box untuk cari keyboard
   - Lihat hasil pencarian dengan preview
   - **Catatan**: Untuk membeli, harus login terlebih dahulu

---

## 🎨 Fitur UI/UX

### Design Features
- **Image Zoom**: Hover pada gambar keyboard untuk zoom 1.5x
- **Responsive Design**: Mobile, tablet, dan desktop optimized
- **Data Tables**: Search, sort, pagination untuk list keyboard & order
- **Flash Messages**: SweetAlert2 untuk notifikasi sukses/error
- **Form Validation**: Server-side + client-side validation
- **Loading States**: Smooth transitions dan loading indicators

### Accessibility
- **Active State Indicators**: Visual feedback untuk halaman aktif
- **Button States**: Clear hover, active, disabled states
- **Error Messages**: Jelas dan helpful
- **Consistent Design**: Unified color scheme dan typography

### Layout System
- **Blade Inheritance**: DRY principle dengan `@extends` dan `@section`
- **Component-based**: Reusable navbar, alerts, cards
- **Two Layouts**:
  - `layouts/app.blade.php` → Untuk authenticated users
  - `layouts/guest.blade.php` → Untuk guest/visitor

---

## 🏗 Architecture & Best Practices

### Code Organization
✅ **MVC Pattern**: Strict separation of concerns
✅ **SOLID Principles**: Single responsibility, dependency injection
✅ **DRY (Don't Repeat Yourself)**: Layout inheritance, helper methods
✅ **RESTful Routes**: Resource controllers dengan named routes
✅ **Database Transactions**: ACID compliance untuk critical operations

### Security
✅ **Password Hashing**: Bcrypt dengan automatic salting
✅ **CSRF Protection**: Token validation untuk semua POST requests
✅ **SQL Injection Prevention**: Eloquent ORM dengan parameter binding
✅ **XSS Prevention**: Blade auto-escaping `{{ }}`
✅ **Authorization**: Middleware untuk role-based access control
✅ **File Upload Validation**: Type & size validation

### Performance
✅ **Eager Loading**: Prevent N+1 queries dengan `->with()`
✅ **Database Indexing**: Primary & foreign keys
✅ **Asset Optimization**: Minified CSS/JS
✅ **Caching**: Laravel cache untuk session & views

### Code Quality
✅ **Consistent Naming**: PSR standards
✅ **Comments**: Docblocks untuk methods
✅ **Error Handling**: Try-catch dengan meaningful messages
✅ **Validation**: Request validation dengan custom messages

---

## 🔒 Middleware & Authorization

### Middleware Stack

**Global Middleware:**
- `TrustProxies`: Handle proxy headers
- `CheckForMaintenanceMode`: Maintenance mode check
- `ValidatePostSize`: POST size validation
- `TrimStrings`: Auto-trim input strings
- `ConvertEmptyStringsToNull`: Normalize empty inputs

**Route Groups:**
- `web`: Session, CSRF, cookie encryption

**Custom Middleware:**
- `auth`: Authentication check → redirect ke login jika belum login
- `guest`: Guest only → redirect ke home jika sudah login
- `admin`: Admin only → abort 403 jika bukan admin

### Authorization Logic
```php
// Custom methods di User model
isAdmin() → return $this->role === 'admin'
isGuest() → return $this->role === 'guest'

// Usage di view
@if(auth()->user()->isAdmin())
    <!-- Admin content -->
@endif
```

---

## 🐛 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| "Column not found" error | `php artisan migrate:fresh --seed` |
| Gambar tidak tampil | `php artisan storage:link` |
| 404 Not Found | Cek routes di `routes/web.php` |
| Permission denied (storage) | `chmod -R 755 storage/` dan `chmod -R 755 bootstrap/cache/` |
| CSRF token mismatch | Clear browser cache atau restart server |
| Class not found | `composer dump-autoload` |
| Notifikasi tidak muncul | Cek JavaScript console, pastikan jQuery loaded |

---

## 🎯 Future Improvements

- [ ] Wishlist functionality
- [ ] Product reviews & ratings
- [ ] Email notifications
- [ ] Payment gateway integration
- [ ] Export orders to Excel/PDF
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] API authentication (Laravel Passport)
- [ ] Real-time notifications (Laravel Echo + WebSocket)

---

## 📝 Changelog

### v1.2.0 (December 2025)
- ✅ Added public search functionality
- ✅ Refactored views with Blade inheritance (guest layout)
- ✅ Enhanced navbar with active state indicators
- ✅ Improved notification system with real-time updates
- ✅ Added top-up proof image upload
- ✅ Financial dashboard for admin

### v1.1.0
- ✅ Real-time notification system
- ✅ Order auto-refund on cancellation
- ✅ Stock management improvements

### v1.0.0
- ✅ Initial release
- ✅ CRUD keyboard
- ✅ Order & top-up management
- ✅ User authentication & authorization

---

## 👥 Contributors

- **Developer**: [Your Name]
- **Framework**: Laravel Team
- **UI Design**: Bootstrap Team

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

**Last Updated**: December 19, 2025
**Project Status**: ✅ Active Development
