<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Dpr extends BaseController
{
    public function index()
    {
        // 1. Create an instance of our new model
        $anggotaModel = new AnggotaModel();
        
        // 2. Get the raw data from the model (with joins)
        $rawData = $anggotaModel->getAnggotaWithGaji();
        
        // 3. Process the raw data into a structured array
        $anggotaData = [];
        foreach ($rawData as $row) {
            $anggotaId = $row['id_anggota'];
            
            // If we haven't seen this member before, create their entry
            if (!isset($anggotaData[$anggotaId])) {
                $anggotaData[$anggotaId] = [
                    'nama_lengkap' => $row['nama_depan'] . ' ' . $row['nama_belakang'],
                    'jabatan'      => $row['jabatan'],
                    'gaji_components' => []
                ];
            }
            
            // Add the current salary component to this member's list
            $anggotaData[$anggotaId]['gaji_components'][] = [
                'nama_komponen' => $row['nama_komponen'],
                'nominal'       => $row['nominal'],
                'satuan'        => $row['satuan']
            ];
        }

        // 4. Pass the final, structured data to the view
        return view('dpr_gaji_view', ['anggotaData' => $anggotaData]);
    }
}