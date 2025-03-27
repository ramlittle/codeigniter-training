<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration {

	public function up(){
		$this->dbforge->add_field([
            'email'=>[
                'type' =>'VARCHAR',
                'constraint'=>255,
            ],
            'password'=>[
                'type' =>'VARCHAR',
                'constraint'=>20,
            ],
            'firstname'=>[
                'type' =>'VARCHAR',
                'constraint'=>60,
            ],
            'lastname'=>[
                'type' =>'VARCHAR',
                'constraint'=>60,
            ],
            'created_at'=>[
                'type' =>'DATETIME',
                'null'=>TRUE
            ],
            'updated_at'=>[
                'type' =>'DATETIME',
                'null'=> TRUE
            ],
        ]);

        $this->dbforge->add_key('email',TRUE);
        $this->dbforge->create_table('users');
}}