<?= $this->extend('master') ?>

<?= $this->section('content') ?>

<div class="row mt-5">
    <div class="col-xl-4 col-md-6 col-sm-8 col-10 mx-auto">
        <div class="card bg-secondary text-white">
            <form action="<?= base_url() ?>/ubah-loket/<?= $loket->id_loket ?>" method="post">
                <div class="card-header">
                    <h2 class="my-3 text-center">Ubah Pelayanan</h2>
                </div>

                <div class="card-body py-4">
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Loket</label>
                        <input type="text" class="form-control bg-dark text-white" maxlength="2" name="nama_loket" placeholder="Contoh: CS" value="<?= $loket->nama_loket ?>">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Melayani</label>
                        <select name="pelayanan_id" id="" class="form-select bg-dark text-secondary">
                            <option value="">- Pilih Pelayanan -</option>
                            <?php foreach ($pelayanan as $row) : ?>
                                <option value="<?= $row->id_pelayanan ?>" <?= $row->id_pelayanan == $loket->pelayanan_id ? 'selected' : '' ?>><?= $row->nama_pelayanan ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="card-footer p-3">
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection() ?>