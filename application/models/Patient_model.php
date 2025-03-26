<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient_model extends CI_Model
{
private $table = 'patients';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    //3styles of querying

    //STYLE 1

    public function get_patient_list(){
        $query = "SELECT * FROM patients";
        return $query->result_array();
    }

    //STYLE 2

    public function get_patient_list_all(){
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->get($this->result_array());
    }
	
	//STYLE 3
	public function get_all_patients()
	{
		$query = $this->db->get($this->table);
		return $query->result_array();
		
	}
    // Create a new patient
    public function insert_patient($data)
	{
		return $this->db->insert($this->table, $data);
	}

	// Read a single patient by ID
	public function get_patient_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();
	}

	// Read all patients

	// Update a patient by ID
	public function update_patient($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Delete a patient by ID
	public function delete_patient($id)
	{
		return $this->db->delete($this->table, ['id' => $id]);
	}

	// Get patient by email
	public function get_patient_by_email($email)
	{
		$query = $this->db->get_where($this->table, array('email' => $email));
		return $query->row();
	}
}
