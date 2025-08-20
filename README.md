# PABD - PHP CRUD Application

Aplikasi CRUD (Create, Read, Update, Delete) sederhana menggunakan PHP dan MySQL untuk mengelola data mahasiswa.

## Fitur

- ✅ **CRUD Operations**: Tambah, lihat, ubah, dan hapus data mahasiswa
- ✅ **Image Upload**: Upload dan preview gambar mahasiswa
- ✅ **User Authentication**: Sistem login dan registrasi
- ✅ **AJAX Search**: Pencarian data mahasiswa secara real-time
- ✅ **Responsive Design**: Tampilan yang dapat diakses dari berbagai perangkat
- ✅ **Form Validation**: Validasi input untuk keamanan data

## Screenshots

### Halaman Utama
Menampilkan daftar mahasiswa dengan fitur pencarian dan aksi CRUD.

### Form Tambah/Edit Data
Form input data mahasiswa dengan preview gambar.

## Installation

### Prerequisites
- XAMPP/WAMP/LAMP Server
- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB
- Git

### Setup

1. **Clone Repository**
   ```bash
   git clone https://github.com/aanaliudin/pabd.git
   cd pabd
   ```

2. **Setup Database**
   - Buka phpMyAdmin atau MySQL client
   - Buat database baru bernama `pabd`
   - Import file SQL berikut (buat tabel):

   ```sql
   CREATE DATABASE pabd;
   USE pabd;

   CREATE TABLE mahasiswa (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nama VARCHAR(100) NOT NULL,
       nim VARCHAR(20) NOT NULL,
       email VARCHAR(100) NOT NULL,
       jurusan VARCHAR(50) NOT NULL,
       gambar VARCHAR(255) DEFAULT 'nophoto.jpg'
   );

   CREATE TABLE user (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL
   );
   ```

3. **Konfigurasi Database**
   - Edit file `functions.php`
   - Sesuaikan koneksi database pada fungsi `koneksi()`:
   ```php
   function koneksi()
   {
       return mysqli_connect('localhost', 'root', '123456', 'pabd');
   }
   ```

4. **Setup Web Server**
   - Pastikan XAMPP/WAMP sedang berjalan
   - Akses `http://localhost/pabd/` di browser

## Usage

### Registrasi User
1. Buka `http://localhost/pabd/registrasi.php`
2. Isi form registrasi dengan username dan password
3. Klik "Register"

### Login
1. Buka `http://localhost/pabd/login.php`
2. Masukkan username dan password yang sudah terdaftar
3. Klik "Login"

### Mengelola Data Mahasiswa
1. **Tambah Data**: Klik tombol "Tambah Data" di halaman utama
2. **Lihat Detail**: Klik nama mahasiswa untuk melihat detail
3. **Edit Data**: Klik tombol "Ubah" pada data mahasiswa
4. **Hapus Data**: Klik tombol "Hapus" pada data mahasiswa
5. **Pencarian**: Gunakan kotak pencarian untuk mencari mahasiswa

## File Structure

```
pabd/
├── ajax/
│   └── ajax_cari.php       # AJAX search functionality
├── img/
│   └── nophoto.jpg         # Default image
├── js/
│   └── script.js           # JavaScript for search & image preview
├── functions.php           # Core PHP functions
├── index.php              # Main page
├── tambah.php             # Add student form
├── ubah.php               # Edit student form
├── detail.php             # Student detail page
├── hapus.php              # Delete student
├── login.php              # Login page
├── logout.php             # Logout functionality
├── registrasi.php         # Registration page
└── README.md              # Documentation
```

## Technologies Used

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **AJAX**: Fetch API untuk pencarian real-time
- **File Upload**: PHP file handling dengan validasi

## Features Details

### Image Upload & Preview
- Support format: JPG, JPEG, PNG
- Maksimum ukuran file: 5MB
- Preview gambar secara real-time
- Auto-generate unique filename

### Security Features
- Password hashing menggunakan `password_hash()`
- Input sanitization dengan `htmlspecialchars()`
- File upload validation
- SQL injection protection

### AJAX Search
- Pencarian real-time tanpa reload halaman
- Pencarian berdasarkan nama dan NIM
- Menggunakan Fetch API

## Contributing

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/amazing-feature`)
3. Commit perubahan (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## License

Project ini adalah open source dan tersedia di bawah [MIT License](LICENSE).

## Contact

Aan Aliudin - aanaliudin25@gmail.com

Project Link: [https://github.com/aanaliudin/pabd](https://github.com/aanaliudin/pabd)

---

**Made with ❤️ by [Aan Aliudin](https://github.com/aanaliudin)**
