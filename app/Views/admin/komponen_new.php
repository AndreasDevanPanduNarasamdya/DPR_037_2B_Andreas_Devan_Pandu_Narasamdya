<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Add New Salary Component
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Add New Komponen Gaji</h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>

        <form action="/admin/komponen/create" method="POST" style="max-width: 600px;">
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nama_komponen">Nama Komponen</label>
                <input type="text" name="nama_komponen" value="<?= old('nama_komponen') ?>" required style="width: 100%; padding: 8px;">
                <?php if ($validation->hasError('nama_komponen')): ?>
                    <div class="error-message" style="color: red; font-size: 12px;"><?= $validation->getError('nama_komponen') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="kategori">Kategori</label>
                <select name="kategori" style="width: 100%; padding: 8px;">
                    <option value="Gaji Pokok">Gaji Pokok</option>
                    <option value="Tunjangan Melekat">Tunjangan Melekat</option>
                    <option value="Tunjangan Lain">Tunjangan Lain</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="jabatan">Berlaku Untuk Jabatan</label>
                <select name="jabatan" style="width: 100%; padding: 8px;">
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Anggota">Anggota</option>
                    <option value="Semua">Semua</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nominal">Nominal (IDR)</label>
                <input type="number" step="0.01" name="nominal" value="<?= old('nominal') ?>" required style="width: 100%; padding: 8px;">
                <?php if ($validation->hasError('nominal')): ?>
                    <div class="error-message" style="color: red; font-size: 12px;"><?= $validation->getError('nominal') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="satuan">Satuan</label>
                <select name="satuan" style="width: 100%; padding: 8px;">
                    <option value="Bulan">Bulan</option>
                    <option value="Hari">Hari</option>
                    <option value="Periode">Periode</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Component</button>
        </form>
    </div>
<?= $this->endSection() ?>