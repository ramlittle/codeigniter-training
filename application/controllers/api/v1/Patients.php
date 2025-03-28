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

        /**
     * @OA\POST(
     *     path="/api/v1/Patients/create_patient",
     *     summary="Create a new patient record",
     *     tags={"Patient"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"firstname", "middlename", "lastname"},
     *             @OA\Property(property="firstname", type="string", example="John Doe"),
     *             @OA\Property(property="middlename", type="string", example="John Doe"),
     *             @OA\Property(property="lastname", type="string", example="John Doe")
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Patient created successfully"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid input"
     *     ),
     *     security={{"basicAuth": {}}}
     * )
     */
    public function create_patient() {
        $input = json_decode(trim(file_get_contents("php://input")), true);

        if (!isset($input['firstname']) || !isset($input['middlename']) || !isset($input['lastname'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }

        $patient_id = $this->Patient_model->insert_patient($input);

        if ($patient_id) {
            http_response_code(201);
            echo json_encode(["message" => "Patient created successfully", "patient_id" => $patient_id]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to create patient"]);
        }
    }

    

}