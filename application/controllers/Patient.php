<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['patients'] = $this->Patient_model->get_all_patients();
        $this->load->view('patients/index', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('middlename', 'Middlename', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('sex', 'Sex', 'required|in_list[M,F]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('patients/add');
        } else {
            $patient_data = [
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'lastname' => $this->input->post('lastname'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'birthdate' => $this->input->post('birthdate'),
                'sex' => $this->input->post('sex'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Patient_model->insert_patient($patient_data)) {
                $this->session->set_flashdata('success', 'Patient added successfull!');
                redirect('patient/index');
            } else {
                $this->session->set_flashdata('error', 'Failed to add patient.');
                $this->load->view('patients/add');
            }

        }
    }

    public function edit($id)
    {
        $data['patient'] = $this->Patient_model->get_patient_by_id($id);
        if (!$data['patient']) {
            show_404();
        }
        $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('middlename', 'Middlename', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('sex', 'Sex', 'required|in_list[M,F]');

        if ($this->input->post('submit')) {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('patients/edit', $data);
            } else {
                $update_data = [
                    'firstname' => $this->input->post('firstname'),
                    'middlename' => $this->input->post('middlename'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'birthdate' => $this->input->post('birthdate'),
                    'sex' => $this->input->post('sex'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                if ($this->Patient_model->update_patient($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Patient updated successfully!');
                    redirect('patient/index');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update patient.');
                    $this->load->view('patients/edit', $data);
                }
            }
        } else {
            $this->load->view('patients/edit', $data);
        }
    }
    public function delete($id)
    {
        if ($this->Patient_model->delete_patient($id)) {
            $this->session->set_flashdata('success', 'Patient deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete patient.');
        }
        redirect('patient/index');
    }

}
