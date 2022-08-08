<?php

class SuperAdminController extends CI_Controller {

    var $base;
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->base = $this->config->item('base_url');
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');
      if (NULL === $this->session->userdata('dootLoginDetails')) {
            $this->data['base'] = $this->base;
            header('Location: ' . $this->base . "universallogin");
        }
    }

    public function index(){

    }

    public function createProject()
    {   
        $this->load->view('welcome_message');
        // $this->load->view('Ug/universalmainbody');
        $data['companyInfo'] = $this->tikatoy_model->getCompanyName();
        $data['companyUserId'] = $this->tikatoy_model->getCompanyUserId();
        $this->load->view('superAdmin/createProject', $data);        
        $this->load->view('Ug/universalfooter');
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
        /*
        $session_data['userD'] =  $this->session->userdata('dootLoginDetails');        
        $empid = json_encode(trim($session_data['userD']['empid']));     
        $empid = trim($empid,'\\\\"');      
        //empid ie assign by
        $data['emp_id'] = $empid;  // '\"10\"'
        */

        //tblProjectName  table
        $comp_adm_log_id = $this->input->post('comp_adm_log_id');
        $data['comp_adm_log_id'] =  $comp_adm_log_id;
        $data['project_name'] = $this->input->post('project_name');
        $data['project_status'] = 1;
        $data['location'] = $this->input->post('location');
        $data['contact_no'] = $this->input->post('contact_no');
        $data['proj_adm_log_id'] = "L2-".$this->unique_id();
        $proj_adm_log_id = $data['proj_adm_log_id'];
        $data['created_By'] = $this->session->userdata('current_logedIn'); //get name of login user by session 

         //For Master Login table
         $data_login['userId'] = $this->input->post('userId');
         $data_login['password'] = $this->input->post('password');         
         $data_login['level'] = "2";        
         $data_login['MakId'] = "2RF7F101297E";
         $data_login['isActive'] = "1";
         $data_login['created_By'] = $this->session->userdata('current_logedIn');
         $data_login['unique_login_id'] = $proj_adm_log_id;
         

        //For master_staff table
        $staff_data['username'] = $this->input->post('userId');
        $staff_data['unique_login_id'] = $proj_adm_log_id;
        $staff_data['isActive'] = "2";
        $staff_data['created_By'] = $this->session->userdata('current_logedIn');

         //$data_login['login_Token'] = $company_token;
         // print_r($data);
         // print_r($data_login);die();
        
        //print_r($data);die();
        $this->tikatoy_model->storeProjectInfo($data, $data_login, $staff_data);

        $this->session->set_flashdata('add_project_name', 'Project Name has been added');

        redirect(base_url('createProject')); 
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

    public function assignToysToProjectAdmin()
    {
        $this->load->view('welcome_message');    
        // $this->load->view('Ug/universalmainbody');
        
        //
        $data['projectAdminInfo'] = $this->tikatoy_model->getProjectAdminName();
        
        $this->load->view('superAdmin/assignToysToProjectAdmin', $data);
        $this->load->view('Ug/universalfooter');
    }

    // -------------------------------- Project Admin ------------------------------------
    public function viewAssignToys()
    {
        $this->load->view('welcome_message');    
        $data['projectAdminInfo'] = $this->tikatoy_model->getProjectAdminName();
        $this->load->view('projectAdmin/viewAssignToys', $data);
        $this->load->view('Ug/universalfooter');
    }

    // -------------------------------- Company Admin ------------------------------------
    public function createCompany()
    {   
        $this->load->view('welcome_message');    
        // $this->load->view('Ug/universalmainbody');
        $this->load->view('superAdmin/createCompany');
        $this->load->view('Ug/universalfooter');
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
        //For master_company
        $data['company_name'] = $this->input->post('company_name');
        $data['company_type'] = $this->input->post('company_type');
        $data['comapny_email'] = $this->input->post('comapny_email');
        $data['company_location'] = $this->input->post('company_location');
        $data['company_contact'] = $this->input->post('company_contact');
        // $data['company_Token'] = $this->generateRandomString();
        $data['created_By'] = $this->session->userdata('current_logedIn');
        $data['comp_adm_log_id'] = "L1-".$this->unique_id();
        $comp_adm_log_id = $data['comp_adm_log_id'];
        //For Master Login
        $data_login['userId'] = $this->input->post('userId');
        $data_login['password'] = $this->input->post('password');         
        $data_login['level'] = "1";
        $data_login['MakId'] = "2RF7F101297E";
        $data_login['isActive'] = "1";
        $data_login['created_By'] = $this->session->userdata('current_logedIn');
        $data_login['unique_login_id'] = $comp_adm_log_id;

        //master_staff
        $staff_data['username'] = $this->input->post('userId');
        $staff_data['unique_login_id'] = $comp_adm_log_id;
        $staff_data['isActive'] = "1";
        $staff_data['created_By'] = $this->session->userdata('current_logedIn');

        //print_r($this->data['created_By']);
        //print_r($this->data_login['created_By']);

        //for Created By - "Company ADmin"
        //$data_login['login_Token'] = $company_token;
        // print_r($data);
        //print_r($data_login);die();

        $this->tikatoy_model->storeCompanyAdminInfo($data, $data_login, $staff_data);
        $this->session->set_flashdata('add_company_admin', 'Company & Company Admin has been Created');

        redirect(base_url('createCompany')); 
    }

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

    public function addToy(){
        echo "Add Tikka Toy";
        echo "Done by ZMQ";
    }
}