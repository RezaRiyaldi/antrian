<?php

use Config\Services;

$request = Services::request();


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <style>
        .container.pt-3 ul {
            margin: 0 !important;
        }
    </style>

    <title>Ngatree | <?= $title ?></title>
</head>

<body class="bg-dark">
    <div class="bg-warning d-flex justify-content-center">
        <?php
        $hari = '';
        $bulan = '';

        if (date('l') == 'Wednesday') {
            $hari = 'Rabu';
        } else if (date('l') == 'Thursday') {
            $hari = 'Kamis';
        } else if (date('l') == 'Friday') {
            $hari = 'Jum\'at';
        } else if (date('l') == 'Saturday') {
            $hari = 'Sabtu';
        } else if (date('l') == 'Sunday') {
            $hari = 'Minggu';
        } else if (date('l') == 'Monday') {
            $hari = 'Senin';
        } else if (date('l') == 'Tuesday') {
            $hari = 'Selasa';
        }

        if (date('F') == 'July') {
            $bulan = 'Juli';
        } else if (date('F') == 'August') {
            $bulan = 'Agustus';
        } else if (date('F') == 'September') {
            $bulan = 'September';
        } else if (date('F') == 'October') {
            $bulan = 'Oktober';
        } else if (date('F') == 'November') {
            $bulan = 'November';
        } else if (date('F') == 'December') {
            $bulan = 'Desember';
        } else if (date('F') == 'January') {
            $bulan = 'Januari';
        } else if (date('F') == 'February') {
            $bulan = 'Februari';
        } else if (date('F') == 'March') {
            $bulan = 'Maret';
        } else if (date('F') == 'April') {
            $bulan = 'April';
        } else if (date('F') == 'May') {
            $bulan = 'Mei';
        } else if (date('F') == 'June') {
            $bulan = 'Juni';
        }

        ?>
        <p class="my-auto"><?= $hari . ", " . date('d') . " " . $bulan . " " . date('Y') ?> </p>
        <span class="mx-2">&dash;</span>
        <p id="jam" class="my-auto"></p>
        <p id="menit" class="my-auto"></p>
        <p id="detik" class="my-auto"></p>
        <p id="ampm" class="my-auto"></p>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: orangered">
        <div class="container">
            <a class="navbar-brand d-flex" href="<?= base_url() ?>" style="height: 40px;">
                <img src="<?= base_url() ?>/brand.png" alt="" class="my-auto" height="90%">
                <span class="fw-bold d-block">Ngantree</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $request->uri->getSegment(1)  == "" ? 'active' : '' ?>" aria-current="page" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $request->uri->getSegment(1) == "pelayanan" ? 'active' : '' ?>" href="<?= base_url() ?>/pelayanan">Pelayanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $request->uri->getSegment(1) == "loket" ? 'active' : '' ?>" href="<?= base_url() ?>/loket">Loket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $request->uri->getSegment(1) == "antrian" ? 'active' : '' ?>" href="<?= base_url() ?>/antrian">Antrian</a>
                    </li>

                    <?php if (!session()->logged_in) : ?>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>/admin/login" class="btn btn-outline-light">Login</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= session()->username ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="<?= base_url() ?>/admin/logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="container">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php } ?>
        <!-- </div> -->

        <?= $this->renderSection('content') ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        window.setTimeout("waktu()", 1000);

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);

            var jam = waktu.getHours();
            var menit = waktu.getMinutes();
            var detik = waktu.getSeconds();

            if (jam.toString().length == 1) {
                jam = '0' + jam
            }
            if (menit.toString().length == 1) {
                menit = '0' + menit
            }
            if (detik.toString().length == 1) {
                detik = '0' + detik
            }
            document.getElementById("jam").innerHTML = jam + ': ';
            document.getElementById("menit").innerHTML = menit + ': ';
            document.getElementById("detik").innerHTML = detik;
        }
    </script>
</body>

</html>