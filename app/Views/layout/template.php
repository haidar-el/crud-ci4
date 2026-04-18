<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem Artikel' ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">MyBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('artikel*')) ? 'active' : '' ?>" href="<?= base_url('/artikel/index') ?>">Kelola Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('oprec') || url_is('oprec/success')) ? 'active' : '' ?>" href="<?= base_url('/oprec') ?>">Daftar Oprec</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (url_is('oprec/admin*')) ? 'active' : '' ?>" href="<?= base_url('/oprec/admin') ?>">Oprec Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container pb-5">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto w-100">
        <p class="mb-0">&copy; <?= date('Y') ?> MyBlog. All Rights Reserved.</p>
    </footer>

    <!-- jQuery (Dibutuhkan untuk Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 5 JS Bundle (termasuk Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Custom Script untuk Inisialisasi Summernote -->
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Tulis isi artikel di sini...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
</body>
</html>
