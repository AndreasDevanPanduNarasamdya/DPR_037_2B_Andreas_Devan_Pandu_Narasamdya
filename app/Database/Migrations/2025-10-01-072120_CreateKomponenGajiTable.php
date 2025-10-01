<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKomponenGajiTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komponen' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_komponen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constraint' => ['Gaji Pokok', 'Tunjangan Melekat', 'Tunjangan Lain'],
                'null'       => false,
            ],
            'berlaku_untuk' => [
                'type'       => 'ENUM',
                'constraint' => ['Ketua', 'Wakil Ketua', 'Anggota', 'Semua'],
                'null'       => false,
            ],
            'nominal' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => false,
            ],
            'satuan' => [
                'type'       => 'ENUM',
                'constraint' => ['Bulan', 'Periode'],
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('id_komponen', true);
        $this->forge->createTable('komponen_gaji');
    }

    public function down()
    {
        $this->forge->dropTable('komponen_gaji');
    }
}