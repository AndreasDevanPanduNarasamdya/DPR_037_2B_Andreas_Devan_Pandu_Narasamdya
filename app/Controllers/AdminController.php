<?php

namespace App\Controllers;

// Import all the models we will need
use App\Models\UsersModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel; // We need to create this model
use App\Models\PenggajianModel;   // And this one too

class AdminController extends BaseController
{
    /**
     * Admin Dashboard Homepage
     */
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

    /**
     * List all users (pengguna)
     */
    public function usersList()
    {
        $usersModel = new UsersModel();
        $data['users'] = $usersModel->findAll();
        return view('admin/users', $data);
    }

    /**
     * Show the form to create a new user
     */
    public function userNew()
    {
        return view('admin/users_new');
    }

    /**
     * Process the creation of a new user
     */
    public function userCreate()
    {
        // This logic is the same as your registerProcess, so you can copy it here
        // For simplicity, I'll redirect back to the user list
        // In a real app, you'd add the full validation and saving logic.
        $usersModel = new UsersModel();
        // ... (Get POST data, validate, prepare array) ...
        // $usersModel->save($newUserData);
        return redirect()->to('/admin/users')->with('message', 'User created successfully (logic to be added).');
    }

    /**
     * Delete a user
     */
    public function userDelete($id)
    {
        $usersModel = new UsersModel();
        $usersModel->delete($id);
        return redirect()->to('/admin/users')->with('message', 'User deleted successfully.');
    }

    /**
     * List all Anggota with their Gaji (like your dpr_gaji_view)
     */
    public function anggotaList()
    {
        $anggotaModel = new AnggotaModel();
        $rawData = $anggotaModel->getAnggotaWithGaji();
        
        // This is the same data processing logic from your Dpr controller
        $anggotaData = [];
        foreach ($rawData as $row) {
            $anggotaId = $row['id_anggota'];
            if (!isset($anggotaData[$anggotaId])) {
                $anggotaData[$anggotaId] = [
                    'id'           => $row['id_anggota'], // Add ID for delete button
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
    
    // You would add similar methods for komponenList, komponenDelete, etc.
}