# Zylomart – Web Aplikasi E-Commerce Fashion Berbasis Laravel
Zylomart adalah web aplikasi **E-Commerce Fashion** berbasis **Laravel 12** yang menyediakan penjualan berbagai produk pakaian seperti **kaos, blazer, celana, blouse, dan rok**.  Aplikasi ini dikembangkan menggunakan **Laravel Breeze** sebagai starter autentikasi dan menerapkan **Role Based Access Control (RBAC)**, **manajemen toko fashion**, serta **sistem pembayaran berbasis saldo (wallet) dan Virtual Account (VA)**.


## 🚀 Fitur Utama Zylomart
### 🔐 Role Based Access Control (RBAC)
Zylomart membagi pengguna ke dalam beberapa peran dengan hak akses yang berbeda:
- **Admin**  
  Mengelola pengguna dan memverifikasi toko fashion.
- **Seller (Member)**  
  Mengelola toko fashion, produk pakaian, dan pesanan.
- **Customer**  
  Melakukan pembelian produk fashion dan transaksi.
Setiap halaman dilindungi oleh **middleware Laravel** sesuai dengan peran pengguna dan status kepemilikan toko.

## 🛍️ Fitur Customer (Pembeli Fashion)
### Homepage
Menampilkan daftar produk fashion terbaru seperti **kaos, blazer, celana, blouse, dan rok**, lengkap dengan filter kategori.
### Halaman Detail Produk
Menampilkan detail produk pakaian, gambar produk, informasi toko penjual, dan ulasan pelanggan.
### Checkout
Proses pembelian produk fashion dengan pengisian alamat, pilihan pengiriman, serta metode pembayaran.
### Riwayat Transaksi
Menampilkan histori pembelian produk fashion yang pernah dilakukan oleh customer.
### Topup Saldo (Wallet)
Customer dapat melakukan topup saldo untuk mempercepat proses checkout.

## 🏪 Fitur Seller (Toko Fashion)
Fitur ini **hanya dapat diakses oleh Member yang telah mendaftarkan toko**.
### Pendaftaran & Manajemen Toko Fashion
Mengelola profil toko seperti nama, logo, deskripsi, dan rekening penjual.
### Manajemen Kategori Produk
Mengelola kategori pakaian seperti **kaos, blazer, celana, blouse, dan rok**.
### Manajemen Produk Fashion
CRUD produk fashion beserta gambar produk dan pengaturan thumbnail.
### Manajemen Pesanan
Melihat pesanan masuk dan memperbarui status pengiriman.
### Saldo Toko
Melihat saldo hasil penjualan produk fashion.
### Penarikan Dana
Mengajukan penarikan saldo toko ke rekening penjual.

## 👑 Fitur Admin
Fitur ini **hanya dapat diakses oleh pengguna dengan role admin**.
### Verifikasi Toko Fashion
Menyetujui atau menolak pendaftaran toko penjual fashion.
### Manajemen User & Toko
Mengelola seluruh pengguna dan toko yang terdaftar di sistem.

## 💰 Sistem Pembayaran & Keuangan
Zylomart menggunakan dua skema pembayaran utama:
### Pembayaran dengan Saldo (Wallet)
Saldo pengguna akan dipotong langsung saat pembelian produk fashion.
### Pembayaran Transfer Virtual Account (VA)
Sistem akan menghasilkan **kode Virtual Account (VA) unik** untuk setiap transaksi pembelian.
Seluruh pembayaran diproses melalui **Halaman Pembayaran Terpusat**, baik untuk:
- Topup saldo
- Pembayaran produk fashion

## 🗄️ Database & Seeder
Zylomart menggunakan struktur database **E-Commerce lengkap** dan menyediakan **Database Seeder** untuk data awal, meliputi:
- Admin
- Seller dan Customer
- Toko Fashion
- Kategori Produk Fashion
- Produk Fashion
- Gambar Produk
- Transaksi dan Review




# **Ujian Praktikum Pemrograman Web Aplikasi E-Commerce (Laravel)** 

## **Konteks Proyek**

Kalian diberikan sebuah repositori proyek Laravel 12 yang sudah dilengkapi dengan:

1. Starter Kit **Laravel Breeze** untuk basic autentikasi.  
2. Semua file **Migrations** yang diperlukan untuk membuat struktur database e-commerce (tabel users, products, transactions, stores, etc.).

**Tugas utama Kalian** adalah membangun web aplikasi full-stack E-Commerce yang fungsional (CRUD) berdasarkan skema database yang disediakan, dengan implementasi khusus pada Role Based Access Control (RBAC) dan Flow Pembayaran.

## **Struktur Database**

![alt text](arsitektur-database.png)

## **Persyaratan Teknis & Setup Awal**

1. **Framework:** Laravel 12\.  
2. Jalankan **`composer install`** untuk menginstal seluruh dependensi PHP yang dibutuhkan.  
3. Salin file **`.env.example`** menjadi **`.env`**, lalu edit pengaturan database sesuai server database Kalian  
4. Jalankan **`php artisan key:generate`** untuk menghasilkan application key baru  
5. **Database:** Terapkan semua *file* *migration* yang telah disediakan (**`php artisan migrate`**).  
6. **Seeder:** Kalian **wajib** membuat *Database Seeder* untuk membuat data awal. Silahkan lakukan langkah ini pada folder `database/seeders` dan buat file seeder sesuai tabel dengan data yang diperlukan, minimal:  
   * Satu pengguna dengan role: 'admin'.  
   * Dua pengguna dengan role: 'member'.  
   * Satu Toko (stores) yang dimiliki oleh salah satu member.  
   * Lima Kategori Produk (product\_categories).  
   * Sepuluh Produk (products) yang dijual oleh Toko tersebut.  
7. Jalankan **`php artisan serve`** untuk menjalankan development server  
8. Buka terminal lain dan jalankan **`npm install && npm run build`** untuk menginstal package Node yang diperlukan.  
9. Jalankan **`npm run dev`** untuk meng-compile asset dalam mode development  
10. Buka browser dan akses [**http://localhost:**](http://localhost:8000)`{PORT}` untuk melihat aplikasi

## **Tantangan Khusus (*Challenge*)**

Implementasi Kalian harus mencakup tiga tantangan inti berikut:

### **1\. Role Based Access Control (RBAC)**

Batasi akses ke halaman tertentu berdasarkan peran pengguna.

| Peran (users.role) | Akses ke Halaman | Aturan Akses |
| :---- | :---- | :---- |
| **Admin** | Halaman Admin. | Akses penuh ke menu admin. |
| **Seller/Penjual** | Dasbor Penjual. | Wajib memiliki role: 'member' **DAN** wajib memiliki entri di tabel stores. |
| **Member/Customer** | Halaman Pelanggan. | Akses ke halaman pembelian dan riwayat. |

### 

### **2\. Implementasi Sistem Keuangan (User Wallet & VA)**

Kalian harus membuat **Tabel Baru** bernama **user\_balances** (untuk *user wallet*/saldo) dan mengimplementasikan dua skema pembayaran:

| Skema Pembayaran | Flow Penggunaan |
| :---- | :---- |
| **Opsi A: Bayar dengan Saldo (*Wallet*)** | Pelanggan dapat *Topup* Saldo terlebih dahulu (melalui VA). Saat *checkout*, saldo user\_balances akan langsung dipotong. |
| **Opsi B: Bayar Langsung (Transfer VA)** | Saat *checkout* produk, sistem akan membuat kode **Virtual Account (VA) yang unik** yang terkait langsung dengan transaction\_id. |

### 

### **3\. Halaman Pembayaran Terpusat (*Dedicated Payment Page*)**

Buat satu halaman/fitur untuk memproses konfirmasi pembayaran VA dari Opsi A (*Topup*) dan Opsi B (Pembelian Langsung).

* **Flow:** Pengguna mengakses halaman Payment \-\> Masukkan Kode VA \-\> Sistem menampilkan detail (jumlah yang harus dibayar) \-\> Pengguna memasukkan nominal transfer (simulasi) \-\> Konfirmasi Pembayaran.  
* Jika sukses, sistem akan:  
  * **Untuk Topup:** Menambahkan saldo ke user\_balances.  
  * **Untuk Pembelian:** Mengubah transactions.payment\_status menjadi paid **dan** menambahkan dana ke store\_balances penjual.

## **Fitur yang Harus Diimplementasikan (Berdasarkan Halaman)**

Implementasikan fungsionalitas CRUD untuk setiap peran:

### **I. Halaman Pengguna (Customer Side)**

| Halaman | Fungsionalitas Wajib |
| :---- | :---- |
| **Homepage** (/) | Menampilkan daftar **semua produk** yang tersedia. **Filter** berdasarkan product\_categories. |
| **Halaman Produk** (/product/{slug}) | Menampilkan detail produk, semua product\_images, nama store, product\_reviews, dan tombol **"Beli"**. |
| **Checkout** (/checkout) | Proses pengisian alamat, pemilihan *shipping* (shipping\_type, kalkulasi shipping\_cost), pemilihan Opsi Pembayaran (Saldo / Transfer VA). Membuat entri di transactions dan transaction\_details. |
| **Riwayat Transaksi** (/history) | Melihat daftar transactions yang pernah dilakukan. Dapat melihat detail produk yang dibeli (transaction\_details). |
| **Topup Saldo** (/wallet/topup) | Mengajukan *topup* saldo pribadi. Menghasilkan VA unik. |

### 

### **II. Halaman Toko (Seller Dashboard)**

Halaman ini hanya dapat diakses oleh *Member* yang sudah mendaftar sebagai Toko.

| Halaman | Fungsionalitas Wajib |
| :---- | :---- |
| **Pendaftaran Toko** (/store/register) | CRUD untuk membuat profil Toko (mengisi stores.name, logo, about, dll.). |
| **Manajemen Toko** (/seller/profile) | CRUD untuk mengelola (update/delete) data Toko dan detail rekening bank. |
| **Manajemen Kategori** (/seller/categories) | **CRUD** untuk product\_categories. |
| **Manajemen Produk** (/seller/products) | **CRUD** untuk products dan product\_images (termasuk penKalianan is\_thumbnail). |
| **Manajemen Pesanan** (/seller/orders) | Melihat daftar pesanan masuk (transactions). Mengubah status pesanan dan mengisi tracking\_number. |
| **Saldo Toko** (/seller/balance) | Melihat saldo saat ini (store\_balances.balance) dan riwayat saldo (store\_balance\_histories). |
| **Penarikan Dana** (/seller/withdrawals) | Mengajukan Penarikan dana (membuat entri di withdrawals) dan melihat riwayat withdrawals. |

### 

### **III. Halaman Admin (Admin Only)**

Halaman ini hanya dapat diakses oleh pengguna dengan role: 'admin'.

| Halaman | Fungsionalitas Wajib |
| :---- | :---- |
| **Verifikasi Toko** (/admin/verification) | Melihat daftar Toko yang belum terverifikasi (is\_verified: false). Fitur untuk **Memverifikasi** atau **Menolak** pendaftaran toko (mengubah stores.is\_verified). |
| **Manajemen User & Store** (/admin/users) | Melihat dan mengelola daftar semua users dan stores yang terdaftar. |

## **Penilaian**

Persentase nilai dilakukan berdasarkan indikator berikut

* Tampilan 15%  
* Presentasi Projek 20% (jika nanti memungkinkan)  
* Penerapan MVC \+ Efisiensi code 15%  
* Kelengkapan Project sesuai kriteria 50%

Penilaian akan dilakukan berdasarkan commit nya. Semakin banyak dan kompleks yang dilakukan per individu dalam kelompok, bobot nilai yang diberikan akan semakin besar dan berlaku sebaliknya.

## **Informasi Tambahan**

1. Silahkan fork repositori ini, lalu mulai kerjakan di laptop masing masing dan jangan lupa invite partner kelompok ke dalam repositori.  
2. Berikan penjelasan aplikasi yang kalian buat sebagaimana readme pada repositori ini dan jangan lupa sertakan nama dan NIM anggota kelompok pada file [readme.md](http://readme.md)  
3. Dipersilahkan membuat improvisasi pada codingan, library, dan sumber apapun yang dibutuhkan selama tidak merubah arsitektur aplikasi yang diberikan pada poin diatas.  
4. Jika ada yang kurang dipahami dari perintah soal yang diberikan, feel free untuk menghubungi kami.

---
![alt text](<No Problem Running GIF by ProBit Global.gif>)

Semangatt, badai pasti berlalu
