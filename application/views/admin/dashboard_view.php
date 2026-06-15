<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - ClinicEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand text-info font-monospace" href="#">ClinicEase Admin Panel</a>
            <span class="navbar-text me-3">Login sebagai:
                <strong><?= $this->session->userdata('username'); ?></strong></span>
            <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">Log Out</a>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <ul class="nav nav-tabs mb-4" id="clinicTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="dokter-tab" data-bs-toggle="tab" data-bs-target="#dokter"
                    type="button" role="tab">Kelola Data Dokter</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="antrean-tab" data-bs-toggle="tab" data-bs-target="#antrean" type="button"
                    role="tab">Antrean & Penyelesaian Konsultasi</button>
            </li>
        </ul>

        <div class="tab-content" id="clinicTabsContent">

            <div class="tab-pane fade show active" id="dokter" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Master Data & Jadwal Dokter</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">+
                        Tambah Dokter & Jadwal</button>
                </div>

                <div class="card border-0 shadow-sm">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Dokter</th>
                                <th>Spesialisasi</th>
                                <th>No. SIP</th>
                                <th>Jadwal Praktik</th>
                                <th>Status Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dokter_list as $d): ?>
                                <tr>
                                    <td><strong><?= $d->nama_dokter; ?></strong></td>
                                    <td><span class="badge bg-secondary"><?= $d->spesialisasi; ?></span></td>
                                    <td><?= $d->nomor_sip; ?></td>
                                    <td><?= $d->hari ? "$d->hari ($d->jam_mulai - $d->jam_selesai)" : 'Belum diatur'; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Aktif</span>
                                        <button class="btn btn-sm btn-outline-primary ms-2 py-0 px-2" data-bs-toggle="modal"
                                            data-bs-target="#modalDaftar" onclick="setJadwalId('<?= $d->id_jadwal; ?>')">
                                            + Tambah Antrean
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="antrean" role="tabpanel">
                <h5>Pasien Menunggu Konsultasi </h5>
                <div class="card border-0 shadow-sm">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-warning">
                            <tr>
                                <th>No. Antrean</th>
                                <th>Nama Pasien</th>
                                <th>Dokter Tujuan</th>
                                <th>Tanggal Periksa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($antrean)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted p-4">Tidak ada pasien dalam antrean.</td>
                                </tr>
                            <?php endif; ?>

                            <?php
                            $no = 1; // Counter nomor antrean
                            foreach ($antrean as $a):
                                ?>
                                <tr>
                                    <td><span class="badge bg-dark fs-6">#<?= $no++; ?></span></td>
                                    <td><strong><?= $a->nama_pasien; ?></strong></td>
                                    <td><?= $a->nama_dokter; ?></td>
                                    <td><?= date('d-m-Y', strtotime($a->tanggal_konsultasi)); ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalSelesai"
                                            onclick="setSelesaiData('<?= $a->id_konsultasi; ?>', '<?= $a->id_pasien; ?>', '<?= $a->id_jadwal; ?>')">
                                            Periksa Pasien
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalTambahDokter" tabindex="-1">
            <div class="modal-dialog">
                <form action="<?= base_url('admin/tambah_dokter'); ?>" method="POST" class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Form Input Data Dokter</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2"><label class="form-label">Nama Dokter</label><input type="text"
                                name="nama_dokter" class="form-control" required></div>
                        <div class="mb-2"><label class="form-label">Spesialisasi</label><input type="text"
                                name="spesialisasi" class="form-control" required></div>
                        <div class="mb-2"><label class="form-label">Nomor SIP</label><input type="text" name="nomor_sip"
                                class="form-control" required></div>
                        <hr>
                        <h6>Atur Jadwal Kerja Praktek:</h6>
                        <div class="mb-2"><label class="form-label">Hari</label><input type="text" name="hari"
                                class="form-control" placeholder="Contoh: Senin" required></div>
                        <div class="row">
                            <div class="col"><label class="form-label">Jam Mulai</label><input type="time"
                                    name="jam_mulai" class="form-control" required></div>
                            <div class="col"><label class="form-label">Jam Selesai</label><input type="time"
                                    name="jam_selesai" class="form-control" required></div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary w-100">Simpan Data
                            Dokter</button></div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalDaftar" tabindex="-1">
            <div class="modal-dialog">
                <form action="<?= base_url('admin/daftar_konsultasi'); ?>" method="POST" class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Registrasi Pendaftaran Konsultasi </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_jadwal" id="input_id_jadwal">
                        <div class="mb-3">
                            <label class="form-label">Pilih Pasien Klinik</label>
                            <select name="id_pasien" class="form-select" required>
                                <option value="">-- Cari Pasien Terdaftar --</option>
                                <?php foreach ($pasien_list as $p): ?>
                                    <option value="<?= $p->id_pasien; ?>"><?= $p->nama_pasien; ?> (<?= $p->nomor_hp; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-info text-white w-100">Proses Masuk
                            Antrean</button></div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalSelesai" tabindex="-1">
            <div class="modal-dialog">
                <form action="<?= base_url('admin/selesaikan_konsultasi'); ?>" method="POST" class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Input Catatan Rekam Medis Pasien</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_konsultasi" id="selesai_id_konsultasi">
                        <input type="hidden" name="id_pasien" id="selesai_id_pasien">
                        <input type="hidden" name="id_jadwal" id="selesai_id_jadwal">

                        <div class="mb-3"><label class="form-label">Diagnosis Medis</label><textarea name="diagnosis"
                                class="form-control" rows="3" placeholder="Hasil pemeriksaan penyakit..."
                                required></textarea></div>
                        <div class="mb-3"><label class="form-label">Resep Obat / Catatan Tambahan</label><textarea
                                name="catatan_medis" class="form-control" rows="3"
                                placeholder="Tulis resep atau instruksi dokter..."></textarea></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-success w-100">Simpan Rekam Medis &
                            Selesai</button></div>
                </form>
            </div>
        </div>

        <script>
            function setJadwalId(id) { document.getElementById('input_id_jadwal').value = id; }
            function setSelesaiData(konsultasiId, pasienId, jadwalId) {
                document.getElementById('selesai_id_konsultasi').value = konsultasiId;
                document.getElementById('selesai_id_pasien').value = pasienId;
                document.getElementById('selesai_id_jadwal').value = jadwalId;
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>