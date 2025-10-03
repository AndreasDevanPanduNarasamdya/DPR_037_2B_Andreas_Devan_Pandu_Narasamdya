<?php

namespace App\Models;

use CodeIgniter\Model;

class KomponenGajiModel extends Model
{
    protected $table            = 'komponen_gaji';
    protected $primaryKey       = 'id_komponen';
    protected $allowedFields    = ['nama_komponen', 'kategori', 'berlaku_untuk', 'nominal', 'satuan'];
}