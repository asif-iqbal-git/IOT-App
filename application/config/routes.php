<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "Welcome";

$route['login'] = 'LoginController2/login';
$route['logout'] = 'LoginController2/Logout';

$route['404_override'] = '';
$route['cardregister'] ='TikaToy/cardregister';
$route['gettoyid'] ='TikaToy/getToyid';     
$route['toyinitilization'] ='TikaToy/toyInitialization';
$route['officerlogin']  ='TikaToy_Controller/officerLogin';  
$route['childregister']  ='TikaToy_Controller/ChildRegister';
$route['gettoys']  ='TikaToy/getRegisteredToys';
$route['iotinteraction']  ='TikaToy/iotInteraction';  
$route['providerregister']  ='Welcome/providerRegister'; 
$route['assigntokens']  ='Welcome/assignTokensToProvider'; 
$route['childdata']  ='Welcome/childData'; 
$route['tokeninfo']  ='Welcome/tokenInfo';
$route['vaccineplanner']  ='Welcome/vaccinePlanner';
$route['about']  ='Welcome/about';
$route['providerRegisterSubmittion']  ='Welcome/providerRegisterSubmittion';
$route['tokensbyid']  ='TikaToy_Controller/TokensInfoByProviderId';
$route['childvaccination']  ='TikaToy_Controller/ChildVaccination';
$route['childvaccine_card']  ='TikaToy_Controller/Child_Vaccine_Status';
$route['childCommunication']  ='Welcome/childCommunication';


$route['dashboard'] = 'DashboardController/dashboard';

$route['addStaff'] = 'StaffController/addStaff';
$route['staff_details'] = 'SuperAdminController/staff_details';
$route['update_staff'] = 'StaffController/update_staff_details';

$route['createCompany'] = 'SuperAdminController/createCompany';
$route['createCompanyAdmin'] = 'SuperAdminController/createCompanyAdmin';

$route['createProject'] = 'SuperAdminController/createProject';
$route['createProjectAdmin'] = 'SuperAdminController/createProjectAdmin';

$route['assignToysToProjectAdmin'] = 'SuperAdminController/assignToysToProjectAdmin';
$route['viewAssignToys'] = 'SuperAdminController/viewAssignToys';

$route['projectStatus'] = 'SuperAdminController/projectStatus';

$route['assign-project'] = 'StaffController/assignProjectToPAdmin';

/* End of file routes.php */
/* Location: ./application/config/routes.php */