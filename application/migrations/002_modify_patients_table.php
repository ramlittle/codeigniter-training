<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Modify_patients_table extends CI_Migration
{

    public function up()
    {
        $this->dbforge->modify_column('patients', [
            'name' => [
                'name' => 'firstname',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ]
        ]);
        $fields = array(
            'middlename' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            )
        );
        $this->dbforge->add_column('patients', $fields);
    }
    public function down()
    {
        $this->dbforge->modify_column('patients', [
            'firstname' => [
                'name' => 'name',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ]
        ]);

        $this->dbforge->drop_column('patients', 'middlename');
        $this->dbforge->drop_column('patients', 'lastname');
    }
}