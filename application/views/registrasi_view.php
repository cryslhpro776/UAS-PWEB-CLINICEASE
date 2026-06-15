<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ClinicEase - Registrasi Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow rounded-3">
                <div class="card-body p-4">
                    <h4 class="text-center text-primary mb-4">Pendaftaran Akun Pasien</h4>
                    <form action="<?= base_url('auth/proses_registrasi'); ?>" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_pasien" class="form-control" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="nomor_hp" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat Rumah</label>
                            <textarea name="alamat" class="form-control" rows="2" required></textarea>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Username Baru</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2">Daftar Sekarang</button>
                        <div class="text-center mt-3">
                            <a href="<?= base_url('auth'); ?>" class="small text-decoration-none">Sudah punya akun? Login di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>