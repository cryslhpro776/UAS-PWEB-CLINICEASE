<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicEase - Registrasi Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        :root {
            --sage:       #6B8F71;
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
            background-color: var(--cream);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
        }

        /* ── Layout shell ── */
        .reg-shell {
            display: flex;
            width: min(940px, 98vw);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(44,58,46,.12);
        }

        /* ── Left panel ── */
        .panel-left {
            flex: 0 0 38%;
            background: var(--sage);
            padding: 48px 36px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 60% at 80% 110%, rgba(255,255,255,.10) 0%, transparent 70%),
                radial-gradient(ellipse 50% 50% at 10% -10%, rgba(255,255,255,.12) 0%, transparent 60%);
        }

        .brand { position: relative; z-index: 1; }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,.18);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .brand-icon svg { width: 24px; height: 24px; fill: white; }

        .brand-name {
            font-family: 'DM Serif Display', serif;
            font-size: 22px;
            color: white;
        }

        .illo-wrap {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .illo-wrap svg {
            width: 100%;
            max-width: 210px;
            filter: drop-shadow(0 8px 24px rgba(0,0,0,.18));
        }

        /* Steps list */
        .steps-list {
            position: relative;
            z-index: 1;
        }

        .steps-list p {
            color: rgba(255,255,255,.75);
            font-size: 12.5px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .step-dot {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255,255,255,.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: white;
            flex-shrink: 0;
        }

        .step-dot.done { background: rgba(255,255,255,.55); }

        .step-label {
            font-size: 13.5px;
            color: rgba(255,255,255,.85);
            font-weight: 400;
        }

        /* ── Right panel ── */
        .panel-right {
            flex: 1;
            background: var(--white);
            padding: 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .form-heading { margin-bottom: 28px; }

        .form-heading h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 26px;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .form-heading p {
            font-size: 13.5px;
            color: var(--ink-soft);
            font-weight: 300;
        }

        /* Section label */
        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0 14px;
        }

        .section-label span {
            font-size: 11px;
            font-weight: 600;
            color: var(--sage);
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--sage-muted);
        }

        /* Input rows */
        .field-row {
            display: grid;
            gap: 12px;
            margin-bottom: 12px;
        }

        .field-row.two { grid-template-columns: 1fr 1fr; }

        .field-wrap {
            position: relative;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: var(--ink-soft);
            margin-bottom: 5px;
            letter-spacing: .2px;
        }

        .field-wrap .field-icon {
            position: absolute;
            left: 13px;
            top: calc(50% + 10px);
            transform: translateY(-50%);
            color: var(--sage);
            width: 16px;
            height: 16px;
            pointer-events: none;
        }

        .field-wrap input,
        .field-wrap select,
        .field-wrap textarea {
            width: 100%;
            background: var(--sage-muted);
            border: 1.5px solid transparent;
            border-radius: var(--radius);
            padding: 11px 13px 11px 38px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            transition: border-color .2s, background .2s;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
        }

        .field-wrap textarea {
            resize: none;
            padding-top: 11px;
            min-height: 74px;
        }

        .field-wrap select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B8F71' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            padding-right: 36px;
        }

        .field-wrap input::placeholder,
        .field-wrap textarea::placeholder {
            color: var(--ink-soft);
            font-weight: 300;
        }

        .field-wrap input:focus,
        .field-wrap select:focus,
        .field-wrap textarea:focus {
            border-color: var(--sage);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(107,143,113,.12);
        }

        /* Password toggle */
        .toggle-pw {
            position: absolute;
            right: 13px;
            top: calc(50% + 10px);
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            padding: 0;
            line-height: 1;
        }

        /* Submit button */
        .btn-primary-custom {
            width: 100%;
            padding: 13px;
            background: var(--sage);
            border: none;
            border-radius: var(--radius);
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .1s;
            letter-spacing: .3px;
            margin-top: 8px;
        }

        .btn-primary-custom:hover { background: #5a7a60; }
        .btn-primary-custom:active { transform: scale(.98); }

        /* Login link */
        .login-row {
            text-align: center;
            font-size: 13.5px;
            color: var(--ink-soft);
            margin-top: 16px;
        }

        .login-row a {
            color: var(--sage);
            font-weight: 600;
            text-decoration: none;
        }

        .login-row a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 700px) {
            .reg-shell { flex-direction: column; border-radius: 16px; }
            .panel-left { flex: none; padding: 28px 24px; }
            .illo-wrap { display: none; }
            .steps-list { display: none; }
            .panel-right { padding: 30px 24px; }
            .field-row.two { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="reg-shell">

    <!-- ── Left panel ── -->
    <div class="panel-left">
        <div class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C8 2 4 5 4 9c0 3.5 2.5 6.5 6 7.7V20h4v-3.3c3.5-1.2 6-4.2 6-7.7 0-4-4-7-8-7z"/></svg>
            </div>
            <div class="brand-name">ClinicEase</div>
        </div>

        <div class="illo-wrap">
            <svg viewBox="0 0 220 300" xmlns="http://www.w3.org/2000/svg">
                <!-- Clipboard card -->
                <rect x="40" y="20" width="140" height="180" rx="14" fill="rgba(255,255,255,.14)"/>
                <!-- Clip -->
                <rect x="85" y="12" width="50" height="18" rx="6" fill="rgba(255,255,255,.30)"/>
                <!-- Header -->
                <rect x="40" y="20" width="140" height="40" rx="14" fill="rgba(255,255,255,.22)"/>
                <rect x="56" y="35" width="60" height="9" rx="4" fill="rgba(255,255,255,.55)"/>
                <rect x="56" y="48" width="38" height="6" rx="3" fill="rgba(255,255,255,.28)"/>
                <!-- Cross icon -->
                <rect x="148" y="32" width="18" height="18" rx="5" fill="rgba(255,255,255,.25)"/>
                <rect x="156" y="35" width="2" height="12" rx="1" fill="rgba(255,255,255,.7)"/>
                <rect x="151" y="40" width="12" height="2" rx="1" fill="rgba(255,255,255,.7)"/>
                <!-- Lines -->
                <rect x="56" y="76" width="108" height="8" rx="4" fill="rgba(255,255,255,.18)"/>
                <rect x="56" y="92" width="108" height="8" rx="4" fill="rgba(255,255,255,.18)"/>
                <rect x="56" y="108" width="70" height="8" rx="4" fill="rgba(255,255,255,.18)"/>
                <!-- Divider -->
                <rect x="56" y="126" width="108" height="1" fill="rgba(255,255,255,.15)"/>
                <!-- Username / pass fields -->
                <rect x="56" y="136" width="108" height="18" rx="6" fill="rgba(255,255,255,.18)"/>
                <rect x="56" y="162" width="108" height="18" rx="6" fill="rgba(255,255,255,.18)"/>
                <!-- Button -->
                <rect x="56" y="192" width="108" height="24" rx="8" fill="rgba(255,255,255,.28)"/>
                <rect x="84" y="200" width="52" height="8" rx="4" fill="rgba(255,255,255,.65)"/>
                <!-- Person icon -->
                <circle cx="170" cy="230" r="22" fill="rgba(255,255,255,.12)"/>
                <circle cx="170" cy="224" r="7" fill="rgba(255,255,255,.30)"/>
                <path d="M158 243c0-6.6 5.4-12 12-12s12 5.4 12 12" fill="rgba(255,255,255,.30)"/>
                <!-- Dots -->
                <circle cx="50" cy="250" r="6" fill="rgba(255,255,255,.12)"/>
                <circle cx="200" cy="60" r="4" fill="rgba(255,255,255,.12)"/>
                <circle cx="210" cy="80" r="2.5" fill="rgba(255,255,255,.10)"/>
            </svg>
        </div>

        <div class="steps-list">
            <p>Langkah pendaftaran</p>
            <div class="step-item">
                <div class="step-dot done">✓</div>
                <span class="step-label">Data diri pasien</span>
            </div>
            <div class="step-item">
                <div class="step-dot done">✓</div>
                <span class="step-label">Kontak & alamat</span>
            </div>
            <div class="step-item">
                <div class="step-dot">3</div>
                <span class="step-label">Buat akun & selesai</span>
            </div>
        </div>
    </div>

    <!-- ── Right panel ── -->
    <div class="panel-right">
        <div class="form-heading">
            <h2>Daftar Akun Pasien</h2>
            <p>Lengkapi data di bawah untuk membuat akun baru.</p>
        </div>

        <form action="<?= base_url('auth/proses_registrasi'); ?>" method="POST">

            <!-- Data Diri -->
            <div class="section-label"><span>Data Diri</span></div>

            <div class="field-row" style="margin-bottom:12px;">
                <div class="field-wrap">
                    <label class="field-label">Nama Lengkap</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input type="text" name="nama_pasien" placeholder="Nama sesuai KTP" required>
                </div>
            </div>

            <div class="field-row two">
                <div class="field-wrap">
                    <label class="field-label">Tanggal Lahir</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>
                    </svg>
                    <input type="date" name="tanggal_lahir" required>
                </div>
                <div class="field-wrap">
                    <label class="field-label">Jenis Kelamin</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5"/><path d="M12 2v5M12 17v5M2 12h5M17 12h5"/>
                    </svg>
                    <select name="jenis_kelamin" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <!-- Kontak -->
            <div class="section-label"><span>Kontak & Alamat</span></div>

            <div class="field-row" style="margin-bottom:12px;">
                <div class="field-wrap">
                    <label class="field-label">Nomor HP</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 4 5.18 2 2 0 0 1 6 3h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L10.09 10.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <input type="text" name="nomor_hp" placeholder="08xx-xxxx-xxxx" required>
                </div>
            </div>

            <div class="field-row" style="margin-bottom:0;">
                <div class="field-wrap">
                    <label class="field-label">Alamat Rumah</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="top:calc(24px);">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    <textarea name="alamat" placeholder="Jalan, RT/RW, Kelurahan, Kota" required></textarea>
                </div>
            </div>

            <!-- Akun -->
            <div class="section-label"><span>Buat Akun</span></div>

            <div class="field-row" style="margin-bottom:12px;">
                <div class="field-wrap">
                    <label class="field-label">Username Baru</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    <input type="text" name="username" placeholder="Pilih username unik" required>
                </div>
            </div>

            <div class="field-row" style="margin-bottom:0;">
                <div class="field-wrap">
                    <label class="field-label">Password</label>
                    <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <input type="password" name="password" id="pwInput" placeholder="Minimal 8 karakter" required>
                    <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Tampilkan password">
                        <svg id="eyeIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary-custom">Daftar Sekarang</button>
        </form>

        <div class="login-row">
            Sudah punya akun? <a href="<?= base_url('auth'); ?>">Masuk di sini →</a>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePw() {
    const input = document.getElementById('pwInput');
    const icon  = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.06 10.06 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>';
    }
}
</script>
</body>
</html>