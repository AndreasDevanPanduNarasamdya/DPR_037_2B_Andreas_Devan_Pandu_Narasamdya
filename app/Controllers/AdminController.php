<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel; // Now this file exists
use App\Models\PenggajianModel;   // And so does this one

class AdminController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $anggotaModel = new AnggotaModel();

        $data = [
            'totalUsers' => $usersModel->countAllResults(),
            'totalAnggota' => $anggotaModel->countAllResults(),
        ];
        return view('admin/dashboard', $data);
    }

    public function usersList()
    {
        $usersModel = new UsersModel();
        $data['users'] = $usersModel->findAll();
        return view('admin/users', $data);
    }

    public function userNew()
    {
        return view('admin/users_new');
    }

    public function userCreate()
    {
        // For now, just a placeholder. You can copy the logic from registerProcess later.
        return redirect()->to('/admin/users')->with('message', 'User creation logic needs to be implemented.');
    }

    public function userDelete($id)
    {
        $usersModel = new UsersModel();
        $usersModel->delete($id);
        return redirect()->to('/admin/users')->with('message', 'User deleted successfully.');
    }

    public function anggotaList()
    {
        $anggotaModel = new AnggotaModel();
        $rawData = $anggotaModel->getAnggotaWithGaji();
        
        $anggotaData = [];
        foreach ($rawData as $row) {
            $anggotaId = $row['id_anggota'];
            if (!isset($anggotaData[$anggotaId])) {
                $anggotaData[$anggotaId] = [
                    'id'           => $row['id_anggota'],
                    'nama_lengkap' => $row['nama_depan'] . ' ' . $row['nama_belakang'],
                    'jabatan'      => $row['jabatan'],
                    'gaji_components' => []
                ];
            }
            $anggotaData[$anggotaId]['gaji_components'][] = $row;
        }

        return view('admin/anggota', ['anggotaData' => $anggotaData]);
    }

    public function anggotaDelete($id)
    {
        $anggotaModel = new AnggotaModel();
        $anggotaModel->delete($id);
        return redirect()->to('/admin/anggota')->with('message', 'Anggota deleted successfully.');
    }
}