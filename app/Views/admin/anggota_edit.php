<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Edit Anggota
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Edit Anggota: <?= esc($anggota['nama_depan']) ?></h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="/admin/anggota/update/<?= esc($anggota['id_anggota']) ?>" method="POST">
            <div class="form-group">
                <label for="nama_depan">First Name</label>
                <input type="text" name="nama_depan" value="<?= esc($anggota['nama_depan']) ?>" required>
                <?php if ($validation->hasError('nama_depan')): ?><div class="error-message"><?= $validation->getError('nama_depan') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="nama_belakang">Last Name</label>
                <input type="text" name="nama_belakang" value="<?= esc($anggota['nama_belakang']) ?>">
                <?php if ($validation->hasError('nama_belakang')): ?><div class="error-message"><?= $validation->getError('nama_belakang') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan (Position)</label>
                <select name="jabatan">
                    <option value="Ketua" <?= ($anggota['jabatan'] === 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                    <option value="Wakil Ketua" <?= ($anggota['jabatan'] === 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                    <option value="Anggota" <?= ($anggota['jabatan'] === 'Anggota') ? 'selected' : '' ?>>Anggota</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_pernikahan">Status Pernikahan</label>
                <select name="status_pernikahan">
                    <option value="Kawin" <?= ($anggota['status_pernikahan'] === 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                    <option value="Belum Kawin" <?= ($anggota['status_pernikahan'] === 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                    <option value="Cerai Hidup" <?= ($anggota['status_pernikahan'] === 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
                    <option value="Cerai Mati" <?= ($anggota['status_pernikahan'] === 'Cerai Mati') ? 'selected' : '' ?>>Cerai Mati</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Anggota</button>
        </form>
    </div>
<?= $this->endSection() ?>