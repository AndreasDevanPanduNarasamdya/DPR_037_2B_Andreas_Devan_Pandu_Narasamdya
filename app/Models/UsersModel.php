<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_pengguna';
    protected $allowedFields    = ['username', 'password', 'email', 'nama_depan', 'nama_belakang', 'role'];

    /**
     * Verifies a user's credentials against the database.
     *
     * @param string $email
     * @param string $password
     * @return array|false
     */
    public function verifyUser(string $email, string $password)
    {
        $user = $this->where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
}