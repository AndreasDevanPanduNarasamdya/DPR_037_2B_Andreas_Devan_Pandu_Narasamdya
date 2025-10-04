<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnggotaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_anggota' => [
                'type'           => 'BIGINT', // CHANGED
                'constraint'     => 20,       // CHANGED
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_depan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nama_belakang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'gelar_depan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'gelar_belakang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'jabatan' => [
                'type'       => 'ENUM',
                'constraint' => ['Ketua', 'Wakil Ketua', 'Anggota'],
                'null'       => false,
            ],
            'status_pernikahan' => [
                'type'       => 'ENUM',
                'constraint' => ['Kawin', 'Belum Kawin'],
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id_anggota', true);
        $this->forge->createTable('anggota');
    }

    public function down()
    {
        $this->forge->dropTable('anggota');
    }
}