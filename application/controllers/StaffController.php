<?php

class StaffController extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('loginmodel');
        $this->load->model('tikatoy_model');

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



   /* public function get_single_emp_id(){

        $id = $this->input->post('staff_uuid');

        $this->loginmodel->get_staff_info_using_id($id);

        echo json_encode();

    }*/

}

?>