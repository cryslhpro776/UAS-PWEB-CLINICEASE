-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jun 2026 pada 07.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicease`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialisasi` varchar(100) NOT NULL,
  `nomor_sip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialisasi`, `nomor_sip`) VALUES
(1, 'Haekal', 'senang senang', '12345'),
(2, 'irham', 'ngerusak', '456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_dokter`
--

CREATE TABLE `jadwal_dokter` (
  `id_jadwal` int(11) NOT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` enum('tersedia','terisi') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_dokter`
--

INSERT INTO `jadwal_dokter` (`id_jadwal`, `id_dokter`, `hari`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(1, 1, 'Senin', '08:00:00', '17:00:00', 'terisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `id_dokter` int(11) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tanggal_konsultasi` date NOT NULL,
  `status_konsultasi` enum('menunggu','selesai') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `id_pasien`, `id_dokter`, `id_jadwal`, `tanggal_konsultasi`, `status_konsultasi`) VALUES
(2, 2, 1, 1, '2026-06-14', 'selesai'),
(4, 2, 1, 1, '2026-06-14', 'selesai'),
(5, 2, 1, 1, '2026-06-14', 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `nomor_hp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `id_user`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `nomor_hp`, `alamat`) VALUES
(2, 3, 'Haekal', '2026-06-14', 'L', '081', 'dasan sari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rekam_medis` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `diagnosis` text NOT NULL,
  `catatan_medis` text DEFAULT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekam_medis`
--

INSERT INTO `rekam_medis` (`id_rekam_medis`, `id_konsultasi`, `id_pasien`, `diagnosis`, `catatan_medis`, `tanggal_input`) VALUES
(2, 2, 2, 'jatuh', 'istirahat', '2026-06-14 04:48:20'),
(3, 4, 2, 'cacat', 'istirahat', '2026-06-14 04:53:00'),
(4, 5, 2, 'mati', 'tidur', '2026-06-14 04:54:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pasien') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(3, 'Haekal', '$2y$10$g0qVRME1BTLewTmo95tEhOdtLsb2urG9b4fh0.5ioHq2G8LDkf5jK', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rekam_medis`),
  ADD KEY `id_konsultasi` (`id_konsultasi`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rekam_medis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_dokter`
--
ALTER TABLE `jadwal_dokter`
  ADD CONSTRAINT `jadwal_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE,
  ADD CONSTRAINT `konsultasi_ibfk_3` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_dokter` (`id_jadwal`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
