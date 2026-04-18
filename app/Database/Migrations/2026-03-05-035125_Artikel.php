<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Artikel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'          =>'INT',
                'constraint'    => 11,
                'unsigned'      =>true,
                'auto_increment'=>true,
            ],
            'judul'     => [
                'type'          =>'VARCHAR',
                'constraint'        =>255,
            ],
            'slug'      =>[
                'type'=> 'VARCHAR',
                'constraint'=> 255,
            ],
            'isi'       => [
                'type'=> 'TEXT',
                'null'=> true,
            ],
            'created_at'    => [
                'type'=> 'DATETIME',
                'null'=> true,
            ],
            'updated_at'=> [
                'type'=> 'DATETIME',
                'null'=> true,
            ],
        ]);
        //menentukan Primary Key nya
        $this ->forge->addKey('id', true);
        //membuat tabel
        $this->forge->createTable('artikel');
    }

    public function down()
    {
        //kebalikan dari up(), ini dijalankan saat kita melakukan rollback
        $this->forge->dropTable('artikel');
    }
}
