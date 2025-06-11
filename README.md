<p align="center"><a href="#" target="_blank"><img src="/public/magnum-text.png" width="400" alt="Project Logo"></a></p>

## Tentang

Sistem Manajemen Proyek adalah aplikasi berbasis web yang dirancang untuk membantu perusahaan atau organisasi khususnya di CV. Magnum Solusion yang menjadi studi kasus dalam mengelola proyek mereka secara efisien. Sistem ini memungkinkan pengguna untuk melacak status proyek, mengelola sumber daya, dan memantau ketersediaan material yang diperlukan untuk menyelesaikan proyek.

Tujuan utama dari sistem ini adalah untuk meningkatkan produktivitas, mengurangi kesalahan dalam pengelolaan proyek, dan memberikan visibilitas yang lebih baik terhadap progres proyek.

---

## Fitur Utama

- **Manajemen Proyek**: Membuat, mengedit, dan menghapus proyek dengan informasi lengkap seperti nama proyek, klien, tanggal mulai, dan tanggal selesai.
- **Manajemen Material**: Melacak ketersediaan material dengan status "Available" atau "Out of Stock".
- **Filter dan Sorting**: Memfilter proyek berdasarkan status, klien, atau tanggal jatuh tempo, serta mengurutkan data berdasarkan nama proyek atau klien.
- **Dashboard Interaktif**: Menampilkan grafik status proyek dan ketersediaan material secara visual.
- **Role-Based Access Control**: Mengelola akses pengguna berdasarkan peran seperti Admin, Engineer, dan Client.

---

## Role yang Ada

- **Project Engineer**: Memiliki akses penuh untuk mengelola proyek, material, dan pengguna.
- **Engineer**: Bertanggung jawab untuk melacak progres proyek dan memastikan material tersedia.

---

## Langkah Instalasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di lingkungan lokal Anda:

### 1. Clone Repository
Clone repository ini ke komputer Anda:
```bash
git clone https://github.com/username/sistem-manajemen-proyek.git
```

### 2. Masuk ke Direktori Proyek
Pindah ke direktori proyek yang baru saja di-clone:
```bash
cd sistem-manajemen-proyek
```

### 3. Install Dependensi
Install dependensi yang diperlukan menggunakan Composer:
```bash
composer install
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database serta pengaturan lainnya:
```bash
cp .env.example .env
```

### 5. Generate Kunci Aplikasi
Jalankan perintah berikut untuk menghasilkan kunci aplikasi:
```bash
php artisan key:generate
```

### 6. Migrasi Database
Lakukan migrasi database untuk membuat tabel yang diperlukan oleh aplikasi:
```bash
php artisan migrate
```

### 7. Jalankan Aplikasi
Terakhir, jalankan aplikasi menggunakan perintah berikut:
```bash
php artisan serve
```

Aplikasi sekarang dapat diakses melalui `http://localhost:8000`.

---

## Penutup

Sistem Manajemen Proyek diharapkan dapat menjadi solusi efektif dalam mengelola proyek-proyek Anda. Dengan fitur-fitur unggulan yang ditawarkan, diharapkan produktivitas tim Anda dapat meningkat dan pengelolaan proyek menjadi lebih terstruktur.

Untuk informasi lebih lanjut, Anda dapat mengunjungi dokumentasi resmi atau menghubungi tim pengembang.

Terima kasih telah menggunakan Sistem Manajemen Proyek. Selamat mengelola proyek Anda!
