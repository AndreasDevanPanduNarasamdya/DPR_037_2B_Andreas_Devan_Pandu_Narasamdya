<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Gaji Anggota DPR</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .anggota-card { border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .anggota-header { background-color: #f7f7f7; padding: 15px; border-bottom: 1px solid #ccc; }
        .anggota-header h2 { margin: 0; }
        .anggota-header span { color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 15px; border-bottom: 1px solid #eee; }
        th { background-color: #f2f2f2; }
        td.nominal { text-align: right; font-family: monospace; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Data Gaji Anggota DPR</h1>

    <?php foreach ($anggotaData as $anggota): ?>
        <div class="anggota-card">
            <div class="anggota-header">
                <h2><?= esc($anggota['nama_lengkap']) ?></h2>
                <span>Jabatan: <?= esc($anggota['jabatan']) ?></span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Komponen Gaji</th>
                        <th>Satuan</th>
                        <th style="text-align: right;">Nominal (IDR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $totalPerBulan = 0;
                        foreach ($anggota['gaji_components'] as $komponen):
                            if ($komponen['satuan'] === 'Bulan') {
                                $totalPerBulan += $komponen['nominal'];
                            }
                    ?>
                        <tr>
                            <td><?= esc($komponen['nama_komponen']) ?></td>
                            <td><?= esc($komponen['satuan']) ?></td>
                            <td class="nominal"><?= number_format($komponen['nominal'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="total">
                        <td colspan="2">Total Per Bulan</td>
                        <td class="nominal"><?= number_format($totalPerBulan, 2, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php endforeach; ?>

</body>
</html>