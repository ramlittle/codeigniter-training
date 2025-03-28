<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @OA\Info(
 *     title="iHOMIS+ API",
 *     version="0.1",
 * )
 * @OA\Server(url="http://codeigniter.test:82")
 * @OA\SecurityScheme(
 * securityScheme="BasicAuth",
 * type="http",
 * scheme="basic"
 * )
 */

class Patients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
    }
        /**
     * @OA\GET(
     *     path="/api/v1/Patients/all",
     *     summary="This will return all patients",
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
        $output = $this->Patient_model->get_all_patients();
        echo json_encode($output);
     
    }

    /**
     * @OA\GET(
     *     path="/api/v1/Patients/get_patient/{patientid}",
     *     summary="Get patient data by ID",
     *     tags={"Patient"},
     *     @OA\Parameter(
     *         name="patientid",
     *         in="path",
     *         required=true,
     *         description="ID of the patient",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Patient data retrieved successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Patient not found"
     *     ),
     *     security={{"basicAuth": {}}}
     * )
     */
    public function get_patient($patientid) {
        $output = $this->Patient_model->get_patient_by_id($patientid);
        
        if ($output) {
            echo json_encode($output);
        } else {
            show_404();
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/v1/Patients/delete_patient/{patientid}",
     *     summary="Delete a patient by ID",
     *     tags={"Patient"},
     *     @OA\Parameter(
     *         name="patientid",
     *         in="path",
     *         required=true,
     *         description="ID of the patient to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Patient deleted successfully"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Patient not found"
     *     ),
     *     security={{"basicAuth": {}}}
     * )
     */
    public function delete_patient($patientid) {
        $deleted = $this->Patient_model->delete_patient($patientid);
        
        if ($deleted) {
            echo json_encode(["message" => "Patient deleted successfully"]);
        } else {
            show_404();
        }
    }
    

}