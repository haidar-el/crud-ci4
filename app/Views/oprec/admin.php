<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }
    .status-badge {
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 20px;
    }
    .table-custom-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .table-custom th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 15px;
    }
    .table-custom td {
        padding: 15px;
        vertical-align: middle;
    }
    .btn-action {
        border-radius: 6px;
        padding: 5px 10px;
        font-size: 0.85rem;
        margin: 2px;
        transition: all 0.2s;
    }
    .btn-action:hover {
        transform: translateY(-2px);
    }
</style>

<div class="container mt-4">
    <div class="admin-header">
        <div>
            <h2 class="fw-bold mb-0">Dashboard Admin Oprec</h2>
            <p class="text-muted mb-0">Kelola data pendaftar Open Recruitment</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-primary fs-6 p-2">Total: <?= count($pendaftar) ?> Pendaftar</span>
        </div>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-custom-wrapper mb-5">
        <div class="table-responsive">
            <table class="table table-hover table-custom mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Peserta</th>
                        <th width="15%">Kontak</th>
                        <th width="15%">Divisi</th>
                        <th width="15%">Status</th>
                        <th width="30%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftar)) : ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <em>Belum ada pendaftar.</em>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $i = 1; foreach ($pendaftar as $p) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td>
                                    <strong><?= esc($p['nama']) ?></strong><br>
                                    <small class="text-muted"><?= esc($p['nim']) ?> - <?= esc($p['jurusan']) ?></small>
                                </td>
                                <td>
                                    <?= esc($p['no_hp']) ?><br>
                                    <small class="text-muted"><?= esc($p['email']) ?></small>
                                </td>
                                <td><span class="badge bg-info text-dark"><?= esc($p['divisi']) ?></span></td>
                                <td>
                                    <?php
                                        $statusClass = 'bg-secondary';
                                        if ($p['status'] == 'Lulus') $statusClass = 'bg-success';
                                        if ($p['status'] == 'Tidak Lulus') $statusClass = 'bg-danger';
                                    ?>
                                    <span class="badge <?= $statusClass ?> status-badge"><?= esc($p['status']) ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center flex-wrap gap-1">
                                        <!-- Tombol Download CV -->
                                        <a href="<?= base_url('/uploads/cv/' . $p['berkas_cv']) ?>" target="_blank" class="btn btn-sm btn-outline-primary btn-action" title="Lihat CV">
                                            CV
                                        </a>

                                        <!-- Form Ubah Status -->
                                        <form action="<?= base_url('/oprec/update_status/' . $p['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="Lulus">
                                            <button type="submit" class="btn btn-sm btn-success btn-action" <?= ($p['status'] == 'Lulus') ? 'disabled' : '' ?> title="Luluskan">
                                                Lulus
                                            </button>
                                        </form>

                                        <form action="<?= base_url('/oprec/update_status/' . $p['id']) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="status" value="Tidak Lulus">
                                            <button type="submit" class="btn btn-sm btn-warning btn-action text-dark" <?= ($p['status'] == 'Tidak Lulus') ? 'disabled' : '' ?> title="Tolak">
                                                Tolak
                                            </button>
                                        </form>

                                        <!-- Form Hapus -->
                                        <form action="<?= base_url('/oprec/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peserta ini?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger btn-action" title="Hapus Data">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
