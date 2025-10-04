<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $this->renderSection('title') ?> - Admin Panel</title>
    <style>
        body { font-family: sans-serif; margin: 0; background-color: #f4f6f9; color: #444; }
        .sidebar { position: fixed; width: 250px; height: 100vh; background-color: #343a40; color: #fff; top: 0; left: 0; }
        .sidebar h2 { text-align: center; padding: 20px 0; margin: 0; background-color: #454d55; }
        .sidebar ul { list-style: none; padding: 0; margin: 20px 0; }
        .sidebar ul li a { display: block; padding: 15px 20px; color: #c2c7d0; text-decoration: none; transition: background-color 0.2s; }
        .sidebar ul li a:hover { background-color: #494e53; color: #fff; }
        .main-content { margin-left: 250px; padding: 30px; }
        .main-content h1 { border-bottom: 1px solid #ddd; padding-bottom: 15px; }
        .content-box { background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #eee; }
        .btn { padding: 8px 12px; text-decoration: none; color: #fff; border-radius: 4px; font-size: 14px; display: inline-block; margin: 2px; }
        .btn-primary { background-color: #007bff; }
        .btn-danger { background-color: #dc3545; }
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .error-message { color: #dc3545; font-size: 12px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/users">Manage Pengguna</a></li>
            <li><a href="/admin/anggota">Manage Anggota</a></li>
            <li><a href="/admin/komponen">Manage Komponen Gaji</a></li>
            <li><a href="/logout">Log Out</a></li>
        </ul>
    </div>
    <div class="main-content">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>