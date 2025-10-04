<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Add New User
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Add New Pengguna (User)</h1>
    <div class="content-box">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="/admin/users/create" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" value="<?= old('username') ?>" required>
                <?php if ($validation->hasError('username')): ?><div class="error-message"><?= $validation->getError('username') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?= old('email') ?>" required>
                 <?php if ($validation->hasError('email')): ?><div class="error-message"><?= $validation->getError('email') ?></div><?php endif; ?>
            </div>
             <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                 <?php if ($validation->hasError('password')): ?><div class="error-message"><?= $validation->getError('password') ?></div><?php endif; ?>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role">
                    <option value="Public">Public</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create User</button>
        </form>
    </div>
<?= $this->endSection() ?>