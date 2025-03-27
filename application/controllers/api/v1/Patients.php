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

    

}