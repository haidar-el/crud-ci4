<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row w-100 justify-content-center mt-4">
    <div class="col-lg-8">
        <div class="card card-custom border-0 bg-white">
            
            <?php if (!empty($artikel['cover_image']) && file_exists(FCPATH . 'uploads/' . $artikel['cover_image'])): ?>
                <img src="<?= base_url('uploads/' . $artikel['cover_image']) ?>" class="card-img-top w-100" alt="<?= esc($artikel['judul']) ?>" style="height: 400px; object-fit: cover; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <?php endif; ?>

            <div class="card-body p-5">
                <nav aria-label="breadcrumb" class="mb-4">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('/artikel/index') ?>" class="text-decoration-none text-muted">Artikel</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= esc($artikel['judul']) ?></li>
                  </ol>
                </nav>

                <h1 class="display-5 fw-bold mb-3"><?= esc($artikel['judul']) ?></h1>
                
                <div class="d-flex align-items-center mb-4 text-muted border-bottom pb-3">
                    <span class="me-3"><i class="bi bi-calendar3"></i> <?= date('d M Y', strtotime($artikel['created_at'])) ?></span>
                    <?php if ($artikel['status'] == 'draft'): ?>
                        <span class="badge bg-warning text-dark"><i class="bi bi-eye-slash"></i> Draft</span>
                    <?php endif; ?>
                </div>

                <div class="content-body" style="font-size: 1.1rem; line-height: 1.8;">
                    <!-- Jangan di-esc agar format HTML Editor Render ke Browser -->
                    <?= $artikel['isi'] ?>
                </div>
                
                <div class="mt-5 text-center">
                    <a href="<?= base_url('/artikel/index') ?>" class="btn btn-outline-secondary rounded-pill px-4">
                        &laquo; Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
