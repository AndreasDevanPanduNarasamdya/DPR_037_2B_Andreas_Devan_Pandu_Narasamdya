<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $allowedFields    = ['nama_depan', 'nama_belakang', 'gelar_depan', 'gelar_belakang', 'jabatan', 'status_pernikahan'];

    /**
     * This function gets all members and joins their respective salary components.
     */
    public function getAnggotaWithGaji()
    {
        // We use the Query Builder to create a complex query
        return $this->db->table('anggota')
            ->select('anggota.id_anggota, anggota.nama_depan, anggota.nama_belakang, anggota.jabatan, komponen_gaji.nama_komponen, komponen_gaji.nominal, komponen_gaji.satuan')
            ->join('penggajian', 'penggajian.id_anggota = anggota.id_anggota')
            ->join('komponen_gaji', 'komponen_gaji.id_komponen = penggajian.id_komponen')
            ->orderBy('anggota.id_anggota', 'ASC') // Order by member
            ->get()
            ->getResultArray(); // Return the results as an array
    }
}