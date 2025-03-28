<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] = 'patient';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// PATIENTS
$route['patient']['GET'] = 'Patient/index';
$route['patient/create']['POST']='Patient/add';
$route['patient/edit/(:any)']['GET']='Patient/edit/$1';
$route['patient/delete/(:any)']['GET']='Patient/delete/$1';
$route['patient/getPatientByID/(:any)']['GET']='Patient/getPatientByID/$1';

//API ROUTE PATIENT
$route['/api/v1/patients']['GET']='api/v1/patients/all';
$route['api/v1/patients/(:num)'] = 'api/v1/patients/get_patient/$1';
$route['api/v1/patient/(:num)']['delete'] = 'api/v1/patients/delete_patient/$1';
$route['api/v1/patient']['post'] = 'api/v1/patients/create_patient';

//USERS
$route['user/login']['POST']='User/login';
$route['user/register']['POST']='User/register';





