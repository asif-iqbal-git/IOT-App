<?php

class SuperAdminController extends CI_Controller {

    var $base;
    function __construct() {
        parent::__construct(); 
        $this->base = $this->config->item('base_url');
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');
        //session data
       // $userData = $this->session->userdata('userData');
    }

    public function index(){

    }

    

    public function assignToysToProjectAdmin()
    {
        $this->load->view('welcome_message');    
        // $this->load->view('Ug/universalmainbody');
        
        //
        $data['projectAdminInfo'] = $this->tikatoy_model->getProjectAdminName();
        
        $this->load->view('superAdmin/assignToysToProjectAdmin', $data);
        $this->load->view('Ug/universalfooter');
    }

    

    // -------------Project & Project-Admin ------------------

    public function createProject()
    {   
        $userData = $this->session->userdata('userData');
        $current_logedIn_staffUuid = $this->loginmodel->fetchStaffUUID($userData['login_id']);  
      // var_dump($userData);
       
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            
            //getCompanyNameByCAdmin()

            $data['companyInfo'] = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
            $data['companyUserId'] = $this->tikatoy_model->getCompanyUserId();            
            $data['projectAdminByCompany'] =  
            $this->tikatoy_model->getProjectAdminNameforSelect();
            //$this->tikatoy_model->getProjectAdminNameByCompany();
            // echo"<pre>";
            //  var_dump($data['projectAdminByCompany']);

            $this->load->view('superAdmin/createProject', $data);  
            $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }

        
    }

    public function createProjectAdmin()
    {   
        $this->load->view('welcome_message');    
        // $this->load->view('Ug/universalmainbody');
        $this->load->view('superAdmin/createProjectAdmin');
        $this->load->view('Ug/universalfooter');
    }
   
    

    public function saveProjectInfo()
    {  
         
        //Fetch current login user
        $userData = $this->session->userdata('userData');
         
        //current_logedIn staff_uuid
        $current_logedIn_staffUuid = $this->loginmodel->fetchStaffUUID($userData['login_id']);      
                
        //For master_project  --table
        $company_uuid = $this->input->post('company_uuid');
        $data_project['company_uuid']     = $company_uuid;
        $data_project['project_name']     = $this->input->post('project_name');
        $data_project['project_location'] = $this->input->post('project_location');
        $data_project['isActive']         = 1;
        $data_project['assign_to']        = $this->input->post('staff_uuid'); //staff_uuid for project admin
        $data_project['created_By']       = $current_logedIn_staffUuid; //get name of login user by session 
        //var_dump($data_project);die();

        //if cAdmin is selected Padmin from dropdown then it will not save it again to database.
        $isExistProAdmin = $this->isExistProjectAdmin($data_project['assign_to']);
        if($isExistProAdmin){
           
            echo "True";            
            // var_dump($isExistProAdmin);die();

                $project_adm_log_id = $isExistProAdmin[0]->login_id;
                $project_admin_level = $isExistProAdmin[0]->level;
            // return true;
        }else{
            echo "False";
            //For tblLogin - for Project Admin
            $data_login['login_id'] = $this->input->post('project_admin_uuid');
            $data_login['password'] = $this->input->post('password');         
            $data_login['level'] = "2";       
            $data_login['isActive'] = "1";
            $project_admin_level = $data_login['level'];  
            $project_adm_log_id =  $data_login['login_id'];
           // var_dump($data_login);die();
        }

        //For Master_staff
       
        //  $this->updateMasterStaff($current_logedIn_staffUuid);
            $data_master_staff['staff_uuid'] = "";
            $data_master_staff['login_id'] = $project_adm_log_id;           
            $data_master_staff['emp_name'] = "";
            $data_master_staff['emp_age'] =  0;
            $data_master_staff['emp_phone'] = "";
            $data_master_staff['emp_email'] = "";
            $data_master_staff['emp_address'] = "";
            $data_master_staff['level'] = $project_admin_level;
            $data_master_staff['designation_id'] = "";
            $data_master_staff['isActive'] = "1";
            $data_master_staff['created_By'] = $current_logedIn_staffUuid;
        
        if($isExistProAdmin){
            $this->tikatoy_model->storeProjectInfo2($data_project, $data_master_staff);
        }else{
            $this->tikatoy_model->storeProjectInfo($data_project, $data_login, $data_master_staff);
        }
            
        

        $this->session->set_flashdata('add_project_name', 'Project Name has been added');

        redirect(base_url('createProject')); 
    }

    public function isExistProjectAdmin($uuid)
    {
        $existingProAdmin =  $this->loginmodel->checkProjectAdmin($uuid);
      //  var_dump($existingProAdmin);die();
        return $existingProAdmin;
    }

    public function unique_id()
    {
        return uniqid();
    }
    public function saveProjectAdminInfo()
    {
        $data['userId'] = $this->input->post('userId');
        $data['password'] = $this->input->post('password');
        $data['level'] = "2";        

        $data['MakId'] = "2RF7F101297E";
        $data['isActive'] = "1";

        //print_r($data);
        $this->tikatoy_model->storeProjectAdminInfo($data);
        $this->session->set_flashdata('add_project_admin', 'Project Admin has been Created');

        redirect(base_url('createProjectAdmin')); 
    }

 
 

    public function staff_details()
    {  
        $userData = $this->session->userdata('userData');
        $data['staff'] = $this->loginmodel->get_staff_info();
        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('superAdmin/staff_details', $data);
            $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
        
    }

    // -------------------------------- Project Admin ------------------------------------
 
    
 
    public function viewAssignToys()
    {
        $this->load->view('welcome_message');    
        $data['projectAdminI$data'] = $this->tikatoy_model->getProjectAdminName();
        $this->load->view('projectAdmin/viewAssignToys', $data);
        $this->load->view('Ug/universalfooter');
    }

    // -------------------------------- Company Admin ------------------------------------
    public function createCompany()
    {   
        $userData = $this->session->userdata('userData');
     
         $staff_data = $this->loginmodel->fetchStaffUUID($userData['login_id']);      
      //   var_dump($staff_data);die();
        $virtualPassword['virtualPassword'] = $this->generateRandomString();
         // var_dump($staff_data);
        if($userData){
            $this->load->view('libs');             
            $this->load->view('Ug/universalmainbody');
            $this->load->view('superAdmin/createCompany', $virtualPassword);
            $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message');    
        }        
    }

    
    public function createCompanyAdmin()
    {
        $this->load->view('welcome_message');    
        // $this->load->view('Ug/universalmainbody');
        $this->load->view('superAdmin/CreateCompanyAdmin');
        $this->load->view('Ug/universalfooter');
    }

    public function saveCompanyInfo()
    {
         //session data
       $userData = $this->session->userdata('userData');
        
       //current_logedIn staff_uuid
       $current_logedIn_staffUuid = $this->loginmodel->fetchStaffUUID($userData['login_id']);                      
        //For master_company
        $data_company['company_name'] = $this->input->post('company_name');
        $data_company['company_type'] = $this->input->post('company_type');
        $data_company['company_location'] = $this->input->post('company_location');
        $data_company['company_email'] = $this->input->post('company_email');
        $data_company['company_location'] = $this->input->post('company_location');
        // $data_company['company_contact'] = $this->input->post('company_contact');
        $data_company['isActive'] = 1;
        $data_company['created_By'] = $current_logedIn_staffUuid;
      
       
        //For tblLogin - for Company Admin
        $data_login['login_id'] = $this->input->post('login_id');
        $data_login['password'] = $this->input->post('password');         
        $data_login['level'] = "1";       
        $data_login['isActive'] = "1";
        $company_admin_level = $data_login['level'];  
        $company_adm_log_id =  $data_login['login_id'];
      
        //For master_company
        $data_company['company_admin_loginId'] = $company_adm_log_id;
        
        //For master_staff
     
        //  $this->updateMasterStaff($current_logedIn_staffUuid);
            $data_master_staff['staff_uuid'] = "";
            $data_master_staff['login_id'] = $company_adm_log_id;           
            $data_master_staff['emp_name'] = "";
            $data_master_staff['emp_age'] =  0;
            $data_master_staff['emp_phone'] = "";
            $data_master_staff['emp_email'] = "";
            $data_master_staff['emp_address'] = "";
            $data_master_staff['level'] = $company_admin_level;
            $data_master_staff['designation_id'] = "";
            $data_master_staff['isActive'] = "1";
            $data_master_staff['created_By'] = $current_logedIn_staffUuid;
       
        $this->tikatoy_model->storeCompanyAdminInfo($data_company, $data_login,$data_master_staff);
        $this->session->set_flashdata('add_company_admin', 'Company & Company Admin has been Created');

        redirect(base_url('createCompany')); 
    }

    // public function updateMasterStaff($current_logedIn_staffUuid)
    // {
    //     $staff_uuid = $this->loginmodel->fetchStaffUUID($userData['login_id']);
    //     $master_staff_data['staff_uuid'] = 
    // }

    public function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function fetchCompanyName()
    {
        $data = $this->tikatoy_model->getCompanyName();
        
        return print_r(json_encode($data));
    }

    public function projectStatus()
    {
        $data['user_session_details'] =  $this->session->userdata('dootLoginDetails'); 
        $data['project_info'] = $this->tikatoy_model->getProjectInfoWithCompanies();

        $this->load->view('welcome_message');             
        $this->load->view('companyAdmin/projectStatus', $data);

        $this->load->view('Ug/universalfooter');
    }

}