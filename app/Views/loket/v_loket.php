<?= $this->extend('master') ?>

<?= $this->section('content') ?>

<div class="card mt-4 bg-secondary text-white">
    <div class="card-body d-flex justify-content-between">
        <h2 class="my-3">Pilih Loket</h2>
        <?php if (session()->logged_in) : ?>
            <a href="<?= base_url() ?>/loket/tambah" class="btn btn-outline-light my-auto">+ Loket</a>
        <?php endif ?>
    </div>
</div>

<div class="row mt-3 text-white">
    <?php if (!session()->logged_in) : ?>
        <?php
        $no = 1;
        if ($loket) :
            foreach ($loket as $row) :
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
                    <button class="btn <?= $button ?> w-100 p-3">
                        <h4 class="my-auto"><?= $row['nama_loket'] ?></h4>
                    </button>
                </div>
            <?php endforeach;
        else : ?>
            <div class="mb-3">
                <div class="bg-danger p-5 rounded">
                    <h1 class="display-4">Loket Belum Tersedia</h1>
                    <hr>
                    <p>Mohon maaf untuk saat ini loket belum tersedia, harap hubungi pihak terkait, Terima Kasih</p>
                </div>
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
                                    <th>Nama loket</th>
                                    <th>Melayani</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($loket as $row) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_loket'] ?></td>
                                        <td><?= $row['nama_pelayanan'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>/loket/ubah/<?= $row['id_loket'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url() ?>/loket/hapus/<?= $row['id_loket'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $row['nama_loket'] ?>?')">Delete</a>
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