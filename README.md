# Deskripsi #
Sistem Manajemen Klinik Online adalah aplikasi perangkat lunak yang mengotomatisasi dan menyederhanakan proses bisnis pelayanan kesehatan di klinik. Aplikasi ini memungkinkan tenaga medis dan pasien untuk berinteraksi secara efisien dalam pengelolaan jadwal konsultasi dan rekam medis. 
1. Proses Pelayanan Pasien
- Pendaftaran Konsultasi : Pasien dapat mendaftarkan diri untuk konsultasi dengan dokter yang diinginkan menggunakan fitur pendaftaran yang disediakan. Mereka dapat memilih berdasarkan nama dokter atau spesialisasi.
- Konsultasi : Setelah pendaftaran dikonfirmasi, pasien datang ke klinik pada jadwal yang telah ditentukan dan admin akan menginputkan data kunjungan ke dalam database termasuk catatan rekam medis hasil konsultasi.

2. Proses Manajemen Klinik
- Pengelolaan Jadwal Dokter : Admin Klinik dapat mengelola katalog buku perpustakaan dengan menambahkan, mengedit, atau menghapus buku dari koleksi.
- Pengelolaan Akun Pasien : Pasien dapat mengelola profil mereka, termasuk mengubah informasi kontak, data kesehatan, dan kata sandi mereka.

# Tujuan #
Sistem Manajemen Klinik Online ini bertujuan untuk memberikan sarana bagi pasien dan tenaga medis untuk dengan mudah dan efisien mengelola proses konsultasi secara online. Sistem ini akan meningkatkan aksesibilitas layanan klinik dan mempermudah proses pendaftaran serta pencatatan rekam medis pasien.


# Lingkup Sistem #
Sistem ini akan mencakup fitur-fitur berikut :
1. Pencarian dan penelusuran jadwal dokter serta layanan klinik.
2. Pendaftaran dan pengelolaan jadwal konsultasi pasien.
3. Perpanjangan atau penjadwalan ulang konsultasi jika jadwal dokter memungkinkan.
4. Pengelolaan akun pasien, termasuk pendaftaran, pengaturan profil, dan riwayat kunjungan.

# Aktor #
1. Pasien : Mereka dapat mendaftar dan memantau riwayat kunjungan ke klinik.
2. Admin/Tenaga Medis Klinik : Mereka dapat mengelola data pasien, jadwal dokter, mendaftar konsultasi, serta rekam medis dan transaksi konsultasi.

# Fitur #

ID Fitur	Fitur
PB-01	Login Multi-user
PB-02	Pencarian Dokter dan Jadwal
PB-03	Riwayat Kunjungan dan Rekam Medis
PB-04	Pengelolaan Akun Pasien
PB-05	Pengelolaan Data dan Jadwal Dokter
PB-06	Antarmuka Admin Klinik
PB-07	Fitur transaksi pendaftaran dan rekam medis

# Hak akses #
- Pasien

1. Registrasi akun.
2. Login.
3. Melihat jadwal dokter.
4. Melihat riwayat kunjungan.

- Admin/Tenaga Medis

1. Login.
2. Mengelola data pasien.
3. Mengelola data dan jadwal dokter.
4. Mengelola pendaftaran konsultasi.
5. Mengelola rekam medis.
6. Mengelola transaksi layanan.

# Langkah-langkah #
1. Clone repository
2. Buat sebuah database dengan nama "clinicease"
3. Import "clinicease.sql" ke dalam database
4. Buka browser(Chrome/firefox/edge)
5. Masukkan "http://localhost/UAS-PWEB-CLINICEASE"

# Login Admin #
Username : admin |
PW : admin123

# Create & login Pasien #
1. Klik daftar/buat akun
2. Masukkan data diri
3. Login menggunakan username dan password anda

## Dashboard Admin ##

# A. Tambah Data Dokter #
1. Klik button tambah 
2. Masukkan data diri dan jadwal dokter

# B. Update Data Dokter #
1. Klik button edit
2. Masukkan data diri dan jadwal yang ingin diubah

# C. Delete Data Dokter #
1. Klik button delete
2. Konfirmasi apakah ingin benar benar menghapus

# D. Proses Konsultasi #
1. Klik fitur "Antrean & Penyelesaian konsultasi
2. Periksa pasien
3. Input hasil konsultasi 

# E. Logout #

## Dashboard Pasien ##
Dashboard pasien hanya berisikan data dan jadwal dokter yang tersedia