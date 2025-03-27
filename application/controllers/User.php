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

    // public function login()
    // {
    //     $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    //     $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('users/login');
    //     } else {
    //         $email = $this->input->post('email');
    //         $password = $this->input->post('password');
    
    //         // Get user by email
    //         $user = $this->User_model->get_user_by_email($email);
    
    //         if (!$user) {
    //             $this->session->set_flashdata('error', 'Email not found.');
    //             redirect('user/login');
    //             return;
    //         }

    //         $userLogin = $this->User_model->validate_login($email,$password);
    //         if($userLogin){
    //             $this->session->set_userdata($userLogin);
    //             redirect('patient');
    //         }else {
    //             $this->session->set_flashdata('error', 'Invalid email or password.');
    //             redirect('user/login');

    //         }
    //         // Verify the password
    //         // if (password_verify($password, $user->password)) {
    //         //     $session_data = [
    //         //         'email' => $user->email,
    //         //         'logged_in' => TRUE
    //         //     ];
    //         //     $this->session->set_userdata($session_data);
    
    //         //     // Redirect to patient/index after login
    //         //     redirect('patient');
    //         //     echo password_verify($password,$user->password);
    //         //     echo 'password matched';
    //         // } else {
    //         //     $this->session->set_flashdata('error', 'Invalid email or password.');
    //         //     redirect('user/login');

    //         // }
            
    //     }
    // }
    

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('users/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            // Get user by email
            $user = $this->User_model->get_user_by_email($email);
    
            if (!$user) {
                $this->session->set_flashdata('error', 'Email not found.');
                redirect('user/login');
                return;
            }
    
            $userLogin = $this->User_model->validate_login($email, $password);
            if ($userLogin) {
                $this->session->set_userdata($userLogin);
                echo 'correct login';
                redirect('patient');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                echo 'incorrect password';
                redirect('user/login');
            }
        }
    }

    public function register()
{
    $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('users/register');
    } else {
        $email = trim($this->input->post('email')); // Trim email
        $password = trim($this->input->post('password')); // Trim password
        $lastname = trim($this->input->post('lastname')); // Trim password
        $firstname = trim($this->input->post('firstname')); // Trim password

        $user_data = [
            'email' => $email,
            'password' => $password , // Hash trimmed password
            'created_at' => date('Y-m-d H:i:s'),
            'lastname'=>$lastname,
            'firstname'=>$firstname,
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



    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'email', 'logged_in']);
        $this->session->sess_destroy();
        redirect('user/login');
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}
