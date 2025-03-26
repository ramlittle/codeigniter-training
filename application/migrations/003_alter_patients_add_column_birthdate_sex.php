<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Alter_patients_add_column_birthdate_sex extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_column('patients', [
            'birthdate' => [
                'type' => 'DATE',
                'null' => TRUE,
            ],
            'sex' => [
                'type' => 'CHAR',
                'constraint' => 1,
                'null' => FALSE,
            ],
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_column('patients', 'birthdate');
        $this->dbforge->drop_column('patients', 'sex');
    }




}