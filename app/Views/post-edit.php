<!doctype html>
<html lang="en">
    <head>
        <?php
        /**
         * PENGATURAN HALAMAN
         * Mengatur karakter set dan viewport agar tampilan responsif di laptop Acer Aspire-mu.
         */
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <?php
        /**
         * IMPORT CSS EXTERNAL
         * Mengambil framework Bootstrap 4 dari internet untuk mendesain tampilan form agar rapi.
         */
        ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        
        <title>Edit Data - Muhammad Haidar</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    
                    <?php if(isset($validation)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $validation->listErrors() ?>
                        </div>
                    <?php } ?>

                    <div class="card">
                        <div class="card-body">
                            <?php
                            /**
                             * FORM EDIT DATA
                             * action: Mengirim data ke fungsi update() di Controller Post.
                             * method: Menggunakan POST untuk mengirim data secara aman.
                             */
                            ?>
                            <form action="<?php echo base_url('post/update/' . $post['id']) ?>" method="POST">
                                
                                <div class="form-group">
                                    <?php
                                    /**
                                     * INPUT JUDUL
                                     * Mengambil data 'title' asli dari database untuk ditampilkan kembali di kolom input.
                                     */
                                    ?>
                                    <label>JUDUL</label>
                                    <input type="text" class="form-control" name="title" value="<?php  echo $post['title'] ?>" placeholder="Masukkan Judul Post">
                                </div>

                                <div class="form-group">
                                    <?php
                                    /**
                                     * INPUT KONTEN
                                     * Mengambil data 'content' asli dari database dan menampilkannya di dalam textarea.
                                     */
                                    ?>
                                    <label>KONTEN</label>
                                    <textarea class="form-control" name="content" rows="4" placeholder="Masukkan Konten Post"><?php echo $post['content'] ?></textarea>
                                </div>

                                <?php
                                /**
                                 * TOMBOL AKSI
                                 * submit: Menjalankan proses pengiriman data ke Controller.
                                 * reset: Mengembalikan isi form ke data awal.
                                 */
                                ?>
                                <button type="submit" class="btn btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-warning">RESET</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        /**
         * JAVASCRIPT SUPPORT
         * Library tambahan agar fitur-fitur interaktif Bootstrap dapat berjalan dengan baik.
         */
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>