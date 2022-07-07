<?= $this->extend('master'); ?>

<?= $this->section('content'); ?>
<div class="card mt-4 bg-secondary text-white">
    <div class="card-body d-flex justify-content-between">
        <h2 class="my-3">Daftar Antrian Hari Ini</h2>
    </div>
</div>

<div class="row mt-4 text-white">
    <?php

    use Config\Database;

    foreach ($lokets as $loket) :
        $antrian = Database::connect()->table('antrian')
            ->where('loket_id', $loket['id_loket'])
            ->where('created_at', date('Y-m-d'))
            ->orderBy('status', 'asc')
            ->get()->getResultArray();
    ?>
        <div class="col-md-4 mb-3">
            <div class="card bg-transparent border-secondary">
                <ul class="list-group list-group-flush">
                    <?php
                    if ($antrian != NULL) :
                        foreach ($antrian as $key => $value) :

                    ?>
                            <li class="list-group-item bg-transparent border-secondary text-white d-flex justify-content-between">
                                <p class="my-auto"><?= $value['kode_antrian'] ?></p>
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
                                <p class="my-auto badge bg-<?= $bg ?> text-uppercase"><?= $status ?></p>
                                <?php
                                $antrianNow = Database::connect()->table('antrian')
                                    ->where('status', 1)
                                    ->where('loket_id', $value['loket_id'])
                                    ->where('pelayanan_id', $value['pelayanan_id'])
                                    ->where('created_at', date('Y-m-d'))
                                    ->get()->getFirstRow();

                                // dd($antrianNow);
                                ?>

                                <?php if (session()->logged_in) : ?>
                                    <?php if ($value['status'] == 0 && $antrianNow == NULL) : ?>
                                        <a href="<?= base_url() ?>/antrian/panggil/<?= $value['id_antrian'] ?>" class="btn btn-success btn-sm">Panggil</a>
                                    <?php elseif ($value['status'] == 1) : ?>
                                        <a href="<?= base_url() ?>/antrian/selesai/<?= $value['id_antrian'] ?>" class="btn btn-sm btn-primary">Selesai</a>
                                    <?php elseif ($value['status'] == 2) : ?>
                                        <div class="btn btn-sm btn-outline-info disabled" disabled>Done</div>
                                    <?php else : ?>
                                        <div class="btn btn-sm btn-secondary disabled" disabled>Wait</div>
                                    <?php endif ?>
                                <?php endif ?>


                            </li>
                        <?php endforeach;
                    else : ?>
                        <li class="list-group-item bg-transparent text-center border-secondary text-danger">
                            - Loket masih kosong -
                        </li>
                    <?php endif ?>
                </ul>
                <a href="<?= base_url() ?>/loket/detail/<?= $loket['id_loket'] ?>/<?= $loket['id_pelayanan'] ?>" class="card-footer bg-primary text-white text-decoration-none">
                    <h4 class="my-auto text-center"><?= $loket['nama_loket'] ?></h4>
                    <h6 class="my-auto text-center"><?= $loket['nama_pelayanan'] != NULL ? $loket['nama_pelayanan'] : '-' ?></h6>
                </a>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection(); // dd($antrian) 
?>