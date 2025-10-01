<?= $this->extend('admin/layout') ?>

<?= $this->section('title') ?>
    Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <h1>Admin Dashboard</h1>
    <div class="content-box">
        <p>Welcome, <?= esc(session()->get('username')) ?>!</p>
        <p>This is the central management area for your application.</p>
        
        <h3>Data Summary:</h3>
        <ul>
            <li>Total Pengguna (Users): <?= $totalUsers ?></li>
            <li>Total Anggota (DPR Members): <?= $totalAnggota ?></li>
        </ul>
    </div>
<?= $this->endSection() ?>