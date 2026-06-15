<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pasien - ClinicEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root {
            --sage:       #6B8F71;
            --sage-dark:  #4f6e55;
            --sage-light: #C8D9C9;
            --sage-muted: #EAF0EA;
            --cream:      #F5F5F0;
            --ink:        #2C3A2E;
            --ink-soft:   #5C6E5E;
            --white:      #FFFFFF;
            --radius:     14px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
        }

        /* ══ NAVBAR ══ */
        .top-nav {
            background: var(--white);
            border-bottom: 1px solid var(--sage-muted);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(44,58,46,.06);
        }

        .nav-brand { display: flex; align-items: center; gap: 10px; }

        .nav-brand-icon {
            width: 34px; height: 34px;
            background: var(--sage);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .nav-brand-icon svg { width: 18px; height: 18px; fill: white; }

        .nav-brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 18px;
            color: var(--ink);
        }

        .nav-brand-badge {
            font-size: 10px; font-weight: 600;
            background: var(--sage-muted); color: var(--sage);
            padding: 2px 8px; border-radius: 20px;
            letter-spacing: .5px; text-transform: uppercase;
        }

        .nav-right { display: flex; align-items: center; gap: 14px; }

        .nav-user { display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: var(--ink-soft); }

        .nav-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--sage-muted);
            display: flex; align-items: center; justify-content: center;
        }

        .nav-avatar svg { width: 16px; height: 16px; color: var(--sage); }
        .nav-user strong { color: var(--ink); font-weight: 600; }

        .btn-logout {
            display: flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            background: none; border: 1.5px solid var(--sage-light);
            border-radius: 10px; color: var(--ink-soft);
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            cursor: pointer; text-decoration: none;
            transition: background .15s, border-color .15s, color .15s;
        }

        .btn-logout:hover { background: #fdecea; border-color: #e57373; color: #c62828; }

        /* ══ MAIN ══ */
        .main-wrap {
            max-width: 1160px;
            margin: 0 auto;
            padding: 28px 28px;
        }

        /* ══ ANTREAN BANNER ══ */
        .queue-banner {
            display: flex;
            align-items: center;
            gap: 20px;
            background: var(--white);
            border: 1.5px solid #FDE68A;
            border-left: 5px solid #F59E0B;
            border-radius: var(--radius);
            padding: 18px 22px;
            margin-bottom: 24px;
            box-shadow: 0 4px 16px rgba(245,158,11,.08);
        }

        .queue-icon {
            width: 48px; height: 48px; flex-shrink: 0;
            background: #FEF3C7;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }

        .queue-icon svg { width: 24px; height: 24px; color: #D97706; }

        .queue-text h5 {
            font-size: 15px; font-weight: 600; color: var(--ink);
            margin-bottom: 3px;
        }

        .queue-text p { font-size: 13.5px; color: var(--ink-soft); margin: 0; line-height: 1.5; }
        .queue-text p strong { color: var(--ink); }
        .queue-text small { font-size: 12px; color: #92400E; }

        /* ══ GRID ══ */
        .portal-grid {
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 22px;
            align-items: start;
        }

        /* ══ CARD ══ */
        .p-card {
            background: var(--white);
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(44,58,46,.08);
            overflow: hidden;
        }

        .card-head {
            padding: 20px 22px 14px;
            border-bottom: 1px solid var(--sage-muted);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-head-icon {
            width: 34px; height: 34px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-head-icon.sage { background: var(--sage-muted); color: var(--sage); }
        .card-head-icon.green { background: #DCFCE7; color: #166534; }
        .card-head-icon svg { width: 17px; height: 17px; }

        .card-head h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 17px;
            color: var(--ink);
        }

        .card-body-p { padding: 20px 22px; }

        /* ══ SEARCH ══ */
        .search-row {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
        }

        .search-wrap {
            flex: 1;
            position: relative;
        }

        .search-wrap svg {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--sage);
            pointer-events: none;
        }

        .search-wrap input {
            width: 100%;
            background: var(--sage-muted);
            border: 1.5px solid transparent;
            border-radius: var(--radius);
            padding: 10px 14px 10px 38px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, background .2s;
        }

        .search-wrap input::placeholder { color: var(--ink-soft); font-weight: 300; }

        .search-wrap input:focus {
            border-color: var(--sage);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(107,143,113,.12);
        }

        .btn-search {
            padding: 10px 20px;
            background: var(--sage);
            border: none;
            border-radius: var(--radius);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
            white-space: nowrap;
        }

        .btn-search:hover { background: var(--sage-dark); }

        /* ══ TABLE ══ */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead tr { background: var(--sage-muted); }

        .data-table thead th {
            padding: 11px 14px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .7px;
            color: var(--ink-soft); border: none;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--sage-muted);
            transition: background .12s;
        }

        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #f7faf7; }

        .data-table tbody td {
            padding: 12px 14px;
            font-size: 13.5px;
            color: var(--ink);
            vertical-align: middle;
        }

        .badge-spec {
            background: var(--sage-muted); color: var(--sage-dark);
            font-size: 11.5px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }

        .badge-active {
            background: #DCFCE7; color: #166534;
            font-size: 11.5px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }

        .empty-state {
            padding: 40px; text-align: center;
            color: var(--ink-soft); font-size: 13.5px;
        }

        .empty-state svg {
            width: 36px; height: 36px;
            color: var(--sage-light);
            display: block; margin: 0 auto 10px;
        }

        /* ══ ACCORDION (rekam medis) ══ */
        .rm-list { display: flex; flex-direction: column; gap: 8px; padding: 18px 18px; }

        .rm-item {
            border: 1.5px solid var(--sage-muted);
            border-radius: var(--radius);
            overflow: hidden;
            transition: box-shadow .15s;
        }

        .rm-item:hover { box-shadow: 0 4px 14px rgba(44,58,46,.07); }

        .rm-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 16px;
            cursor: pointer;
            background: var(--white);
            border: none;
            width: 100%;
            text-align: left;
            gap: 10px;
        }

        .rm-trigger:hover { background: var(--sage-muted); }

        .rm-meta { flex: 1; }

        .rm-meta strong { display: block; font-size: 14px; color: var(--ink); margin-bottom: 2px; }
        .rm-meta span { font-size: 12px; color: var(--ink-soft); }

        .rm-chevron {
            width: 18px; height: 18px;
            color: var(--sage);
            transition: transform .2s;
            flex-shrink: 0;
        }

        .rm-item.open .rm-chevron { transform: rotate(180deg); }

        .rm-body {
            display: none;
            padding: 14px 16px;
            background: var(--cream);
            border-top: 1px solid var(--sage-muted);
        }

        .rm-item.open .rm-body { display: block; }

        .rm-section-label {
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .6px;
            color: var(--ink-soft); margin-bottom: 5px;
        }

        .rm-text {
            font-size: 13.5px; line-height: 1.6;
            color: var(--ink);
            background: var(--white);
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 12px;
        }

        .rm-text.diagnosis { color: #991B1B; background: #FEF2F2; }
        .rm-text:last-child { margin-bottom: 0; }

        @media (max-width: 820px) {
            .portal-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ══ NAVBAR ══ -->
<nav class="top-nav">
    <div class="nav-brand">
        <div class="nav-brand-icon">
            <svg viewBox="0 0 24 24"><path d="M12 2C8 2 4 5 4 9c0 3.5 2.5 6.5 6 7.7V20h4v-3.3c3.5-1.2 6-4.2 6-7.7 0-4-4-7-8-7z"/></svg>
        </div>
        <span class="nav-brand-name">ClinicEase</span>
        <span class="nav-brand-badge">Pasien</span>
    </div>

    <div class="nav-right">
        <div class="nav-user">
            <div class="nav-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </div>
            <span>Selamat datang, <strong><?= $this->session->userdata('username'); ?></strong></span>
        </div>
        <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Logout
        </a>
    </div>
</nav>

<!-- ══ MAIN ══ -->
<div class="main-wrap">

    <!-- Antrean banner -->
    <?php if($info_antrean !== null): ?>
        <div class="queue-banner">
            <div class="queue-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="queue-text">
                <h5>Anda Sedang Dalam Antrean</h5>
                <p>Nomor urut Anda: <strong>#<?= $info_antrean['nomor_urut']; ?></strong> &mdash; pemeriksaan bersama <strong><?= $info_antrean['nama_dokter']; ?></strong>.</p>
                <small>Mohon tunggu di ruang tunggu klinik hingga nomor Anda dipanggil petugas.</small>
            </div>
        </div>
    <?php endif; ?>

    <!-- Grid -->
    <div class="portal-grid">

        <!-- Kiri: Cari Dokter -->
        <div class="p-card">
            <div class="card-head">
                <div class="card-head-icon sage">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                </div>
                <h2>Cari Dokter & Jadwal Praktik</h2>
            </div>
            <div class="card-body-p">
                <form action="<?= current_url(); ?>" method="GET" class="search-row">
                    <div class="search-wrap">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text" name="keyword"
                            placeholder="Nama dokter atau spesialisasi..."
                            value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                    </div>
                    <button type="submit" class="btn-search">Cari</button>
                </form>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Dokter</th>
                            <th>Spesialisasi</th>
                            <th>Jadwal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($dokter_list)): ?>
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>
                                        </svg>
                                        Dokter tidak ditemukan.
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php foreach($dokter_list as $d): ?>
                            <tr>
                                <td><strong><?= $d->nama_dokter; ?></strong></td>
                                <td><span class="badge-spec"><?= $d->spesialisasi; ?></span></td>
                                <td style="font-size:12.5px; color:var(--ink-soft);">
                                    <?= $d->hari ? "$d->hari ($d->jam_mulai – $d->jam_selesai)" : 'Tidak ada jadwal'; ?>
                                </td>
                                <td><span class="badge-active">Melayani</span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Kanan: Rekam Medis -->
        <div class="p-card">
            <div class="card-head">
                <div class="card-head-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <h2>Riwayat Rekam Medis</h2>
            </div>

            <?php if(empty($riwayat_medis)): ?>
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                    Belum ada riwayat kunjungan medis.
                </div>
            <?php else: ?>
                <div class="rm-list">
                    <?php foreach($riwayat_medis as $index => $rm): ?>
                        <div class="rm-item" id="rm-<?= $index; ?>">
                            <button class="rm-trigger" onclick="toggleRm('rm-<?= $index; ?>')">
                                <div class="rm-meta">
                                    <strong><?= $rm->nama_dokter; ?></strong>
                                    <span><?= date('d F Y', strtotime($rm->tanggal_konsultasi)); ?></span>
                                </div>
                                <svg class="rm-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"/>
                                </svg>
                            </button>
                            <div class="rm-body">
                                <div class="rm-section-label">Diagnosis</div>
                                <div class="rm-text diagnosis"><?= $rm->diagnosis; ?></div>
                                <div class="rm-section-label">Catatan / Resep Obat</div>
                                <div class="rm-text"><?= $rm->catatan_medis ? $rm->catatan_medis : '—'; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleRm(id) {
    const el = document.getElementById(id);
    el.classList.toggle('open');
}
</script>
</body>
</html>