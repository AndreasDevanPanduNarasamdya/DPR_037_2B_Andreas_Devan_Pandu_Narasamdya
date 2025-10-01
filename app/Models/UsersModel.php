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
        // Find a user by their email address
        $user = $this->where('email', $email)->first();

        // If no user is found, login fails
        if (!$user) {
            return false;
        }

        // Check the submitted password against the stored hash
        if (password_verify($password, $user['password'])) {
            // Password is correct! Return the user's data.
            return $user;
        }

        // If passwords don't match, login fails
        return false;
    }
}