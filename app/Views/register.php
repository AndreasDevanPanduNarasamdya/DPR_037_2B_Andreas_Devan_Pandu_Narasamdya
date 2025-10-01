<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4; padding: 20px 0; }
        .register-container { padding: 40px; border: 1px solid #ccc; border-radius: 5px; background-color: #fff; width: 400px; }
        .form-group { margin-bottom: 20px; }
        .error-message { color: #dc3545; font-size: 12px; margin-top: 5px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"], input[type="email"] { 
            width: 100%; padding: 15px; font-size: 16px; border: 1px solid #ddd; border-radius: 5px;
            transition: all 0.3s ease; box-sizing: border-box;
        }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register As Public</h2>
        <?php $validation = \Config\Services::validation(); ?>
        
        <form action="/register/process" method="POST">
            <input type="hidden" name="role" value="Public">
            
            <div class="form-group">
                <label for="nama_depan">First Name:</label>
                <input type="text" id="nama_depan" name="nama_depan" value="<?= old('nama_depan') ?>" required>
                <?php if ($validation->hasError('nama_depan')): ?>
                    <div class="error-message"><?= $validation->getError('nama_depan') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="nama_belakang">Last Name (Optional):</label>
                <input type="text" id="nama_belakang" name="nama_belakang" value="<?= old('nama_belakang') ?>">
                <?php if ($validation->hasError('nama_belakang')): ?>
                    <div class="error-message"><?= $validation->getError('nama_belakang') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= old('username') ?>" required>
                <?php if ($validation->hasError('username')): ?>
                    <div class="error-message"><?= $validation->getError('username') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= old('email') ?>" required>
                <?php if ($validation->hasError('email')): ?>
                    <div class="error-message"><?= $validation->getError('email') ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required pattern=".{8,}" title="Your password must be at least 8 characters long.">
                <?php if ($validation->hasError('password')): ?>
                    <div class="error-message"><?= $validation->getError('password') ?></div>
                <?php endif; ?>
            </div>
            <p>
                <a href="/register/admin">Register As Admin</a>
            </p>
            <button type="submit">Register Account</button>
        </form>
    </div>
</body>
</html>