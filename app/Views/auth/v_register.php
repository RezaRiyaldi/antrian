<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        ul {
            margin: 0 !important;
        }
    </style>

    <title>Admin | <?= $title ?></title>
</head>

<body class="bg-dark">
    <div class="container pt-3">
        <!-- <div class="position-absolute m-0 bottom-0"> -->
        <?php
        if (session()->getFlashdata('error')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="container">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php
        } else if (session()->getFlashdata('success')) {
        ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <div class="container">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <!-- </div> -->


        <div class="row text-white">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card bg-secondary">
                    <form action="<?= base_url() ?>/register" method="post">
                        <div class="card-header text-center">
                            <h2 class="my-3">Daftar</h2>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control bg-dark text-white" placeholder="Masukan username" value="<?= old('username') ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control bg-dark text-white" placeholder="Masukan Nama Lengkap" value="<?= old('nama_lengkap') ?>">
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control bg-dark text-white" placeholder="Masukan password">
                                </div>
                                <div class="col mb-3">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" name="cpassword" class="form-control bg-dark text-white" placeholder="Masukan password">
                                </div>
                            </div>
                            <p class="mb-0">Sudah punya akun? <a href="<?= base_url() ?>/admin/login" class="text-warning">Login</a></p>
                        </div>
                        <div class="card-footer py-4">
                            <button type="submit" class="btn btn-primary d-block ms-auto px-5">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>