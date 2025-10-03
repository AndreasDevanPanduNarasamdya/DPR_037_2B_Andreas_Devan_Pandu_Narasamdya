<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    protected $table            = 'penggajian';
    protected $primaryKey       = ['id_komponen', 'id_anggota'];
    protected $allowedFields    = ['id_komponen', 'id_anggota'];
}