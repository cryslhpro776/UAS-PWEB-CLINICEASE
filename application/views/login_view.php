<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ClinicEase - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #f4f7f6; 
            height: 100vh; 
            display: flex; 
            align-items: center; 
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h3 class="text-center text-primary mb-4">ClinicEase Login</h3>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger text-center py-2 small"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success text-center py-2 small"><?= $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/proses_login'); ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Masuk</button>
                    </form>

                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-muted small mb-1">Belum memiliki akun?</p>
                        <a href="<?= base_url('auth/registrasi'); ?>" class="btn btn-outline-success btn-sm w-100">
                            Daftar Akun Pasien Baru
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>