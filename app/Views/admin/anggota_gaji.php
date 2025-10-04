<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Manage Gaji for <?= esc($anggota['nama_depan']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Manage Gaji for <?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?></h1>
    
    <div class="content-box">
        <h3>Assigned Components</h3>
        <table>
            <tbody>
            <?php if (empty($assigned_komponen)): ?>
                <tr><td>No components assigned yet.</td></tr>
            <?php else: ?>
                <?php foreach ($assigned_komponen as $komponen): ?>
                <tr>
                    <td><?= esc($komponen['nama_komponen']) ?></td>
                    <td>
                        <a href="/admin/anggota/gaji/remove/<?= esc($anggota['id_anggota']) ?>/<?= esc($komponen['id_komponen_gaji']) ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="content-box" style="margin-top: 20px;">
        <h3>Add New Component</h3>
        <form action="/admin/anggota/gaji/add/<?= esc($anggota['id_anggota']) ?>" method="POST">
            <div class="form-group">
                <label for="id_komponen_gaji">Available Components</label>
                <select name="id_komponen_gaji" style="width:100%; padding:10px;">
                    <?php foreach ($available_komponen as $komponen): ?>
                    <option value="<?= esc($komponen['id_komponen_gaji']) ?>"><?= esc($komponen['nama_komponen']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Component</button>
        </form>
    </div>
<?= $this->endSection() ?>