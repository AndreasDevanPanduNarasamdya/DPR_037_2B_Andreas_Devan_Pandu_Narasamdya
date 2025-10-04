<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Add New Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Add New Anggota DPR</h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="/admin/anggota/create" method="POST">
            <div class="form-group">
                <label for="nama_depan">First Name</label>
                <input type="text" name="nama_depan" value="<?= old('nama_depan') ?>" required>
                <?php if ($validation->hasError('nama_depan')): ?><div class="error-message"><?= $validation->getError('nama_depan') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="nama_belakang">Last Name</label>
                <input type="text" name="nama_belakang" value="<?= old('nama_belakang') ?>">
                <?php if ($validation->hasError('nama_belakang')): ?><div class="error-message"><?= $validation->getError('nama_belakang') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="gelar_depan">Gelar Depan (Title Before Name)</label>
                <input type="text" name="gelar_depan" value="<?= old('gelar_depan') ?>">
            </div>
            <div class="form-group">
                <label for="gelar_belakang">Gelar Belakang (Title After Name)</label>
                <input type="text" name="gelar_belakang" value="<?= old('gelar_belakang') ?>">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan (Position)</label>
                <select name="jabatan">
                    <option value="Ketua">Ketua</option>
                    <option value="Wakil Ketua">Wakil Ketua</option>
                    <option value="Anggota" selected>Anggota</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_pernikahan">Status Pernikahan</label>
                <select name="status_pernikahan">
                    <option value="Kawin">Kawin</option>
                    <option value="Belum Kawin">Belum Kawin</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Anggota</button>
        </form>
    </div>
<?= $this->endSection() ?>