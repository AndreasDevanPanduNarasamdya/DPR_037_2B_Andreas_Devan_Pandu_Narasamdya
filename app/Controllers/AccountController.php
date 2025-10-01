<?php

namespace App\Controllers;

use App\Models\UsersModel;

class AccountController extends BaseController
{
    /**
     * Displays the public registration form.
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Displays the admin registration form.
     */
    public function registerAdmin()
    {
        return view('register_admin');
    }

    /**
     * Processes data from both registration forms.
     */
    public function registerProcess()
    {
        $rules = [
            'nama_depan'    => 'required|max_length[100]',
            'nama_belakang' => 'max_length[100]',
            'username'      => 'required|min_length[3]|max_length[100]|is_unique[pengguna.username]',
            'email'         => 'required|valid_email|is_unique[pengguna.email]',
            'password'      => 'required|min_length[8]',
            'role'          => 'required|in_list[Admin,Public]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'nama_depan'    => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => $this->request->getPost('role')
        ];
        
        $usersModel = new UsersModel();
        if ($usersModel->save($userData)) {
            return redirect()->to('/')->with('success', 'Registration successful! Please log in.');
        } else {
            return redirect()->back()->with('error', 'Could not save user. Please try again.');
        }
    }

    /**
     * Processes the login form.
     */
    public function loginProcess()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usersModel = new UsersModel();
        $user = $usersModel->verifyUser($email, $password);

        if ($user) {
            // SUCCESS! Credentials are valid.
            session()->set([
                'isLoggedIn' => true,
                'user_id'    => $user['id_pengguna'],
                'username'   => $user['username'],
                'role'       => $user['role']
            ]);

            // --- THIS IS THE CRITICAL FIX ---
            // Check the user's role and redirect accordingly.
            if ($user['role'] === 'Admin') {
                // If they are an Admin, send them to the admin dashboard.
                return redirect()->to('/admin');
            } else {
                // If they are a Public user, send them to the public dashboard.
                return redirect()->to('/dashboard');
            }
        } else {
            // FAILURE! Credentials are not valid.
            return redirect()->back()->with('error', 'Login failed. Please check your email and password.');
        }
    }

    /**
     * Logs the user out.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}