<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h2 class="mb-0 text-primary">Manajemen Artikel</h2>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="<?= base_url('/artikel/create') ?>" class="btn btn-success">
            + Tulis Artikel Baru
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($artikel)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada artikel. Ayo tulis artikel pertamamu!</td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach ($artikel as $row) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($row['cover_image']) && file_exists(FCPATH . 'uploads/' . $row['cover_image'])) : ?>
                                    <img src="<?= base_url('uploads/' . $row['cover_image']) ?>" alt="<?= $row['judul'] ?>" class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                <?php else : ?>
                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center img-thumbnail" style="width: 80px; height: 60px; font-size: 10px;">
                                        No Image
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= esc($row['judul']) ?></strong><br>
                                <small class="text-muted"><?= base_url('artikel/baca/' . $row['slug']) ?></small>
                            </td>
                            <td>
                                <?php if ($row['status'] == 'published'): ?>
                                    <span class="badge bg-success">Published</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('artikel/baca/' . $row['slug']) ?>" class="btn btn-sm btn-info text-white mb-1" target="_blank" title="Lihat Artikel">View</a>
                                <a href="<?= base_url('artikel/edit/' . $row['id']) ?>" class="btn btn-sm btn-primary mb-1">Edit</a>
                                <a href="<?= base_url('artikel/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus artikel ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <?= $pager->links('artikel', 'default_full') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>