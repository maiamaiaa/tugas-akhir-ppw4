# 📇 Sistem Manajemen Kontak

Aplikasi web sederhana untuk mengelola data kontak menggunakan PHP dan Session Management.

## 📋 Deskripsi

Sistem Manajemen Kontak adalah aplikasi berbasis web yang memungkinkan pengguna untuk menambah, mengedit, menampilkan, dan menghapus data kontak. Aplikasi ini menggunakan PHP Session untuk penyimpanan data sementara tanpa memerlukan database.

## ✨ Fitur

- ➕ **Tambah Kontak Baru** - Menambahkan kontak dengan validasi form
- 📋 **Daftar Kontak** - Menampilkan semua kontak yang tersimpan
- ✏️ **Edit Kontak** - Mengubah informasi kontak yang sudah ada
- 🗑️ **Hapus Kontak** - Menghapus kontak individual atau semua kontak sekaligus
- ✅ **Validasi Form** - Validasi input untuk nama, telepon, dan email
- 💾 **Session Management** - Data tersimpan dalam session browser
- 📱 **Responsive Design** - Tampilan yang optimal di berbagai ukuran layar

## 🛠️ Teknologi

- **PHP** - Backend logic dan session management
- **HTML5** - Struktur halaman web
- **CSS3** - Styling dan responsive design
- **JavaScript** - Konfirmasi penghapusan data

## 📁 Struktur Folder

```
sistem-manajemen-kontak/
│
├── index.php          # File PHP utama (logic & tampilan)
├── style.css          # File CSS untuk styling
└── README.md          # Dokumentasi project
```

## 🚀 Cara Instalasi

### Prasyarat
- PHP 7.4 atau lebih tinggi
- Web browser modern (Chrome, Firefox, Edge, Safari)

### Langkah Instalasi

1. **Clone atau Download Project**
   ```bash
   git clone <repository-url>
   cd sistem-manajemen-kontak
   ```

2. **Jalankan PHP Built-in Server**
   ```bash
   php -S localhost:8000
   ```

3. **Buka Browser**
   ```
   http://localhost:8000
   ```

## 💻 Cara Penggunaan

### Menambah Kontak Baru

1. Isi form "Tambah Kontak Baru"
2. Field yang wajib diisi:
   - **Nama Lengkap** (required)
   - **Nomor Telepon** (required, hanya angka dan karakter +, -, (), spasi)
3. Field opsional:
   - **Email** (harus format email yang valid)
   - **Alamat**
4. Klik tombol "➕ Tambah Kontak"

### Mengedit Kontak

1. Klik tombol "✏️ Edit" pada kontak yang ingin diubah
2. Form akan terisi otomatis dengan data kontak
3. Ubah data yang diperlukan
4. Klik tombol "💾 Update Kontak"

### Menghapus Kontak

1. **Hapus Individual**: Klik tombol "🗑️ Hapus" pada kontak yang ingin dihapus
2. **Hapus Semua**: Klik tombol "🗑️ Hapus Semua Kontak" di bagian bawah daftar
3. Konfirmasi penghapusan akan muncul

## ⚙️ Validasi Form

Sistem memiliki validasi sebagai berikut:

| Field | Validasi |
|-------|----------|
| Nama | Wajib diisi, tidak boleh kosong |
| Telepon | Wajib diisi, hanya boleh berisi angka dan karakter +, -, (), spasi |
| Email | Format email yang valid (jika diisi) |
| Alamat | Opsional, tidak ada validasi khusus |

## 📊 Session Management

- Data kontak disimpan dalam `$_SESSION['contacts']`
- Data tersimpan selama browser/tab tidak ditutup
- Tidak memerlukan database
- Data akan hilang setelah session berakhir atau browser ditutup

## 🎨 Fitur Tampilan

- **Gradient Background** - Background warna gradien yang menarik
- **Card Design** - Komponen card untuk tampilan yang modern
- **Hover Effects** - Animasi saat hover pada kontak
- **Icons** - Emoji icons untuk visual yang menarik
- **Responsive** - Menyesuaikan dengan ukuran layar
- **Empty State** - Tampilan khusus saat belum ada data

## 🔒 Keamanan

- **htmlspecialchars()** - Mencegah XSS attack pada output
- **filter_var()** - Validasi email yang aman
- **preg_match()** - Validasi format nomor telepon
- **Konfirmasi Hapus** - JavaScript confirmation sebelum menghapus data

## 🐛 Troubleshooting

### Port sudah digunakan
```bash
# Gunakan port lain
php -S localhost:8080
```

### Session tidak menyimpan data
- Pastikan PHP session sudah diaktifkan
- Check permission folder temporary session
- Restart PHP server

### CSS tidak terbaca
- Pastikan file `style.css` ada di folder yang sama dengan `index.php`
- Check console browser untuk error 404

## 📝 Contoh Data

Contoh pengisian form:

```
Nama Lengkap: John Doe
Nomor Telepon: 0812-3456-7890
Email: john.doe@example.com
Alamat: Jl. Contoh No. 123, Jakarta
```

## 🎓 Tujuan Pembelajaran

Project ini dibuat untuk mempelajari:
- PHP Session Management
- Form Handling & Validation
- CRUD Operations
- Responsive Web Design
- Clean Code Practice

## 👨‍💻 Author

- **Tugas Akhir** - Sistem Manajemen Kontak Sederhana
- **Teknologi**: PHP, HTML, CSS

## 📄 License

Project ini dibuat untuk keperluan pembelajaran.

## 🤝 Kontribusi

Jika ingin berkontribusi:
1. Fork repository
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**Happy Coding! 🚀**