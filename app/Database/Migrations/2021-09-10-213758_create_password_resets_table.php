<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
		$this->forge->addField([
			'email'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'token'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
		]);

		$this->forge->addKey('email', FALSE);

		$this->forge->createTable('password_resets', TRUE);
    }

    public function down()
    {
		$this->forge->dropTable('password_resets');
    }
}
