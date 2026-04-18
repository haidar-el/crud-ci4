<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<style>
    .oprec-container {
        max-width: 800px;
        margin: 0 auto;
        padding-top: 30px;
    }
    .card-oprec {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .card-oprec:hover {
        transform: translateY(-5px);
    }
    .card-header-custom {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 30px 20px;
        text-align: center;
        border-bottom: none;
    }
    .card-header-custom h3 {
        font-weight: 700;
        margin-bottom: 5px;
        letter-spacing: 1px;
    }
    .card-header-custom p {
        opacity: 0.9;
        margin-bottom: 0;
    }
    .card-body-custom {
        padding: 40px;
        background-color: #ffffff;
    }
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        transition: all 0.3s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .btn-submit {
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-top: 20px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        transition: all 0.3s;
    }
    .btn-submit:hover {
        background: linear-gradient(135deg, #0b5ed7 0%, #084298 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
    }
    .file-upload-wrapper {
        position: relative;
        margin-bottom: 15px;
    }
    .invalid-feedback {
        font-size: 0.875em;
    }
</style>

<div class="oprec-container">
    <div class="card card-oprec">
        <div class="card-header card-header-custom">
            <h3>Pendaftaran Anggota Baru</h3>
            <p>Bergabunglah bersama kami dan kembangkan potensimu!</p>
        </div>
        <div class="card-body card-body-custom">
            
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('/oprec/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama lengkap">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : '' ?>" id="nim" name="nim" value="<?= old('nim') ?>" placeholder="Masukkan NIM">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : '' ?>" id="jurusan" name="jurusan" value="<?= old('jurusan') ?>" placeholder="Contoh: Teknik Informatika">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jurusan') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="no_hp" class="form-label">Nomor WhatsApp</label>
                        <input type="text" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>" id="no_hp" name="no_hp" value="<?= old('no_hp') ?>" placeholder="Contoh: 081234567890">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label">Email Aktif</label>
                        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= old('email') ?>" placeholder="email@contoh.com">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email') ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label for="divisi" class="form-label">Pilihan Divisi</label>
                        <select class="form-select <?= ($validation->hasError('divisi')) ? 'is-invalid' : '' ?>" id="divisi" name="divisi">
                            <option value="">-- Pilih Divisi --</option>
                            <option value="Humas" <?= old('divisi') == 'Humas' ? 'selected' : '' ?>>Humas (Hubungan Masyarakat)</option>
                            <option value="Kreatif" <?= old('divisi') == 'Kreatif' ? 'selected' : '' ?>>Kreatif & Desain</option>
                            <option value="IT" <?= old('divisi') == 'IT' ? 'selected' : '' ?>>IT & Development</option>
                            <option value="Acara" <?= old('divisi') == 'Acara' ? 'selected' : '' ?>>Manajemen Acara</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('divisi') ?>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="alasan" class="form-label">Alasan Bergabung & Motivasi</label>
                    <textarea class="form-control <?= ($validation->hasError('alasan')) ? 'is-invalid' : '' ?>" id="alasan" name="alasan" rows="4" placeholder="Ceritakan motivasi dan alasan Anda ingin bergabung dengan kami..."><?= old('alasan') ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('alasan') ?>
                    </div>
                </div>

                <div class="mb-4 file-upload-wrapper">
                    <label for="berkas_cv" class="form-label">Upload CV / Portfolio (Wajib PDF, Max 2MB)</label>
                    <input class="form-control <?= ($validation->hasError('berkas_cv')) ? 'is-invalid' : '' ?>" type="file" id="berkas_cv" name="berkas_cv" accept=".pdf">
                    <div class="invalid-feedback">
                        <?= $validation->getError('berkas_cv') ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-submit btn-lg">Kirim Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
