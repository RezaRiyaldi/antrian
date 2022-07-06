<?= $this->extend('master') ?>

<?= $this->section('content') ?>

<div class="card mt-4 bg-secondary text-white">
    <div class="card-body d-flex justify-content-between">
        <h2 class="my-3">Pilih Pelayanan</h2>
        <?php if (session()->logged_in) : ?>
            <a href="<?= base_url() ?>/pelayanan/tambah" class="btn btn-outline-light my-auto">+ Pelayanan</a>
        <?php endif ?>
    </div>
</div>


<div class="row mt-3 text-white">
    <?php if (!session()->logged_in) : ?>
        <?php if (!isset(session()->no_antrian)) : ?>
            <?php
            $no = 1;
            if ($pelayanan) :
                foreach ($pelayanan as $services) :
                    $button = "btn-primary";

                    if ($no % 5 == 0) {
                        $button = "btn-light";
                    } else if ($no % 4 == 0) {
                        $button = "btn-warning";
                    } else if ($no % 3 == 0) {
                        $button = "btn-info";
                    } else if ($no % 2 == 0) {
                        $button = "btn-danger";
                    }

                    $no++;
            ?>
                    <div class="col-xl-3 col-md-4 col-sm-6 col-12 mb-3">
                        <a href="<?= base_url() ?>/antrian/get/<?= $services['id_pelayanan'] ?>/<?= $services['id_loket'] ?>" class="btn <?= $button ?> w-100 p-3">
                            <h4 class="my-auto"><?= $services['nama_pelayanan'] ?></h4>
                        </a>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="mb-3">
                    <div class="bg-danger p-5 rounded">
                        <h1 class="display-4">Pelayanan Belum Tersedia</h1>
                        <hr>
                        <p>Mohon maaf untuk saat ini pelayanan belum tersedia, harap hubungi pihak terkait, Terima Kasih</p>
                    </div>
                </div>
            <?php endif ?>

        <?php else : ?>
            <div class="col-md-12">
                <div class="card bg-danger py-4">
                    <h4 class="text-center my-auto">Anda sudah mengambil antrian dengan no <span class="bg-warning text-dark p-2"><?= session()->no_antrian ?></span></h4>
                </div>
                <h5 class="alert alert-warning mt-2 text-center">Sesi anda sudah selesai? <a href="<?= base_url() ?>/antrian/selesai-danger/">Ambil antrian kembali</a></h5>
            </div>
        <?php endif ?>
    <?php else : ?>
        <div class="col-md-12">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-white table-hover" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pelayanan</th>
                                    <th>Nama Pelayanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pelayanan as $services) :
                                ?>
                                    <tr>
                                        <td class="align-middle"><?= $no++ ?></td>
                                        <td class="align-middle"><?= $services['kode_pelayanan'] ?></td>
                                        <td class="align-middle"><?= $services['nama_pelayanan'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>/pelayanan/ubah/<?= $services['id_pelayanan'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url() ?>/pelayanan/hapus/<?= $services['id_pelayanan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus layanan <?= $services['nama_pelayanan'] ?>?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>


<?= $this->endSection() ?>