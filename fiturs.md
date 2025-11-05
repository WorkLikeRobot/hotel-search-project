# 🚀 PROYEK: [Nama Proyek: Web Jual Beli Rumah]

---

## 1. Ikhtisar Proyek

- **Tujuan Utama:**  
  [Tujuan utama proyek: Membangun marketplace properti yang memungkinkan agen memamerkan listing secara detail, dan memiliki fokus utama pada lead generation (mengumpulkan data kontak calon pembeli yang serius via form inquiry).]

- **Tumpukan Teknologi:**  
  **TALL Stack (Laravel 12, Livewire 3/Volt, Alpine.js, Tailwind CSS versi 4, Vite)**  
  Laravel 12 membawa beberapa perubahan besar dari Laravel 10, termasuk:
  - **Pemindahan struktur service provider & middleware:** Banyak pendaftaran default kini diatur otomatis oleh kernel baru `@bootstrap/app.php` tanpa perlu deklarasi manual di `@config/app.php`.
  - **Registrasi Service Provider Otomatis:** Tidak perlu lagi menambahkan provider bawaan ke `@config/app.php`; sistem autodiscovery kini lebih pintar dan efisien.
  - **Routing & Middleware Modernized:** Middleware pipeline kini lebih modular, mendukung deklarasi berbasis class closure dan auto-injection yang lebih bersih.
  - **Fitur Bootstrap Application:** Laravel kini memisahkan bootstrap logic agar startup aplikasi lebih cepat dan lebih mudah di-custom.
  - **Peningkatan performa di container dan serialization**, membuat aplikasi microservice dan job queue lebih efisien.
  
  Sementara itu, **Tailwind CSS versi 4** memperkenalkan:
  - **Zero-runtime CSS:** Build engine baru sepenuhnya menggantikan PostCSS, menghasilkan CSS 30–40% lebih kecil.
  - **Mode `design tokens` bawaan:** Token warna, spacing, dan typography kini dideklarasikan secara global tanpa konfigurasi manual.
  - **Peningkatan Theme API:** Bisa override skema warna atau varian mode (light/dark/system) langsung di file konfigurasi.
  - **Auto-class pruning:** Tailwind otomatis menghapus class yang tidak digunakan saat proses build tanpa konfigurasi tambahan.
  - **Integrasi native dengan Vite:** Kompilasi lebih cepat dengan caching yang lebih efisien untuk proyek TALL Stack.

- **Arsitektur:**  
  Service Layer, Form Objects, Volt (untuk komponen kecil), Class Livewire (untuk komponen besar)


## 2. Peran Pengguna (Aktor)

- **[Peran Publik: Pencari Rumah]:**  
  [Deskripsi singkat peran publik: Pengguna anonim atau terdaftar yang mencari properti.]

- **[Peran Internal: Admin/Agen]:**  
  [Deskripsi singkat peran internal: Pengguna internal yang mengelola listing dan prospek.]

---

## 3. Fitur Wajib (Core/Pondasi)

- **Autentikasi:** Login, Register, Lupa Password  
- **Manajemen Role:** Pembeda antara [Peran Publik] dan [Peran Internal]  
- **Manajemen CRUD [Konten Utama]:** [Deskripsi CRUD utama, misal: Agen dapat menambah, mengedit, menghapus listing properti]  
- **Manajemen User:** [Deskripsi manajemen user, misal: Admin dapat menambah, mengedit, menghapus user]
- **Dasbor Admin:** Halaman utama untuk [Peran Internal]  
- **Halaman Profil:** Halaman utama untuk [Peran Publik]  

---

## 4. Fitur Unik (10 Fitur Utama)

1. **[Fitur Unik 1: Pencarian & Filter Lanjutan]:** Menyaring listing berdasarkan lokasi, harga, jumlah kamar, dll.  
2. **[Fitur Unik 2: Sistem "Simpan Favorit"]:** Pengguna (member) menandai listing yang disukai.  
3. **[Fitur Unik 3: Halaman "Properti Favorit Saya"]:** Halaman profil yang menampilkan semua listing yang disimpan.  
4. **[Fitur Unik 4: Form Inquiry (Lead Generation)]:** Form untuk calon pembeli menghubungi agen, mengirim data ke admin.  
5. **[Fitur Unik 5: Kalkulator KPR Sederhana]:** Alat bantu menghitung estimasi cicilan bulanan.  
6. **[Fitur Unik 6: Tampilan Peta Interaktif (Map View)]:** Menampilkan hasil pencarian sebagai pin di peta.  
7. **[Fitur Unik 7: Fitur Bandingkan Properti]:** Membandingkan 2–3 properti secara berdampingan.  
8. **[Fitur Unik 8: Galeri Foto Properti]:** Slider foto di halaman detail.  
9. **[Fitur Unik 9: Notifikasi Prospek Baru (Admin/Agen)]:** Notifikasi (email/dasbor) untuk agen saat ada inquiry baru.  
10. **[Fitur Unik 10: Ekspor Laporan Prospek (Admin/Agen)]:** Agen mengunduh data prospek (leads) dalam format Excel/CSV.  

---

## 5. Skema Database (ERD - DBML)
> Ini adalah sumber kebenaran untuk semua query dan model, jika ada tambahan migrasi atau perubahan skema DB pastikan untuk memperbarui skema DBML ini.

```dbml
// ==========================================
// DBML Schema for "Web Jual Beli Rumah"
// Architect: Gemini
// Project: Proyek ke-18
// ==========================================

// Mendefinisikan peran pengguna.
Enum enum_user_role {
  buyer     // Pencari Rumah
  agent     // Agen Properti
  admin     // Administrator Sistem
}

// Mendefinisikan status listing properti.
Enum listing_status {
  available // Tersedia untuk dijual/sewa
  sold      // Sudah terjual
  pending   // Dalam proses negosiasi
  draft     // Disimpan oleh agen, belum publish
}

// Mendefinisikan tipe properti untuk filter.
Enum property_type {
  house       // Rumah
  apartment   // Apartemen
  land        // Tanah
  commercial  // Komersial (Ruko, Kantor)
}

// Mendefinisikan tipe listing (Jual atau Sewa).
Enum listing_type {
  sale
  rent
}

// Mendefinisikan status lead/prospek untuk dasbor agen.
Enum inquiry_status {
  new           // Prospek baru masuk
  contacted     // Sudah dihubungi
  closed_won    // Berhasil (Deal)
  closed_lost   // Gagal (Batal)
}

// ==========================================
// Tabel Inti
// ==========================================

// Tabel utama untuk semua pengguna (Pencari Rumah, Agen, Admin).
// Mendukung Fitur Wajib: Autentikasi, Manajemen Role, Profil Pengguna.
Table users {
  id int [pk, increment]
  name varchar(255) [not null]
  email varchar(255) [unique, not null]
  password varchar(255) [not null] // Hash password
  phone_number varchar(20) [null]
  profile_image_url varchar(255) [null]
  
  // Menggunakan Enum untuk role, sesuai Fitur Wajib (Manajemen Role).
  role enum_user_role [not null, default: 'buyer']
  
  created_at timestamp [default: `now()`, not null]
  updated_at timestamp [default: `now()`, not null]
}

// Tabel utama untuk semua listing properti.
// Mendukung Fitur Wajib: CRUD Listing.
// Mendukung Fitur Unik: 1, 5, 6, 7.
Table listings {
  id int [pk, increment]
  
  // Relasi ke agen yang memposting listing ini.
  agent_id int [ref: > users.id, not null]
  
  title varchar(255) [not null]
  description text [null]
  status enum_listing_status [not null, default: 'draft']
  
  // Kolom untuk Fitur Unik 1 (Filter Lanjutan)
  tipe_properti enum_property_type [not null]
  listing_type enum_listing_type [not null, default: 'sale']
  harga decimal(15, 2) [not null] // Juga untuk Fitur Unik 5 (Kalkulator KPR)
  alamat text [not null]
  kota varchar(100) [not null]
  provinsi varchar(100) [not null]
  kode_pos varchar(10) [null]
  luas_bangunan int [null] // dalam m2
  luas_tanah int [null] // dalam m2
  jml_kamar_tidur int [not null, default: 0]
  jml_kamar_mandi int [not null, default: 0]
  jml_garasi int [not null, default: 0]
  tahun_dibangun int [null]
  
  // Kolom untuk Fitur Unik 6 (Tampilan Peta)
  latitude decimal(10, 8) [null]
  longitude decimal(11, 8) [null]
  
  is_featured boolean [not null, default: false]
  
  created_at timestamp [default: `now()`, not null]
  updated_at timestamp [default: `now()`, not null]
  
  indexes {
    (agent_id)
    (harga)
    (kota)
    (tipe_properti)
  }
}

// Tabel untuk galeri foto (One-to-Many).
// Mendukung Fitur Unik 8: Galeri Foto Properti.
Table listing_images {
  id int [pk, increment]
  listing_id int [ref: > listings.id, not null] // Relasi ke listing induk
  image_url varchar(255) [not null]
  caption varchar(255) [null]
  is_primary boolean [not null, default: false] // Untuk thumbnail utama
  
  created_at timestamp [default: `now()`, not null]
  updated_at timestamp [default: `now()`, not null]
}

// ==========================================
// Tabel Fitur & Relasi
// ==========================================

// Tabel pivot untuk relasi Many-to-Many antara users dan listings.
// Mendukung Fitur Unik 2 & 3: Sistem Simpan Favorit.
Table user_favorites {
  user_id int [ref: > users.id, not null]
  listing_id int [ref: > listings.id, not null]
  created_at timestamp [default: `now()`, not null]
  
  // Memastikan pengguna tidak bisa memfavoritkan properti yang sama berkali-kali.
  indexes {
    (user_id, listing_id) [unique]
  }
}

// Tabel inti untuk Lead Generation (Tujuan Utama Proyek).
// Mendukung Fitur Unik 4, 9, 10.
Table inquiries {
  id int [pk, increment]
  
  // Relasi ke properti yang ditanyakan.
  listing_id int [ref: > listings.id, not null]
  
  // Denormalisasi: Menyimpan agent_id untuk query dasbor agen yang lebih cepat.
  agent_id int [ref: > users.id, not null]
  
  // user_id bisa null, karena GUEST (non-login) harus bisa mengirim inquiry.
  user_id int [ref: > users.id, null]
  
  // Data prospek (lead)
  name varchar(255) [not null]
  email varchar(255) [not null]
  phone_number varchar(20) [not null]
  message text [null]
  
  // Status untuk tracking di dasbor Admin/Agen.
  status enum_inquiry_status [not null, default: 'new']
  
  created_at timestamp [default: `now()`, not null]
  updated_at timestamp [default: `now()`, not null]
  
  indexes {
    (listing_id)
    (agent_id)
    (user_id)
  }
}

Ref: "listings"."id" < "listings"."alamat"
```
