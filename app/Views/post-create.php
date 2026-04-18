<!DOCTYPE html>
<html lang="en">
    <head>
        <!--required meta tag-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- bootstrap css -->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
         <title>Tambah Data - Muhammad Haidar</title>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($Validation)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $validation->listerrors()?>
                        </div>
                        <?php } ?>
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo base_url('post/store')?>" method="post">
                                    <div class="form-group">
                                        <label>TITLE</label>
                                        <INput type="text" class="form-control" name="title" placeholder="Masukkan Title">
                                        </div>
                                        <div class="form-group">
                                            <label>KONTEN</label>
                                            <textarea class="form-control" name="content" rows="4" placeholder="Masukkan Konten"></textarea>
                                        </div>
                                        <button type="submit class="btn btn-primary">SIMPAN</button>
                                        </form>
                    </div>
                            </div>
                        </div>
                </div>
            </div>
            <!--optional java script-->
            <!--jQuery first, then popper.js, then bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </body>
</html>

