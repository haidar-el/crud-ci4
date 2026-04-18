<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArtikelTable extends Migration
{
    public function up()
    {
        // Supaya tidak error kalau tabel artikel sudah ada, kita drop dulu kalau ada.
        // Sebaiknya, ini aman untuk lingkungan development.
        $this->forge->dropTable('artikel', true);

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'isi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cover_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'published'],
                'default'    => 'published',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('artikel');
    }

    public function down()
    {
        $this->forge->dropTable('artikel');
    }
}
