<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Edit User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Edit Pengguna: <?= esc($user['username']) ?></h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="/admin/users/update/<?= esc($user['id_pengguna']) ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?= esc($user['username']) ?>" required>
                <?php if ($validation->hasError('username')): ?><div class="error-message"><?= $validation->getError('username') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= esc($user['email']) ?>" required>
                 <?php if ($validation->hasError('email')): ?><div class="error-message"><?= $validation->getError('email') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role">
                    <option value="Public" <?= ($user['role'] === 'Public') ? 'selected' : '' ?>>Public</option>
                    <option value="Admin" <?= ($user['role'] === 'Admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">New Password (leave blank to keep current):</label>
                <input type="password" name="password">
                 <?php if ($validation->hasError('password')): ?><div class="error-message"><?= $validation->getError('password') ?></div><?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
<?= $this->endSection() ?>