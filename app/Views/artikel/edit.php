<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row w-100 justify-content-center">
    <div class="col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary mb-0">Edit Artikel</h2>
            <a href="<?= base_url('/artikel/index') ?>" class="btn btn-secondary btn-sm">Batal</a>
        </div>

        <div class="card card-custom">
            <div class="card-body p-4">
                
                <form action="<?= base_url('/artikel/update/' . $artikel['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= old('judul', $artikel['judul']) ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul') ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label fw-bold">Cover Image (Opsional, abaikan jika tidak ingin ganti)</label>
                        <input class="form-control <?= ($validation->hasError('cover_image')) ? 'is-invalid' : ''; ?>" type="file" id="cover_image" name="cover_image" onchange="previewImg()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('cover_image') ?>
                        </div>
                        
                        <?php if (!empty($artikel['cover_image']) && file_exists(FCPATH . 'uploads/' . $artikel['cover_image'])): ?>
                            <img src="<?= base_url('uploads/' . $artikel['cover_image']) ?>" class="img-preview img-fluid mt-3 rounded" style="max-height: 200px; display: block;">
                        <?php else: ?>
                            <img src="" class="img-preview img-fluid mt-3 rounded" style="max-height: 200px; display: none;">
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label for="isi" class="form-label fw-bold">Isi Artikel <span class="text-danger">*</span></label>
                        <?php if ($validation->hasError('isi')): ?>
                            <div class="text-danger small mb-1"><?= $validation->getError('isi') ?></div>
                        <?php endif; ?>
                        <textarea class="form-control summernote" id="isi" name="isi"><?= old('isi', $artikel['isi']) ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold">Status Artikel</label>
                        <select class="form-select" id="status" name="status">
                            <option value="published" <?= old('status', $artikel['status']) == 'published' ? 'selected' : '' ?>>Published (Bisa dilihat publik)</option>
                            <option value="draft" <?= old('status', $artikel['status']) == 'draft' ? 'selected' : '' ?>>Draft (Simpan sementara)</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Update Artikel</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function previewImg() {
        const cover = document.querySelector('#cover_image');
        const imgPreview = document.querySelector('.img-preview');

        if (cover.files && cover.files[0]) {
            imgPreview.style.display = 'block';
            const fileReader = new FileReader();
            fileReader.readAsDataURL(cover.files[0]);

            fileReader.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    }
</script>
<?= $this->endSection() ?>
