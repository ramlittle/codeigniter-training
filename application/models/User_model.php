<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
private $table = 'users';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_user_list(){
        $query = "SELECT * FROM users";
        return $query->result_array();
    }

    // Create a new user
    public function insert_user($data)
	{
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		return $this->db->insert($this->table, $data);
	}

	// Read a single user by ID (ORIGINAL)
	
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();
	}

	// Read all users

	// Update a user by ID
	public function update_user($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	// Delete a user by ID
	public function delete_user($id)
	{
		return $this->db->delete($this->table, ['id' => $id]);
	}

	// Get user by email
	public function get_user_by_email($email)
	{
		$query = $this->db->get_where($this->table, array('email' => $email));
		return $query->row();
	}
}

