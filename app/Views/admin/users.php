<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Manage Users
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Manage Pengguna (Users)</h1>
    <div class="content-box">
        <a href="/admin/users/new" class="btn btn-primary">Add New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['id_pengguna']) ?></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td>
                        <a href="/admin/users/edit/<?= esc($user['id_pengguna']) ?>" class="btn btn-primary" style="background-color: #ffc107; border-color: #ffc107;">Edit</a>
                        <a href="/admin/users/delete/<?= esc($user['id_pengguna']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>