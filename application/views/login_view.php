<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicEase - Login</title>
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
        }

        /* ── Layout shell ── */
        .login-shell {
            display: flex;
            width: min(900px, 96vw);
            min-height: 540px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(44,58,46,.12);
        }

        /* ── Left panel (illustration) ── */
        .panel-left {
            flex: 0 0 42%;
            background: var(--sage);
            padding: 48px 40px;
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

        .brand {
            position: relative;
            z-index: 1;
        }

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
            letter-spacing: .3px;
        }

        /* SVG illustration (inline) */
        .illo-wrap {
            position: relative;
            z-index: 1;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 0;
        }

        .illo-wrap svg {
            width: 100%;
            max-width: 220px;
            filter: drop-shadow(0 8px 24px rgba(0,0,0,.18));
        }

        .panel-tagline {
            position: relative;
            z-index: 1;
            color: rgba(255,255,255,.82);
            font-size: 13.5px;
            font-weight: 300;
            line-height: 1.55;
        }

        .panel-tagline strong {
            display: block;
            color: white;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
            font-family: 'DM Serif Display', serif;
        }

        /* ── Right panel (form) ── */
        .panel-right {
            flex: 1;
            background: var(--white);
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading h2 {
            font-family: 'DM Serif Display', serif;
            font-size: 28px;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .form-heading p {
            font-size: 14px;
            color: var(--ink-soft);
            font-weight: 300;
        }

        /* Alerts */
        .alert-minimal {
            border: none;
            border-radius: var(--radius);
            font-size: 13.5px;
            padding: 10px 14px;
            margin-bottom: 20px;
        }

        .alert-minimal.danger {
            background: #FDECEA;
            color: #B71C1C;
        }

        .alert-minimal.success {
            background: var(--sage-muted);
            color: var(--sage);
        }

        /* Input groups */
        .field-wrap {
            position: relative;
            margin-bottom: 14px;
        }

        .field-wrap .field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--sage);
            width: 18px;
            height: 18px;
            pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            background: var(--sage-muted);
            border: 1.5px solid transparent;
            border-radius: var(--radius);
            padding: 13px 14px 13px 42px;
            font-size: 14.5px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            transition: border-color .2s, background .2s;
            outline: none;
        }

        .field-wrap input::placeholder { color: var(--ink-soft); font-weight: 300; }

        .field-wrap input:focus {
            border-color: var(--sage);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(107,143,113,.12);
        }

        /* Password toggle */
        .field-wrap .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--ink-soft);
            padding: 0;
            line-height: 1;
        }

        /* "Remember me" row */
        .extras-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 6px 0 22px;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--ink-soft);
            cursor: pointer;
            user-select: none;
        }

        .toggle-switch input { display: none; }

        .toggle-track {
            width: 36px;
            height: 20px;
            background: var(--sage-light);
            border-radius: 20px;
            position: relative;
            transition: background .2s;
        }

        .toggle-track::after {
            content: '';
            width: 14px;
            height: 14px;
            background: white;
            border-radius: 50%;
            position: absolute;
            top: 3px;
            left: 3px;
            transition: left .2s;
            box-shadow: 0 1px 3px rgba(0,0,0,.2);
        }

        .toggle-switch input:checked ~ .toggle-track { background: var(--sage); }
        .toggle-switch input:checked ~ .toggle-track::after { left: 19px; }

        .forgot-link {
            font-size: 13px;
            color: var(--sage);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover { text-decoration: underline; }

        /* Primary button */
        .btn-primary-custom {
            width: 100%;
            padding: 14px;
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
        }

        .btn-primary-custom:hover { background: #5a7a60; }
        .btn-primary-custom:active { transform: scale(.98); }

        /* Divider */
        .divider-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0;
        }

        .divider-row span {
            font-size: 13px;
            color: var(--ink-soft);
            white-space: nowrap;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--sage-muted);
        }

        /* Register link */
        .register-row {
            text-align: center;
            font-size: 13.5px;
            color: var(--ink-soft);
        }

        .register-row a {
            color: var(--sage);
            font-weight: 600;
            text-decoration: none;
        }

        .register-row a:hover { text-decoration: underline; }

        /* ── Responsive collapse ── */
        @media (max-width: 680px) {
            .login-shell { flex-direction: column; border-radius: 16px; }
            .panel-left {
                flex: none;
                padding: 32px 28px;
                min-height: 160px;
            }
            .illo-wrap { display: none; }
            .panel-right { padding: 36px 28px; }
        }
    </style>
</head>
<body>

<div class="login-shell">

    <!-- ── Left panel ── -->
    <div class="panel-left">
        <div class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C8 2 4 5 4 9c0 3.5 2.5 6.5 6 7.7V20h4v-3.3c3.5-1.2 6-4.2 6-7.7 0-4-4-7-8-7z"/></svg>
            </div>
            <div class="brand-name">ClinicEase</div>
        </div>

        <!-- Minimal inline illustration inspired by ref 2 -->
        <div class="illo-wrap">
            <svg viewBox="0 0 220 280" xmlns="http://www.w3.org/2000/svg">
                <!-- Background card -->
                <rect x="30" y="30" width="160" height="220" rx="16" fill="rgba(255,255,255,.14)"/>
                <!-- Header bar -->
                <rect x="30" y="30" width="160" height="50" rx="16" fill="rgba(255,255,255,.22)"/>
                <circle cx="58" cy="55" r="10" fill="rgba(255,255,255,.35)"/>
                <rect x="78" y="48" width="70" height="8" rx="4" fill="rgba(255,255,255,.5)"/>
                <rect x="78" y="60" width="45" height="6" rx="3" fill="rgba(255,255,255,.28)"/>
                <!-- Form fields mockup -->
                <rect x="48" y="102" width="124" height="22" rx="7" fill="rgba(255,255,255,.18)"/>
                <circle cx="62" cy="113" r="5" fill="rgba(255,255,255,.35)"/>
                <rect x="48" y="134" width="124" height="22" rx="7" fill="rgba(255,255,255,.18)"/>
                <circle cx="62" cy="145" r="5" fill="rgba(255,255,255,.35)"/>
                <!-- Button -->
                <rect x="48" y="170" width="124" height="28" rx="9" fill="rgba(255,255,255,.30)"/>
                <rect x="82" y="179" width="56" height="9" rx="4" fill="rgba(255,255,255,.65)"/>
                <!-- Shield icon -->
                <g transform="translate(95,198)">
                    <path d="M15 3L3 7v6c0 5.25 5.1 10.2 12 12 6.9-1.8 12-6.75 12-12V7L15 3z" fill="rgba(255,255,255,.20)" stroke="rgba(255,255,255,.45)" stroke-width="1.5"/>
                    <path d="M11 14l-3-3 1.4-1.4L11 11.2l5.6-5.6L18 7l-7 7z" fill="rgba(255,255,255,.70)"/>
                </g>
                <!-- Dotted accent -->
                <circle cx="192" cy="50" r="5" fill="rgba(255,255,255,.18)"/>
                <circle cx="205" cy="65" r="3" fill="rgba(255,255,255,.12)"/>
                <circle cx="28" cy="220" r="7" fill="rgba(255,255,255,.10)"/>
            </svg>
        </div>

        <div class="panel-tagline">
            <strong>Mulai perjalanan sehat Anda</strong>
            Kelola kunjungan & rekam medis dengan mudah di satu tempat.
        </div>
    </div>

    <!-- ── Right panel ── -->
    <div class="panel-right">
        <div class="form-heading">
            <h2>Masuk</h2>
            <p>Silakan masuk untuk melanjutkan.</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert-minimal danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert-minimal success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('auth/proses_login'); ?>" method="POST">

            <!-- Username -->
            <div class="field-wrap">
                <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <!-- Password -->
            <div class="field-wrap">
                <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input type="password" name="password" id="pwInput" placeholder="Password" required>
                <button type="button" class="toggle-pw" onclick="togglePw()" aria-label="Tampilkan password">
                    <svg id="eyeIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>

            <!-- Remember me + forgot -->
            <div class="extras-row">
                <label class="toggle-switch">
                    <input type="checkbox" name="remember">
                    <span class="toggle-track"></span>
                    Ingat saya
                </label>
                <a href="#" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn-primary-custom">Masuk</button>
        </form>

        <div class="divider-row">
            <div class="divider-line"></div>
            <span>Belum memiliki akun?</span>
            <div class="divider-line"></div>
        </div>

        <div class="register-row">
            <a href="<?= base_url('auth/registrasi'); ?>">Daftar sebagai Pasien Baru →</a>
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