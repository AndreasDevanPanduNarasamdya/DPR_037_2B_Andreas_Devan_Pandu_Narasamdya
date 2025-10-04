<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Manage Salary Components
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Manage Master Komponen Gaji</h1>
    <div class="content-box">
        <a href="/admin/komponen/new" class="btn btn-primary">Add New Component</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Komponen</th>
                    <th>Kategori</th>
                    <th>Jabatan</th>
                    <th>Nominal</th>
                    <th>Actions</th> </tr>
            </thead>
            <tbody>
                <?php foreach ($komponen_gaji as $komponen): ?>
                <tr>
                    <td><?= esc($komponen['id_komponen_gaji']) ?></td>
                    <td><?= esc($komponen['nama_komponen']) ?></td>
                    <td><?= esc($komponen['kategori']) ?></td>
                    <td><?= esc($komponen['jabatan']) ?></td>
                    <td><?= number_format($komponen['nominal'], 2, ',', '.') ?></td>
                    <td>
                        <a href="/admin/komponen/delete/<?= esc($komponen['id_komponen_gaji']) ?>" 
                           class="btn btn-danger" 
                           onclick="return confirm('Are you sure you want to delete this component?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>