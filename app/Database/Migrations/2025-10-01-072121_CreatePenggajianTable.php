<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenggajianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_anggota' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        // A composite primary key to ensure no member gets the same component twice.
        $this->forge->addPrimaryKey(['id_komponen', 'id_anggota']);

        // Foreign key constraints
        $this->forge->addForeignKey('id_komponen', 'komponen_gaji', 'id_komponen', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id_anggota', 'CASCADE', 'CASCADE');

        $this->forge->createTable('penggajian');
    }

    public function down()
    {
        $this->forge->dropTable('penggajian');
    }
}