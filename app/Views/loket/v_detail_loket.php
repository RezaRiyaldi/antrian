<?= $this->extend('master'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card text-center bg-secondary text-white">
            <div class="card-header">
                <h5 class="my-auto">Antrian Saat Ini</h5>
            </div>

            <div class="card-body d-flex justify-content-center flex-column">
                <?php if ($antrianNow != NULL) : ?>
                    <h1 class="m-auto" style="font-size: 64px">
                        <?= $antrianNow->kode_antrian ?>
                    </h1>
                    <?php if (session()->logged_in) : ?>
                        <a href="<?= base_url() ?>/antrian/selesai/<?= $antrianNow->id_antrian ?>" class="btn btn-warning mt-3 mx-auto px-5">Selesai</a>
                    <?php endif ?>
                <?php else : ?>
                    <h1 class="m-auto" style="font-size: 64px">
                        -
                    </h1>
                <?php endif ?>
            </div>

            <div class="card-footer">
                <h4 class="m-auto"><?= $loket['nama_loket'] ?></h4>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card bg-secondary">
            <div class="card-body">
                <table class="table table-dark my-auto">
                    <thead>
                        <tr class="text-center text-uppercase">
                            <th>No Antrian</th>
                            <th>Status</th>
                            <?php if (session()->logged_in) : ?>
                                <th>Aksi</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if ($antrian != NULL) :
                            foreach ($antrian as $key => $value) :
                                if ($value['status'] != 1) :
                        ?>
                                    <tr class="text-center">
                                        <td class="align-middle"><?= $value['kode_antrian'] ?></td>
                                        <?php
                                        $status = '';
                                        $bg = '';
                                        if ($value['status'] == 0) {
                                            $status = 'Menunggu';
                                            $bg = 'warning';
                                        } else if ($value['status'] == 1) {
                                            $status = 'Proses';
                                            $bg = 'success';
                                        } else if ($value['status'] == 2) {
                                            $status = 'Selesai';
                                            $bg = 'primary';
                                        }
                                        ?>
                                        <td class="align-middle"><span class="badge bg-<?= $bg ?> text-uppercase"><?= $status ?></span></td>
                                        <?php if (session()->logged_in) : ?>
                                            <td class="align-middle">
                                                <?php if ($status == 'Menunggu' && $antrianNow == NULL) : ?>
                                                    <a href="<?= base_url() ?>/antrian/panggil/<?= $value['id_antrian'] ?>" class="btn btn-success btn-sm">Panggil</a>
                                                <?php else : ?>
                                                    -
                                                <?php endif ?>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endif ?>

                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Masih Kosong</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>;