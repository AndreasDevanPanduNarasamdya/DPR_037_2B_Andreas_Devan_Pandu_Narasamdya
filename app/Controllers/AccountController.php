<?php

namespace App\Controllers;

// We need to import the model to use it
use App\Models\UsersModel;

class AccountController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerProcess()
    {
        // 1. Set validation rules
        $rules = [
            'nama_depan'    => 'required|max_length[100]',
            'nama_belakang' => 'max_length[100]',
            'username'      => 'required|min_length[3]|max_length[100]|is_unique[pengguna.username]',
            'email'         => 'required|valid_email|is_unique[pengguna.email]',
            'password'      => 'required|min_length[8]',
        ];

        // 2. Run validation
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 3. Prepare the data to be saved
        $userData = [
            'nama_depan'    => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'Public' // Automatically assign 'Public' role
        ];
        
        // 4. Use the model to save the data
        $usersModel = new UsersModel();
        if ($usersModel->save($userData)) {
            // Redirect to the login page with a success message
            return redirect()->to('/')->with('success', 'Registration successful! Please log in.');
        } else {
            // If save fails for some reason
            return redirect()->back()->with('error', 'Could not save user. Please try again.');
        }
    }

    public function loginProcess()
    {
        // 1. Get the data from the form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // 2. Ask the model to verify credentials
        $usersModel = new UsersModel();
        $user = $usersModel->verifyUser($email, $password);

        // 3. Make the decision
        if ($user) {
            // SUCCESS! Credentials are valid.
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id_pengguna'],
                'username'   => $user['username'],
                'role'       => $user['role']
            ]);

            // "Transport" them to the table view
            return redirect()->to('/dpr-gaji');
        } else {
            // FAILURE! Credentials are not valid.
            return redirect()->back()->with('error', 'Login failed. Please check your email and password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/'); // Redirect to login page
    }
}