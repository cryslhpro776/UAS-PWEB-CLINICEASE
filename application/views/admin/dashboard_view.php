<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ClinicEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root {
            --sage:        #6B8F71;
            --sage-dark:   #4f6e55;
            --sage-light:  #C8D9C9;
            --sage-muted:  #EAF0EA;
            --cream:       #F5F5F0;
            --ink:         #2C3A2E;
            --ink-soft:    #5C6E5E;
            --white:       #FFFFFF;
            --warning-bg:  #FFF8EE;
            --warning:     #D97706;
            --radius:      14px;
            --sidebar-w:   240px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ══════════════════════════════
           NAVBAR
        ══════════════════════════════ */
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

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-brand-icon {
            width: 34px;
            height: 34px;
            background: var(--sage);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-brand-icon svg { width: 18px; height: 18px; fill: white; }

        .nav-brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 18px;
            color: var(--ink);
        }

        .nav-brand-badge {
            font-size: 10px;
            font-weight: 600;
            background: var(--sage-muted);
            color: var(--sage);
            padding: 2px 8px;
            border-radius: 20px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            color: var(--ink-soft);
        }

        .nav-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--sage-muted);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-avatar svg { width: 16px; height: 16px; color: var(--sage); }

        .nav-user strong { color: var(--ink); font-weight: 600; }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: none;
            border: 1.5px solid var(--sage-light);
            border-radius: 10px;
            color: var(--ink-soft);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background .15s, border-color .15s, color .15s;
        }

        .btn-logout:hover {
            background: #fdecea;
            border-color: #e57373;
            color: #c62828;
        }

        /* ══════════════════════════════
           MAIN CONTENT
        ══════════════════════════════ */
        .main-wrap {
            flex: 1;
            padding: 28px 32px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* Flash alert */
        .flash-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--sage-muted);
            border: 1px solid var(--sage-light);
            border-radius: var(--radius);
            color: var(--sage-dark);
            padding: 12px 16px;
            font-size: 13.5px;
            margin-bottom: 22px;
        }

        .flash-alert svg { flex-shrink: 0; }

        .flash-close {
            margin-left: auto;
            background: none;
            border: none;
            color: var(--sage);
            cursor: pointer;
            line-height: 1;
        }

        /* Page header */
        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 24px;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .page-header p {
            font-size: 13.5px;
            color: var(--ink-soft);
            font-weight: 300;
        }

        /* ══════════════════════════════
           TABS
        ══════════════════════════════ */
        .tab-bar {
            display: flex;
            gap: 4px;
            border-bottom: 2px solid var(--sage-muted);
            margin-bottom: 24px;
        }

        .tab-btn {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--ink-soft);
            cursor: pointer;
            transition: color .15s, border-color .15s;
            border-radius: 8px 8px 0 0;
        }

        .tab-btn svg { width: 15px; height: 15px; }

        .tab-btn:hover { color: var(--sage); background: var(--sage-muted); }

        .tab-btn.active {
            color: var(--sage);
            border-bottom-color: var(--sage);
            background: var(--sage-muted);
        }

        .tab-pane { display: none; }
        .tab-pane.show { display: block; }

        /* ══════════════════════════════
           SECTION HEADER
        ══════════════════════════════ */
        .section-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .section-bar h2 {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
        }

        .btn-add {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            background: var(--sage);
            border: none;
            border-radius: var(--radius);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s, transform .1s;
        }

        .btn-add:hover { background: var(--sage-dark); }
        .btn-add:active { transform: scale(.97); }

        /* ══════════════════════════════
           CARD TABLE
        ══════════════════════════════ */
        .data-card {
            background: var(--white);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(44,58,46,.08);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead tr {
            background: var(--sage-muted);
        }

        .data-table thead th {
            padding: 13px 16px;
            font-size: 11.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--ink-soft);
            border: none;
        }

        .data-table tbody tr {
            border-bottom: 1px solid var(--sage-muted);
            transition: background .12s;
        }

        .data-table tbody tr:last-child { border-bottom: none; }
        .data-table tbody tr:hover { background: #f7faf7; }

        .data-table tbody td {
            padding: 13px 16px;
            font-size: 14px;
            color: var(--ink);
            vertical-align: middle;
        }

        /* Badges */
        .badge-spec {
            background: var(--sage-muted);
            color: var(--sage-dark);
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-active {
            background: #DCFCE7;
            color: #166534;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-queue {
            background: var(--ink);
            color: white;
            font-size: 13px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* Empty state */
        .empty-state {
            padding: 48px;
            text-align: center;
            color: var(--ink-soft);
            font-size: 14px;
        }

        .empty-state svg {
            width: 40px;
            height: 40px;
            color: var(--sage-light);
            margin-bottom: 12px;
        }

        /* Action buttons in table */
        .btn-queue {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            background: none;
            border: 1.5px solid var(--sage-light);
            border-radius: 8px;
            color: var(--sage);
            font-family: 'DM Sans', sans-serif;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background .12s, border-color .12s;
        }

        .btn-queue:hover {
            background: var(--sage-muted);
            border-color: var(--sage);
        }

        .btn-examine {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: #DCFCE7;
            border: none;
            border-radius: 8px;
            color: #166534;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background .12s;
        }

        .btn-examine:hover { background: #bbf7d0; }

        /* Action group (edit/delete/cancel) */
        .action-group {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border: 1.5px solid var(--sage-light);
            border-radius: 8px;
            background: none;
            cursor: pointer;
            transition: background .12s, border-color .12s, color .12s;
            color: var(--ink-soft);
        }

        .btn-icon svg { width: 14px; height: 14px; }

        .btn-icon.edit:hover {
            background: var(--sage-muted);
            border-color: var(--sage);
            color: var(--sage-dark);
        }

        .btn-icon.delete:hover,
        .btn-cancel:hover {
            background: #fdecea;
            border-color: #e57373;
            color: #c62828;
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 7px 12px;
            background: none;
            border: 1.5px solid var(--sage-light);
            border-radius: 8px;
            color: #c62828;
            font-family: 'DM Sans', sans-serif;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background .12s, border-color .12s;
        }

        /* ══════════════════════════════
           MODALS
        ══════════════════════════════ */
        .modal-content {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(44,58,46,.16);
            font-family: 'DM Sans', sans-serif;
        }

        .modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--sage-muted);
        }

        .modal-header.sage { background: var(--sage); }
        .modal-header.teal { background: #2A7F7F; }
        .modal-header.green { background: #2D7A4F; }
        .modal-header.red { background: #c0392b; }

        .modal-title {
            font-family: 'DM Serif Display', serif;
            font-size: 18px;
            color: white;
        }

        .btn-close-white { filter: brightness(0) invert(1); opacity: .8; }
        .btn-close-white:hover { opacity: 1; }

        .modal-body { padding: 24px; background: var(--white); }
        .modal-footer {
            padding: 16px 24px;
            background: var(--white);
            border-top: 1px solid var(--sage-muted);
        }

        /* Modal form fields */
        .m-field { margin-bottom: 14px; }

        .m-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--ink-soft);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .m-input,
        .m-select,
        .m-textarea {
            width: 100%;
            background: var(--sage-muted);
            border: 1.5px solid transparent;
            border-radius: var(--radius);
            padding: 11px 14px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            outline: none;
            transition: border-color .2s, background .2s;
            appearance: none;
            -webkit-appearance: none;
        }

        .m-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B8F71' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            padding-right: 36px;
        }

        .m-input:focus, .m-select:focus, .m-textarea:focus {
            border-color: var(--sage);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(107,143,113,.12);
        }

        .m-textarea { resize: none; }

        .m-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 18px 0 14px;
        }

        .m-divider span {
            font-size: 11px;
            font-weight: 600;
            color: var(--sage);
            text-transform: uppercase;
            letter-spacing: .8px;
            white-space: nowrap;
        }

        .m-divider::before, .m-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sage-muted);
        }

        .m-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        /* Submit buttons */
        .btn-modal-submit {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: var(--radius);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .15s, transform .1s;
            letter-spacing: .3px;
        }

        .btn-modal-submit.sage   { background: var(--sage); }
        .btn-modal-submit.teal  { background: #2A7F7F; }
        .btn-modal-submit.green { background: #2D7A4F; }
        .btn-modal-submit:hover  { opacity: .88; }
        .btn-modal-submit:active { transform: scale(.98); }

        /* Confirmation footer buttons (edit/delete modals) */
        .btn-modal-cancel {
            flex: 1;
            padding: 11px 20px;
            border: 1.5px solid var(--sage-light);
            border-radius: var(--radius);
            background: none;
            color: var(--ink-soft);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .12s;
        }
        .btn-modal-cancel:hover { background: var(--sage-muted); }

        .btn-modal-danger {
            flex: 1;
            padding: 11px 20px;
            border: none;
            border-radius: var(--radius);
            background: #c0392b;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .15s;
        }
        .btn-modal-danger:hover { opacity: .88; }
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
        <span class="nav-brand-badge">Admin</span>
    </div>

    <div class="nav-right">
        <div class="nav-user">
            <div class="nav-avatar">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
            </div>
            <span>Login sebagai: <strong><?= $this->session->userdata('username'); ?></strong></span>
        </div>
        <a href="<?= base_url('auth/logout'); ?>" class="btn-logout">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Log Out
        </a>
    </div>
</nav>

<!-- ══ MAIN ══ -->
<div class="main-wrap">

    <!-- Flash -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="flash-alert" id="flashAlert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <?= $this->session->flashdata('success'); ?>
            <button class="flash-close" onclick="document.getElementById('flashAlert').remove()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    <?php endif; ?>

    <!-- Page header -->
    <div class="page-header">
        <h1>Dashboard Admin</h1>
        <p>Kelola dokter, jadwal, dan antrean konsultasi pasien.</p>
    </div>

    <!-- Tabs -->
    <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('dokter', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
            Kelola Data Dokter
        </button>
        <button class="tab-btn" onclick="switchTab('antrean', this)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            Antrean & Penyelesaian Konsultasi
        </button>
    </div>

    <!-- Tab: Dokter -->
    <div class="tab-pane show" id="tab-dokter">
        <div class="section-bar">
            <h2>Master Data & Jadwal Dokter</h2>
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Tambah Dokter & Jadwal
            </button>
        </div>

        <div class="data-card">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th>No. SIP</th>
                        <th>Jadwal Praktik</th>
                        <th>Status Slot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($dokter_list)): ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>
                                    </svg>
                                    <div>Belum ada data dokter.</div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach ($dokter_list as $d): ?>
                        <tr>
                            <td><strong><?= $d->nama_dokter; ?></strong></td>
                            <td><span class="badge-spec"><?= $d->spesialisasi; ?></span></td>
                            <td style="color:var(--ink-soft); font-size:13px;"><?= $d->nomor_sip; ?></td>
                            <td style="font-size:13.5px;"><?= $d->hari ? "$d->hari ($d->jam_mulai – $d->jam_selesai)" : '<span style="color:var(--ink-soft)">Belum diatur</span>'; ?></td>
                            <td>
                                <span class="badge-active">Aktif</span>
                                <button class="btn-queue ms-2" data-bs-toggle="modal" data-bs-target="#modalDaftar"
                                    onclick="setJadwalId('<?= $d->id_jadwal; ?>')">
                                    + Antrean
                                </button>
                            </td>
                            <td>
                                <div class="action-group">
                                    <!-- Edit -->
                                    <button class="btn-icon edit" data-bs-toggle="modal" data-bs-target="#modalEditDokter"
                                        data-id="<?= $d->id_dokter; ?>"
                                        data-id-jadwal="<?= $d->id_jadwal; ?>"
                                        data-nama="<?= htmlspecialchars($d->nama_dokter, ENT_QUOTES); ?>"
                                        data-spesialisasi="<?= htmlspecialchars($d->spesialisasi, ENT_QUOTES); ?>"
                                        data-sip="<?= htmlspecialchars($d->nomor_sip, ENT_QUOTES); ?>"
                                        data-hari="<?= $d->hari; ?>"
                                        data-jam-mulai="<?= $d->jam_mulai; ?>"
                                        data-jam-selesai="<?= $d->jam_selesai; ?>"
                                        onclick="setEditDokter(this)" title="Edit">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </button>

                                    <!-- Hapus -->
                                    <button class="btn-icon delete" data-bs-toggle="modal" data-bs-target="#modalHapusDokter"
                                        data-id="<?= $d->id_dokter; ?>"
                                        data-nama="<?= htmlspecialchars($d->nama_dokter, ENT_QUOTES); ?>"
                                        onclick="setHapusDokter(this)" title="Hapus">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                            <path d="M10 11v6"/><path d="M14 11v6"/>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tab: Antrean -->
    <div class="tab-pane" id="tab-antrean">
        <div class="section-bar">
            <h2>Pasien Menunggu Konsultasi</h2>
        </div>

        <div class="data-card">
            <table class="data-table">
                <thead>
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
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/>
                                    </svg>
                                    <div>Tidak ada pasien dalam antrean saat ini.</div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php $no = 1; foreach ($antrean as $a): ?>
                        <tr>
                            <td><span class="badge-queue">#<?= $no++; ?></span></td>
                            <td><strong><?= $a->nama_pasien; ?></strong></td>
                            <td style="font-size:13.5px;"><?= $a->nama_dokter; ?></td>
                            <td style="font-size:13.5px; color:var(--ink-soft);"><?= date('d M Y', strtotime($a->tanggal_konsultasi)); ?></td>
                            <td>
                                <div class="action-group">
                                    <button class="btn-examine" data-bs-toggle="modal" data-bs-target="#modalSelesai"
                                        onclick="setSelesaiData('<?= $a->id_konsultasi; ?>', '<?= $a->id_pasien; ?>', '<?= $a->id_jadwal; ?>')">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                                        </svg>
                                        Periksa Pasien
                                    </button>

                                    <button class="btn-cancel" data-bs-toggle="modal" data-bs-target="#modalHapusAntrean"
                                        data-id="<?= $a->id_konsultasi; ?>"
                                        data-nama="<?= htmlspecialchars($a->nama_pasien, ENT_QUOTES); ?>"
                                        onclick="setHapusAntrean(this)">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                        Batalkan
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ══ MODAL: Tambah Dokter ══ -->
<div class="modal fade" id="modalTambahDokter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/tambah_dokter'); ?>" method="POST" class="modal-content">
            <div class="modal-header sage">
                <h5 class="modal-title">Form Input Data Dokter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="m-field">
                    <label class="m-label">Nama Dokter</label>
                    <input type="text" name="nama_dokter" class="m-input" placeholder="dr. Nama Lengkap, Sp.X" required>
                </div>
                <div class="m-row">
                    <div class="m-field">
                        <label class="m-label">Spesialisasi</label>
                        <input type="text" name="spesialisasi" class="m-input" placeholder="Umum, Gigi, dll." required>
                    </div>
                    <div class="m-field">
                        <label class="m-label">Nomor SIP</label>
                        <input type="text" name="nomor_sip" class="m-input" placeholder="SIP-XXXX" required>
                    </div>
                </div>

                <div class="m-divider"><span>Jadwal Kerja Praktik</span></div>

                <div class="m-field">
                    <label class="m-label">Hari Praktik</label>
                    <select name="hari" class="m-select" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
                <div class="m-row">
                    <div class="m-field">
                        <label class="m-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="m-input" required>
                    </div>
                    <div class="m-field">
                        <label class="m-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="m-input" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-modal-submit sage">Simpan Data Dokter</button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL: Edit Dokter ══ -->
<div class="modal fade" id="modalEditDokter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/update_dokter'); ?>" method="POST" class="modal-content">
            <div class="modal-header sage">
                <h5 class="modal-title">Edit Data Dokter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_dokter" id="edit_id_dokter">
                <input type="hidden" name="id_jadwal" id="edit_id_jadwal">

                <div class="m-field">
                    <label class="m-label">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="edit_nama_dokter" class="m-input" required>
                </div>
                <div class="m-row">
                    <div class="m-field">
                        <label class="m-label">Spesialisasi</label>
                        <input type="text" name="spesialisasi" id="edit_spesialisasi" class="m-input" required>
                    </div>
                    <div class="m-field">
                        <label class="m-label">Nomor SIP</label>
                        <input type="text" name="nomor_sip" id="edit_nomor_sip" class="m-input" required>
                    </div>
                </div>

                <div class="m-divider"><span>Jadwal Kerja Praktik</span></div>

                <div class="m-field">
                    <label class="m-label">Hari Praktik</label>
                    <select name="hari" id="edit_hari" class="m-select" required>
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>
                <div class="m-row">
                    <div class="m-field">
                        <label class="m-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="edit_jam_mulai" class="m-input" required>
                    </div>
                    <div class="m-field">
                        <label class="m-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="edit_jam_selesai" class="m-input" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-modal-submit sage">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL: Hapus Dokter ══ -->
<div class="modal fade" id="modalHapusDokter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/hapus_dokter'); ?>" method="POST" class="modal-content">
            <div class="modal-header red">
                <h5 class="modal-title">Hapus Data Dokter</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_dokter" id="hapus_id_dokter">
                <p style="font-size:14px; color:var(--ink);">
                    Yakin ingin menghapus data dokter
                    <strong id="hapus_nama_dokter"></strong>?
                    Jadwal praktiknya juga akan ikut terhapus dan tindakan ini
                    <strong>tidak dapat dibatalkan</strong>.
                </p>
            </div>
            <div class="modal-footer" style="display:flex; gap:10px;">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-modal-danger">Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL: Daftar Konsultasi ══ -->
<div class="modal fade" id="modalDaftar" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/daftar_konsultasi'); ?>" method="POST" class="modal-content">
            <div class="modal-header teal">
                <h5 class="modal-title">Registrasi Pendaftaran Konsultasi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_jadwal" id="input_id_jadwal">
                <div class="m-field">
                    <label class="m-label">Pilih Pasien Klinik</label>
                    <select name="id_pasien" class="m-select" required>
                        <option value="">-- Cari Pasien Terdaftar --</option>
                        <?php foreach ($pasien_list as $p): ?>
                            <option value="<?= $p->id_pasien; ?>"><?= $p->nama_pasien; ?> (<?= $p->nomor_hp; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-modal-submit teal">Proses Masuk Antrean</button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL: Selesaikan Konsultasi ══ -->
<div class="modal fade" id="modalSelesai" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/selesaikan_konsultasi'); ?>" method="POST" class="modal-content">
            <div class="modal-header green">
                <h5 class="modal-title">Input Catatan Rekam Medis Pasien</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_konsultasi" id="selesai_id_konsultasi">
                <input type="hidden" name="id_pasien"     id="selesai_id_pasien">
                <input type="hidden" name="id_jadwal"     id="selesai_id_jadwal">

                <div class="m-field">
                    <label class="m-label">Diagnosis Medis</label>
                    <textarea name="diagnosis" class="m-textarea" rows="3"
                        placeholder="Hasil pemeriksaan penyakit..." required></textarea>
                </div>
                <div class="m-field">
                    <label class="m-label">Resep Obat / Catatan Tambahan</label>
                    <textarea name="catatan_medis" class="m-textarea" rows="3"
                        placeholder="Tulis resep atau instruksi dokter..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-modal-submit green">Simpan Rekam Medis & Selesai</button>
            </div>
        </form>
    </div>
</div>

<!-- ══ MODAL: Batalkan Antrean ══ -->
<div class="modal fade" id="modalHapusAntrean" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('admin/hapus_konsultasi'); ?>" method="POST" class="modal-content">
            <div class="modal-header red">
                <h5 class="modal-title">Batalkan Antrean</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_konsultasi" id="hapus_id_konsultasi">
                <p style="font-size:14px; color:var(--ink);">
                    Batalkan antrean konsultasi untuk pasien
                    <strong id="hapus_nama_antrean"></strong>?
                </p>
            </div>
            <div class="modal-footer" style="display:flex; gap:10px;">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn-modal-danger">Ya, Batalkan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* Tab switching */
    function switchTab(name, btn) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + name).classList.add('show');
        btn.classList.add('active');
    }

    /* Original JS — unchanged */
    function setJadwalId(id) { document.getElementById('input_id_jadwal').value = id; }
    function setSelesaiData(konsultasiId, pasienId, jadwalId) {
        document.getElementById('selesai_id_konsultasi').value = konsultasiId;
        document.getElementById('selesai_id_pasien').value = pasienId;
        document.getElementById('selesai_id_jadwal').value = jadwalId;
    }

    /* Isi modal Edit Dokter dengan data dari tombol yang diklik */
    function setEditDokter(btn) {
        document.getElementById('edit_id_dokter').value     = btn.dataset.id;
        document.getElementById('edit_id_jadwal').value     = btn.dataset.idJadwal;
        document.getElementById('edit_nama_dokter').value   = btn.dataset.nama;
        document.getElementById('edit_spesialisasi').value  = btn.dataset.spesialisasi;
        document.getElementById('edit_nomor_sip').value     = btn.dataset.sip;
        document.getElementById('edit_hari').value          = btn.dataset.hari;
        document.getElementById('edit_jam_mulai').value     = btn.dataset.jamMulai;
        document.getElementById('edit_jam_selesai').value   = btn.dataset.jamSelesai;
    }

    /* Isi modal Hapus Dokter */
    function setHapusDokter(btn) {
        document.getElementById('hapus_id_dokter').value = btn.dataset.id;
        document.getElementById('hapus_nama_dokter').textContent = btn.dataset.nama;
    }

    /* Isi modal Batalkan Antrean */
    function setHapusAntrean(btn) {
        document.getElementById('hapus_id_konsultasi').value = btn.dataset.id;
        document.getElementById('hapus_nama_antrean').textContent = btn.dataset.nama;
    }
</script>
</body>
</html>