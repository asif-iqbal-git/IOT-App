<?php

class StaffController extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');
        $this->load->model('staff_model');

    }

    public function addStaff()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('companyAdmin/addStaff', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }

    public function update_staff_details(){
        
        $data['staff'] = $this->loginmodel->get_staff_info();

        $emp_uuid = $data['staff'][0]->staff_uuid;

        $updated_data['login_id'] = $this->input->post('login_id');
        $updated_data['emp_name'] = $this->input->post('emp_name');
        $updated_data['emp_age'] = $this->input->post('emp_age');
        $updated_data['emp_phone'] = $this->input->post('emp_phone');
        $updated_data['emp_email'] = $this->input->post('emp_email');
        $updated_data['emp_address'] = $this->input->post('emp_address');
        $updated_data['level'] = $this->input->post('level');
        $updated_data['designation_id'] = $this->input->post('desig_id');
        $updated_data['isActive'] = $this->input->post('isActive');
        $updated_data['created_by'] = $this->input->post('created_by');
        $updated_data['created_datetime'] = $this->input->post('created_at');

        $this->loginmodel->save_updated_staff_info($updated_data, $emp_uuid);

        redirect('staff_details');

    }

    public function saveStaffInfo()
    {
        $userData = $this->session->userdata('userData');     
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
 
 
        
        $staff_data['company_uuid'] = $company_info[0]->company_uuid;       
        
        $staff_data['login_id'] = $this->input->post('staff_login_id');       

        $staff_data['emp_name'] = $this->input->post('staff_name');       
        $staff_data['emp_age'] = $this->input->post('staff_age');
        $staff_data['emp_gender'] = $this->input->post('staff_gender');
        $staff_data['emp_phone'] = $this->input->post('staff_phone');
        $staff_data['emp_email'] = $this->input->post('staff_email');
        $staff_data['emp_address'] = $this->input->post('staff_address');
        $staff_data['designation_id'] = $this->input->post('staff_designation');
        
        $level = $this->tikatoy_model->getLevelByDesignation($staff_data['designation_id']);
      
        $staff_data['level'] = $level[0]->level;
       
        $staff_data['isActive'] = 1;
        $staff_data['created_by'] = $company_info[0]->created_by;
         
        
        $staff_login_data['login_id'] = $this->input->post('staff_login_id');
        $staff_login_data['password'] = $this->input->post('staff_password');
    
       
        $staff_login_data['level'] = $level[0]->level;
        $this->tikatoy_model->storeMasterStaffInfo($staff_data, $staff_login_data);
        $this->session->set_flashdata('add_company_admin_staff', 'Staff has been Created');

        redirect(base_url('addStaff')); 
        // echo("<pre>");
        // var_dump($staff_data);die();
    }

    public function updateStaffInfo()
    {    
         $id = $this->input->post('id');
         $staffInfo = $this->loginmodel->getSingleStaffInfo($id);
         
         echo json_encode($staffInfo);
    }

    public function getStaffDesignation()
    {
        return $this->loginmodel->getDesignation();
    }

    public function assignProjectToPAdmin()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
        $company_info = $this->tikatoy_model->getCompanyNameByCAdmin($userData['login_id']);
        $company_uuid = $company_info[0]->company_uuid;
        $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');

            $data['Padminlist'] = $this->staff_model->fetchPAdminByCompany                  ($company_uuid);
            
            $data['projectStatus'] = $this->staff_model->fetchProjectStatus($company_uuid);
           
            $projectStatus = $data['projectStatus'];
            
            $data['projectList'] = $this->staff_model->fetchProjectByCompany($company_uuid,$projectStatus);
            
            $data['assignedProjects'] = $this->staff_model->fetchAssignedProjects($company_uuid,$projectStatus);

            $this->load->view('companyAdmin/assignProjectToPAdmin', $data);
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }
//not using----------------------------------------------------------
    public function assign_Project_To_PAdmin()
    {
        $msg  = "Project Admin Already Exits";
        $msg2 = "Project is assign to Selected Project Admin";
        $msg3 = "This Project is already assign to Project Admin";
        $msg4 = "Empty String Or Array";
       
      
        $data['project_admin_uuid'] = $this->input->post('projectAdmin_id');
        $data['project_uuid'] = $this->input->post('checked_id');
       
        
       
        if(empty($data['project_admin_uuid'])){
           
            return print_r(json_encode($msg4));
        }
        
        if(empty($data['project_uuid'])){
           
            return print_r(json_encode($msg4));
        }

        foreach($data['project_uuid'] as $row){
            $data['project_admin_uuid'] = $this->input->post('projectAdmin_id');
            $data['project_uuid'] = $row;
            $data['status'] = 1;
            $data['isActive'] = 1;
            $this->db->insert("project_projectAdmin_mapping", $data);
         //   print_r(json_encode($row));
        }
       
        return print_r(json_encode($msg2));
       
        //fetch all mapping data and check it with entered value
        $mapped_data = $this->staff_model->getMappedData();
    
       
        
        if(isset($mapped_data) && !empty($mapped_data)){
            for($i=0 ; $i < count($mapped_data);  $i++){
                if($mapped_data[$i]->project_admin_uuid == $data['project_admin_uuid']){

            //   print_r(json_encode($mapped_data[$i]->project_admin_uuid == $data['project_admin_uuid']));print_r('<br>');

              foreach($data['project_uuid'] as $row)
                 {
                    // print_r('-');  print_r(json_encode($mapped_data[$i]->project_uuid == $row));
                    if($mapped_data[$i]->project_uuid == $row)
                    {  
                         
                        //This Project is already assign to Project Admin
                        print_r(json_encode($row));
                        
                    }else{
                         print_r(json_encode($msg2));
                    }
                 }
        }
    }
            /*
        for($i=0 ; $i < count($mapped_data);  $i++){
        
            //if project admin is matched,then check for project,if same admin get same project return false
            if($mapped_data[$i]->project_admin_uuid == $data['project_admin_uuid']){
                 
                foreach($data['project_uuid'] as $row)
                 {
                    if($mapped_data[$i]->project_uuid == $row)
                    {  
                        return print_r(json_encode($msg3));
                    }
                 }
                
               return  print_r(json_encode($msg));
            }else{
                //Diff Project admin dont have same project.
                foreach($data['project_uuid'] as $row)
                {
                   if($mapped_data[$i]->project_uuid == $row)
                   {  
                       return print_r(json_encode($msg3));
                   }else{
                   //diff admin - have - diff project
                    foreach($data['project_uuid'] as $row){
                        $data['project_admin_uuid'] = $this->input->post('projectAdmin_id');
                        $data['project_uuid'] = $row;
                        $data['isActive'] = 1;
                        $this->db->insert("project_projectAdmin_mapping", $data);
                     //   print_r(json_encode($row));
                    }
                  
                    return print_r(json_encode($msg2));
                   }
                }
                
            }
        }
      */

        // print_r(json_encode($mapped_data[0]->project_admin_uuid));
        // print_r(json_encode($data['project_admin_uuid']));

        // print_r(json_encode( $mapped_data[0]->project_uuid));
        // print_r(json_encode($data['project_uuid']));
         
      }
    return false;
    }
//not using----------------------------------------------------------
    public function projectList()
    {
        $userData = $this->session->userdata('userData');
        // $data['staff'] = $this->loginmodel->get_staff_info();
       // $data['staff_designation'] = $this->getStaffDesignation();

        if($userData){
            $this->load->view('libs');                                     
            $this->load->view('Ug/universalmainbody');
            $this->load->view('staff/projectList');
            // $this->load->view('Ug/universalfooter');
        }else{
            $this->load->view('libs');
            $this->load->view('welcome_message'); 
        }
    }








   /* public function get_single_emp_id(){

        $id = $this->input->post('staff_uuid');

        $this->loginmodel->get_staff_info_using_id($id);

        echo json_encode();

    }*/

}

?>