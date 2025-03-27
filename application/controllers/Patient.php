<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->library('form_validation');
        $this->load->library('upload'); // Load the upload library
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
        // $this->form_validation->set_rules('profile_image', 'Profile Image', 'callback_check_image_upload');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('patients/add');
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB max
            $config['file_name'] = time() . "_" . $_FILES['profile_image']['name'];
            $this->upload->initialize($config);

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }

            if ($this->upload->do_upload('profile_image')) {
                $uploadData = $this->upload->data();
                $image = $uploadData['file_name'];
            } else {
                $image = null;
            }

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

            if ($image !== null) {
                $patient_data['profile_image'] = $image;
            }

            if ($this->Patient_model->insert_patient($patient_data)) {
                $this->session->set_flashdata('success', 'Patient added successfully!');
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
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required');
        $this->form_validation->set_rules('sex', 'Sex', 'required|in_list[M,F]');
        // $this->form_validation->set_rules('profile_image', 'Profile Image', 'callback_check_image_upload');

        if ($this->input->post('submit')) {
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('patients/edit', $data);
            } else {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // 2MB max
                $config['file_name'] = time() . "_" . $_FILES['profile_image']['name'];
                $this->upload->initialize($config);

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                if ($this->upload->do_upload('profile_image')) {
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                } else {
                    $image = null;
                }

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

                if ($image !== null) {
                    $update_data['profile_image'] = $image;
                }

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
    public function check_image_upload($str)
    {
        $file = $_FILES['profile_image'];
        if ($file['error'] == 0) {
            return true;
        } else {
            $this->form_validation->set_message('check_image_upload', 'Please select an image to upload.');
            return false;
        }
    }


    public function getPatientByID($id)
    {
        $data = $this->Patient_model->get_patient_by_id($id);
        $output = array(
            'name' => $data->firstname . ' ' . $data->middlename . ' ' . $data->lastname,
            'firstname' => $data->firstname,
            'middlename'=>$data->middlename,
            'lastname'=>$data->lastname,
            'image' => $data->profile_image,
            'birthday' => date('m/d/Y', strtotime($data->birthdate)),
            'sex' => ($data->sex == 'F') ? 'FEMALE' : 'MALE',
            'email' => $data->email,
            'phone' => $data->phone
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($output));
    }


        /**
     * @OA\GET(
     *     path="/api/v1/regions",
     *     summary="This will return all regions",
     *     tags={"Patient"},
     *     @OA\Response(
     *         response="404",
     *         description="Username is already taken."
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Email is already registered."
     *     ),     
     *      @OA\Response(
     *         response="202",
     *         description="Registration successful! Please log in."
     *     ),
     *      @OA\Response(
     *         response="403",
     *         description="Registration failed. Try again.."
     *     ),
     *      security={{"basicAuth": {}}}
     * )
     */
    public function all() {
        echo "this is the way";
    }
public function getall()

{
    
}
}
