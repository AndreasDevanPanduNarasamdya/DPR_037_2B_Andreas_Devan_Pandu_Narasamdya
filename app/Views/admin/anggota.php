<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Manage Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Manage Anggota DPR & Gaji</h1>
    
    <?php foreach ($anggotaData as $anggota): ?>
        <div class="content-box" style="margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px;">
                <div>
                    <h2 style="margin:0;"><?= esc($anggota['nama_lengkap']) ?></h2>
                    <span>Jabatan: <?= esc($anggota['jabatan']) ?></span>
                </div>
                <div>
                    <a href="/admin/anggota/delete/<?= esc($anggota['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?');">Delete Member</a>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Komponen Gaji</th>
                        <th>Nominal (IDR)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($anggota['gaji_components'] as $komponen): ?>
                    <tr>
                        <td><?= esc($komponen['nama_komponen']) ?></td>
                        <td><?= number_format($komponen['nominal'], 2, ',', '.') ?></td>
                        <td><a href="#" class="btn btn-danger" style="font-size:12px;">Remove</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?= $this->endSection() ?>