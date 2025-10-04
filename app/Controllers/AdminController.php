<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;

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
        $rules = [
            'username' => 'required|is_unique[pengguna.username]',
            'email'    => 'required|valid_email|is_unique[pengguna.email]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[Admin,Public]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToSave = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
        ];

        $usersModel = new UsersModel();
        $usersModel->save($dataToSave);

        return redirect()->to('/admin/users')->with('message', 'User created successfully.');
    }

    public function userEdit($id)
    {
        $usersModel = new UsersModel();
        $data['user'] = $usersModel->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user with ID: '. $id);
        }

        return view('admin/users_edit', $data);
    }

    public function userUpdate($id)
    {
        $rules = [
            'username' => "required|is_unique[pengguna.username,id_pengguna,{$id}]",
            'email'    => "required|valid_email|is_unique[pengguna.email,id_pengguna,{$id}]",
            'role'     => 'required|in_list[Admin,Public]'
        ];

        if ($this->request->getPost('password') !== '') {
            $rules['password'] = 'required|min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dataToSave = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('password') !== '') {
            $dataToSave['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        
        $usersModel = new UsersModel();
        $usersModel->update($id, $dataToSave);

        return redirect()->to('/admin/users')->with('message', 'User updated successfully.');
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

    public function anggotaNew()
    {
        return view('admin/anggota_new');
    }

    public function anggotaCreate()
    {
        $rules = [
            'nama_depan'    => 'required|max_length[100]',
            'nama_belakang' => 'max_length[100]',
            'gelar_depan'       => 'max_length[50]',
            'gelar_belakang'    => 'max_length[50]',
            'jabatan'       => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $anggotaModel = new AnggotaModel();
        $anggotaModel->save($this->request->getPost());

        return redirect()->to('/admin/anggota')->with('message', 'Anggota created successfully.');
    }

    public function anggotaEdit($id)
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id);

        if (!$data['anggota']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the Anggota with ID: '. $id);
        }

        return view('admin/anggota_edit', $data);
    }

    public function anggotaUpdate($id)
    {
        $rules = [
            'nama_depan'    => 'required|max_length[100]',
            'nama_belakang' => 'max_length[100]',
            'jabatan'       => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $anggotaModel = new AnggotaModel();
        $anggotaModel->update($id, $this->request->getPost());

        return redirect()->to('/admin/anggota')->with('message', 'Anggota updated successfully.');
    }

    public function komponenList()
    {
        $komponenModel = new KomponenGajiModel();
        $data['komponen_gaji'] = $komponenModel->findAll();
        return view('admin/komponen_list', $data);
    }

    public function komponenNew()
    {
        return view('admin/komponen_new');
    }

    public function komponenCreate()
    {
        log_message('error', '--- STARTING komponenCreate METHOD ---');

        $rules = [
            'nama_komponen' => 'required|max_length[100]',
            'kategori'      => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
            'jabatan'       => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal'       => 'required|decimal',
            'satuan'        => 'required|in_list[Bulan,Hari,Periode]'
        ];
        log_message('error', 'Validation rules have been defined.');

        if (!$this->validate($rules)) {
            log_message('error', 'VALIDATION FAILED. Errors: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        log_message('error', 'Validation PASSED.');

        $dataToSave = $this->request->getPost();
        log_message('error', 'Data received from form: ' . json_encode($dataToSave));

        $db = \Config\Database::connect();
        $komponenModel = new \App\Models\KomponenGajiModel();

        log_message('error', 'Starting database transaction...');
        $db->transStart();
        
        $saveResult = $komponenModel->save($dataToSave);
        log_message('error', 'Model save() method returned: ' . ($saveResult ? 'true' : 'false'));
        
        if (!$saveResult) {
            log_message('error', 'Model validation errors: ' . json_encode($komponenModel->errors()));
        }

        log_message('error', 'Completing transaction...');
        $db->transComplete();

        if ($db->transStatus() === false) {
            log_message('error', 'DATABASE TRANSACTION FAILED. Changes were rolled back.');
            return redirect()->back()->withInput()->with('error', 'Database transaction failed. Data was not saved.');
        }
        
        log_message('error', 'DATABASE TRANSACTION SUCCEEDED. Changes were committed.');
        log_message('error', '--- ENDING komponenCreate and redirecting ---');

        return redirect()->to('/admin/komponen')->with('message', 'Salary component creation processed.');
    }

    public function anggotaGaji($anggota_id)
    {
        $anggotaModel = new AnggotaModel();
        $penggajianModel = new PenggajianModel();
        $komponenGajiModel = new KomponenGajiModel();

        $anggota = $anggotaModel->find($anggota_id);

        if (!$anggota) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the Anggota with ID: '. $anggota_id);
        }

        $data = [];
        
        $data['anggota'] = $anggota;

        $data['assigned_komponen'] = $penggajianModel
            ->where('id_anggota', $anggota_id)
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->findAll();

        $assignedIds = array_column($data['assigned_komponen'], 'id_komponen_gaji');

        $availableKomponenQuery = $komponenGajiModel
            ->whereIn('jabatan', [$anggota['jabatan'], 'Semua']);
        
        if (!empty($assignedIds)) {
            $availableKomponenQuery->whereNotIn('id_komponen_gaji', $assignedIds);
        }
        
        $data['available_komponen'] = $availableKomponenQuery->findAll();

        return view('admin/anggota_gaji', $data);
    }

    public function anggotaGajiAdd($anggota_id)
    {
        $penggajianModel = new PenggajianModel();
        $data = [
            'id_anggota' => $anggota_id,
            'id_komponen_gaji' => $this->request->getPost('id_komponen_gaji')
        ];

        $exists = $penggajianModel->where($data)->first();
        if (!$exists) {
            $penggajianModel->insert($data);
            return redirect()->to('/admin/anggota/gaji/' . $anggota_id)->with('message', 'Component added.');
        }
        
        return redirect()->to('/admin/anggota/gaji/' . $anggota_id)->with('error', 'Component already assigned.');
    }

    public function anggotaGajiRemove($anggota_id, $komponen_id)
    {
        $penggajianModel = new PenggajianModel();
        $penggajianModel->where('id_anggota', $anggota_id)
                        ->where('id_komponen_gaji', $komponen_id)
                        ->delete();
        return redirect()->to('/admin/anggota/gaji/' . $anggota_id)->with('message', 'Component removed.');
    }

    public function komponenDelete($id)
    {
        $komponenModel = new KomponenGajiModel();
        $penggajianModel = new PenggajianModel();
        $usageCount = $penggajianModel->where('id_komponen_gaji', $id)->countAllResults();

        if ($usageCount > 0) {
            return redirect()->to('/admin/komponen')->with('error', "Cannot delete component. It is currently assigned to {$usageCount} member(s). Please remove it from all members first via the 'Manage Anggota' page.");
        
        } else {
            $komponenModel->delete($id);
            
            return redirect()->to('/admin/komponen')->with('message', 'Salary component deleted successfully.');
        }
    }

    public function komponenEdit($id)
    {
        $komponenModel = new KomponenGajiModel();
        $data['komponen'] = $komponenModel->find($id);

        if (!$data['komponen']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the salary component with ID: '. $id);
        }

        return view('admin/komponen_edit', $data);
    }

    public function komponenUpdate($id)
    {
        $rules = [
            'nama_komponen' => 'required|max_length[100]',
            'kategori'      => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
            'jabatan'       => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal'       => 'required|decimal',
            'satuan'        => 'required|in_list[Bulan,Hari,Periode]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $komponenModel = new KomponenGajiModel();
        $komponenModel->update($id, $this->request->getPost());

        return redirect()->to('/admin/komponen')->with('message', 'Salary component updated successfully.');
    }
}