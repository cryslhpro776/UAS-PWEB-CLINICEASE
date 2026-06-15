<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portal Pasien - ClinicEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
  <div class="container">
    <a class="navbar-brand font-monospace" href="#">ClinicEase Pasien</a>
    <span class="navbar-text me-3 text-white">Selamat Datang, <strong><?= $this->session->userdata('username'); ?></strong></span>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-light text-danger fw-bold">Logout</a>
  </div>
</nav>

<div class="container mt-4">
    <?php if($info_antrean !== null): ?>
        <div class="alert alert-warning border-warning shadow-sm d-flex align-items-center mb-4" role="alert">
            <div class="fs-1 me-4">⏱️</div>
            <div>
                <h5 class="alert-heading mb-1 text-dark">Anda Sedang Dalam Antrean Pendaftaran</h5>
                <p class="mb-0">Saat ini Anda berada pada <strong>Nomor Urut Antrean ke-<?= $info_antrean['nomor_urut']; ?></strong> untuk pemeriksaan bersama <strong><?= $info_antrean['nama_dokter']; ?></strong>.</p>
                <small class="text-muted">Mohon tunggu di ruang tunggu klinik hingga nomor urut Anda dipanggil oleh petugas.</small>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="card-title text-primary mb-3">Cari Dokter & Jadwal Praktik</h5>
                
                <form action="<?= current_url(); ?>" method="GET" class="d-flex mb-3">
                    <input type="text" name="keyword" class="form-control me-2" placeholder="Ketik nama dokter / spesialisasi..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                    <button type="submit" class="btn btn-primary px-4">Cari</button>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Dokter</th>
                                <th>Spesialisasi</th>
                                <th>Jadwal</th>
                                <th>Status Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($dokter_list)): ?>
                                <tr><td colspan="4" class="text-center text-muted py-3">Dokter tidak ditemukan.</td></tr>
                            <?php endif; ?>
                            <?php foreach($dokter_list as $d): ?>
                            <tr>
                                <td><strong><?= $d->nama_dokter; ?></strong></td>
                                <td><span class="badge bg-info text-dark"><?= $d->spesialisasi; ?></span></td>
                                <td><small><?= $d->hari ? "$d->hari ($d->jam_mulai - $d->jam_selesai)" : 'Tidak ada jadwal'; ?></small></td>
                                <td>
                                    <span class="badge bg-success">Melayani</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="card-title text-success mb-3">Riwayat Rekam Medis Anda</h5>
                
                <?php if(empty($riwayat_medis)): ?>
                    <div class="text-center py-4 text-muted">
                        <p class="mb-0">Belum ada riwayat kunjungan pemeriksaan medis.</p>
                    </div>
                <?php else: ?>
                    <div class="accordion" id="accordionRekamMedis">
                        <?php foreach($riwayat_medis as $index => $rm): ?>
                            <div class="accordion-item mb-2 border-0 shadow-sm">
                                <h2 class="accordion-header" id="heading<?= $index; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index; ?>">
                                        <div class="d-flex flex-column text-start">
                                            <span class="fw-bold text-dark"><?= $rm->nama_dokter; ?></span>
                                            <small class="text-muted"><?= date('d F Y', strtotime($rm->tanggal_konsultasi)); ?></small>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse<?= $index; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionRekamMedis">
                                    <div class="accordion-body bg-white">
                                        <p class="mb-1"><strong>Diagnosis:</strong></p>
                                        <p class="text-danger bg-light p-2 rounded small"><?= $rm->diagnosis; ?></p>
                                        
                                        <p class="mb-1"><strong>Catatan / Resep Obat:</strong></p>
                                        <p class="text-dark bg-light p-2 rounded small"><?= $rm->catatan_medis ? $rm->catatan_medis : '-'; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>