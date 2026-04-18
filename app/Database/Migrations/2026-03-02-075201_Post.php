<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'auto_increment'=> true,
            ],
            'tittle'    => [
                'type'      => 'varchar',
                'constraint'=> '255',
            ],
            'content'   => [
                'type'  => 'text'
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('posts');
        //
    }

    public function down()
    {
        //
    }
}
