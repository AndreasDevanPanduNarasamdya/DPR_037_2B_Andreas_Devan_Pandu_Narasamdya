<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKomponenGajiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen_gaji' => [ // CORRECT NAME
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_komponen' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain'],
            ],
            'jabatan' => [ // RENAMED from 'berlaku_untuk' to match your schema
                'type'       => 'ENUM',
                'constraint' => ['Ketua', 'Wakil Ketua', 'Anggota', 'Semua'],
            ],
            'nominal' => [
                'type'       => 'DECIMAL',
                'constraint' => '17,2',
            ],
            'satuan' => [
                'type'       => 'ENUM',
                'constraint' => ['Bulan', 'Hari', 'Periode'],
            ],
        ]);

        $this->forge->addKey('id_komponen_gaji', true); // CORRECT PRIMARY KEY
        $this->forge->createTable('komponen_gaji');
    }

    public function down()
    {
        $this->forge->dropTable('komponen_gaji');
    }
}