<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenggajianTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen_gaji' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                // NO 'auto_increment' here
            ],
            'id_anggota' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                // NO 'auto_increment' here
            ],
        ]);

        $this->forge->addPrimaryKey(['id_komponen_gaji', 'id_anggota']);
        $this->forge->addForeignKey('id_komponen_gaji', 'komponen_gaji', 'id_komponen_gaji', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_anggota', 'anggota', 'id_anggota', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penggajian');
    }

    public function down()
    {
        $this->forge->dropTable('penggajian');
    }
}