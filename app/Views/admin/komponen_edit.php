<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Edit Salary Component
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Edit Komponen Gaji: <?= esc($komponen['nama_komponen']) ?></h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>

        <form action="/admin/komponen/update/<?= esc($komponen['id_komponen_gaji']) ?>" method="POST" style="max-width: 600px;">
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nama_komponen">Nama Komponen</label>
                <input type="text" name="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required style="width: 100%; padding: 8px;">
                <?php if ($validation->hasError('nama_komponen')): ?>
                    <div class="error-message"><?= $validation->getError('nama_komponen') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="kategori">Kategori</label>
                <select name="kategori" style="width: 100%; padding: 8px;">
                    <option value="Gaji Pokok" <?= ($komponen['kategori'] === 'Gaji Pokok') ? 'selected' : '' ?>>Gaji Pokok</option>
                    <option value="Tunjangan Melekat" <?= ($komponen['kategori'] === 'Tunjangan Melekat') ? 'selected' : '' ?>>Tunjangan Melekat</option>
                    <option value="Tunjangan Lain" <?= ($komponen['kategori'] === 'Tunjangan Lain') ? 'selected' : '' ?>>Tunjangan Lain</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="jabatan">Berlaku Untuk Jabatan</label>
                <select name="jabatan" style="width: 100%; padding: 8px;">
                    <option value="Ketua" <?= ($komponen['jabatan'] === 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                    <option value="Wakil Ketua" <?= ($komponen['jabatan'] === 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                    <option value="Anggota" <?= ($komponen['jabatan'] === 'Anggota') ? 'selected' : '' ?>>Anggota</option>
                    <option value="Semua" <?= ($komponen['jabatan'] === 'Semua') ? 'selected' : '' ?>>Semua</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nominal">Nominal (IDR)</label>
                <input type="number" step="0.01" name="nominal" value="<?= esc($komponen['nominal']) ?>" required style="width: 100%; padding: 8px;">
                <?php if ($validation->hasError('nominal')): ?>
                    <div class="error-message"><?= $validation->getError('nominal') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="satuan">Satuan</label>
                <select name="satuan" style="width: 100%; padding: 8px;">
                    <option value="Bulan" <?= ($komponen['satuan'] === 'Bulan') ? 'selected' : '' ?>>Bulan</option>
                    <option value="Hari" <?= ($komponen['satuan'] === 'Hari') ? 'selected' : '' ?>>Hari</option>
                    <option value="Periode" <?= ($komponen['satuan'] === 'Periode') ? 'selected' : '' ?>>Periode</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Component</button>
        </form>
    </div>
<?= $this->endSection() ?>