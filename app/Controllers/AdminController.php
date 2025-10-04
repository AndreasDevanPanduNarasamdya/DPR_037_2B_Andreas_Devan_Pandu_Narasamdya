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

    // --- PENGGUNA (USER) CRUD METHODS ---

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
        // This is the logic that processes the 'Add New User' form
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
            // You should add nama_depan and nama_belakang here too
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

        // Only validate password if it's being changed
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

        // Only add password to the save array if it's being changed
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

    // --- ANGGOTA METHODS ---
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
        $komponenModel->save($this->request->getPost());
        return redirect()->to('/admin/komponen')->with('message', 'Salary component created successfully.');
    }

// In AdminController.php

    public function anggotaGaji($anggota_id)
    {
        // ... (the first part of the function is here, getting the models and the $anggota data) ...
        $anggotaModel = new AnggotaModel();
        $penggajianModel = new PenggajianModel();
        $komponenGajiModel = new KomponenGajiModel();
        $anggota = $anggotaModel->find($anggota_id);

        // ... (logic to get assigned_komponen and assignedIds is here) ...
        $data['assigned_komponen'] = $penggajianModel
            ->where('id_anggota', $anggota_id)
            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
            ->findAll();
        $assignedIds = array_column($data['assigned_komponen'], 'id_komponen_gaji');

        // Get components they are eligible for
        $availableKomponenQuery = $komponenGajiModel
            ->whereIn('jabatan', [$anggota['jabatan'], 'Semua']);
        
        if (!empty($assignedIds)) {
            $availableKomponenQuery->whereNotIn('id_komponen_gaji', $assignedIds);
        }
        
        $data['available_komponen'] = $availableKomponenQuery->findAll();

        // --- THIS IS THE MOST IMPORTANT DEBUG STEP ---
        // This will stop the script and show us the exact SQL query.
        dd($komponenGajiModel->getLastQuery()->getQuery());
        
        // The view will not be loaded yet.
        return view('admin/anggota_gaji', $data);
    }

    public function anggotaGajiAdd($anggota_id)
    {
        $penggajianModel = new PenggajianModel();
        $data = [
            'id_anggota' => $anggota_id,
            'id_komponen_gaji' => $this->request->getPost('id_komponen_gaji')
        ];

        // Basic validation to prevent duplicates
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
}