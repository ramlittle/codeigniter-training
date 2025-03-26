<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_patients_add_column_profile_image extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_column('patients', [
            'profile_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE,
            ]
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('patients', 'profile_image');
    }




}