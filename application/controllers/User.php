<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('upload'); // Load the upload library
        $this->load->library('session');
    }

    public function login()
    {
        $this->load->view('users/login');
    }

   
    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|max_length[255]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/register');
        } else {
            $user_data = [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->User_model->insert_user($user_data)) {
                $this->session->set_flashdata('success', 'User registered successfully!');
                redirect('user/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to register user.');
                $this->load->view('users/register');
            }
        }
    }
}
