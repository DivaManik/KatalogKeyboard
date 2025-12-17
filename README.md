# Keyboard Catalogue – Documentation

> Studi kasus: setiap peserta mengembangkan web katalog keyboard yang mampu *create* dan *read* data, memakai Bootstrap, dan menerapkan template inheritance ala Laravel Blade.

## 1. Tujuan dan Lingkup
- Menyediakan katalog “KKB | Katalog Keyboard Bagus” berisi daftar keyboard mekanik.
- Fitur inti: menambah data (create) dan menampilkan data (read) sesuai kasus pada spreadsheet peserta.
- Tampilan menggunakan Bootstrap 4 dengan layout utama `resources/views/layouts/app.blade.php` yang diwarisi oleh seluruh halaman.

## 2. Arsitektur Singkat
| Lapisan | Implementasi | Catatan |
| --- | --- | --- |
| Routing | `routes/web.php` | Redirect `/` → `/keyboards`, resource minimal (index/create/store/show). |
| Controller | `app/Http/Controllers/KeyboardController.php` | Menangani CRUD dasar; data index dikirim full untuk DataTables. |
| Model | `app/Keyboard.php` | Eloquent model + casting tipe (`price`, `hot_swappable`, `release_date`). |
| Database | `database/migrations/2025_11_01_122850_create_keyboards_table.php` | Skema khusus keyboard (name, brand, switch, layout, connection, price, dst). |
| Seeder & Factory | `database/seeds/KeyboardSeeder.php`, `database/factories/KeyboardFactory.php` | 1 data referensi + 40 data faker agar katalog langsung terisi. |
| Views | `resources/views/layouts/app.blade.php`, `resources/views/keyboards/*.blade.php` | Layout Bootstrap + halaman katalog, form create, dan detail. DataTables dipakai di index. |

## 3. Fitur Utama
1. **Create Keyboard**
   - URL: `/keyboards/create`
   - Form menampung nama, brand, jenis switch, layout, koneksi, harga, tanggal rilis, URL gambar, link pembelian, deskripsi, dan toggle hot-swappable.
   - Validasi dijalankan di `KeyboardController@store` (required, format URL, batas angka, dsb).
   - Data tersimpan via `Keyboard::create()` lalu redirect ke daftar dengan flash message.

2. **Read Keyboard**
   - **Daftar** (`/keyboards`): menampilkan semua entri menggunakan DataTables (search, sort, paging). Kolom “No.” memberi urutan otomatis di klien.
   - **Detail** (`/keyboards/{keyboard}`): menampilkan info lengkap + deskripsi dengan `white-space: pre-line` sehingga teks panjang tetap rapi.

3. **Template Inheritance & Bootstrap**
   - Layout utama sudah memuat CDN Bootstrap + space untuk custom CSS/JS (`@stack('styles'|'scripts')`).
   - Navbar, alert flash, dan script delegasi klik baris disediakan sekali di layout; halaman turunan hanya fokus pada konten masing-masing.

## 4. Alur Kerja Teknis
1. **Instal dependensi**  
   ```bash
   composer install
   npm install && npm run dev   # opsional jika ingin mengompilasi asset sendiri
   ```
2. **Setel env** – salin `.env.example`, isi koneksi database MySQL (aplikasi default memakai `loker_db`).
3. **Migrasi & Seed**  
   ```bash
   php artisan migrate:fresh --seed
   ```
   Perintah ini menciptakan tabel `keyboards` dan mengisi 41 data contoh.
4. **Jalankan aplikasi**  
   ```bash
   php artisan serve
   ```
   Buka `http://127.0.0.1:8000/keyboards` untuk melihat katalog.

## 5. Struktur Data Keyboard
| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `name`, `brand` | string | Nama keyboard & brand (wajib). |
| `switch_type`, `layout` | string nullable | Info switch & layout (misal “Gateron Brown”, “75%”). |
| `connection` | enum (`wired`, `wireless`, `hybrid`) | Default `wired`. |
| `hot_swappable` | boolean | Checkbox di form, default `false`. |
| `price` | integer nullable | Disimpan dalam Rupiah. |
| `release_date` | date nullable | Digunakan untuk menampilkan timeline produk. |
| `description` | text | Wajib, ditampilkan dengan `nl2br`. |
| `image_url`, `buy_link` | string nullable | Untuk foto dan tautan pembelian. |
| `timestamps` | otomatis | Audit data. |

## 6. Frontend Notes
- **DataTables**: CDN `https://cdn.datatables.net/1.13.8` untuk CSS & JS. Konfigurasi di `resources/views/keyboards/index.blade.php` mengatur bahasa Indonesia, pagination, dan nomor urut.
- **Interaksi baris**: Layout memiliki script delegasi klik sehingga klik di area `<tr data-row-link>` membuka halaman detail tanpa berkonflik dengan DataTables.
- **Deskripsi panjang**: kelas `.product-description` menerapkan `word-break` & `overflow-wrap` agar teks tanpa spasi tetap turun ke bawah.

## 7. Pengujian Manual
1. Jalankan `php artisan serve`.
2. Kunjungi `/keyboards` → pastikan DataTables menampilkan data, fitur cari/sort berfungsi.
3. Klik baris untuk memastikan menuju halaman detail.
4. Klik “+ Tambah Keyboard”, isi form valid & tidak valid untuk memverifikasi validasi server.
5. Setelah submit sukses, pastikan entri tampil di DataTables (gunakan search).

## 8. Ekstensi yang Direkomendasikan
- Tambahkan fitur edit & delete untuk melengkapi CRUD.
- Gunakan Storage/Laravel Filesystem bila ingin upload gambar ketimbang URL.
- Integrasi autentikasi jika katalog hanya boleh diakses peserta tertentu.
- Tambah filter tambahan (misal by layout) melalui DataTables custom dropdown jika spreadsheet menuntut analisa tertentu.

---
Dokumentasi ini merangkum apa yang dibangun untuk memenuhi permintaan “create & read data” dengan Bootstrap dan template inheritance. Silakan jadikan catatan saat mengisi laporan atau mempresentasikan hasil studi kasus.*** End Patch
